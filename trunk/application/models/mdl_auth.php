<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_auth extends CI_Model {
    var $shorcutList;
	var $gotoMenuList;
	/**
	* constructor 
	*/
	public function __construct()
    {
        parent::__construct();
		$this->shortcutList = array();		
		
    }
	
	function ceklogin($dt){
		$this->db->select('*');
		$this->db->from('sys_user');
		$this->db->where('user_name', $dt['username']);
		$this->db->where("passwd = md5('".$dt['password']."')");
		
		return $this->db->get();
	}
	
	function createmenu(){
		$this->db->flush_cache();
		$this->db->select('a.menu_id, a.user_level_id, b.menu_name, b.menu_parent, b.position, b.url, b.hide, b.icon_class, b.policy');
		$this->db->from('sys_user_access a');
		$this->db->join('sys_menu b', 'b.menu_id = a.menu_id');
		$this->db->where('b.hide !=', '1');
		$this->db->where('a.user_level_id', $this->session->userdata('user_level_id'));
		
		$this->db->like('a.policy', 'ACCESS', 'both'); 
		
		$this->db->order_by('b.position', 'ASC');
		$query = $this->db->get();
		
		foreach($query->result() as $r){
			$data[$r->menu_parent][] = $r;
		}
		
		$menu = $this->menuList($data);

		//print_r($menu);
		return json_encode($menu);
	}
	
	function menuList($data, $parent = 0 ){
		if(isset($data[$parent])){
			$result = array();
			foreach($data[$parent] as $v){
				$node = array();
				$node['id'] = $v->menu_id;
				$node['text'] = $v->menu_name;
				$node['iconCls'] = $v->icon_class;
				$attr = array();
				$attr['url'] = $v->url;
				$node['attributes'] = $attr;
				$node['children'] = $this->menuList($data, $v->menu_id);
								
				if($node['children']){
					$node['state'] = 'closed';
				}
				
				array_push($result, $node);
			}
			return $result;
			
		}else{
			return false;
		}
	}

	public function CekAkses($param){
		$this->db->flush_cache();
		$this->db->where('menu_id', $param['menu_id']);	
		$this->db->where('user_level_id', $this->session->userdata('user_level_id'));
		$this->db->where("policy like '%".$param['policy']."%'");				
		$this->db->from('sys_user_access');
		
		return ($this->db->count_all_results()>0);
	}
	
}

?>