<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_menu extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'menu_name';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*');
			$this->db->from('sys_menu');
			$this->db->order_by($sort, $order);
		$this->db->stop_cache();
		
		# get count
		$tmp['row_count'] = $this->db->get()->num_rows();
		
		# get data
		if($plimit == true){
			$this->db->limit($limit, $offset);
		}
		$tmp['row_data'] = $this->db->get();
		
		return $tmp;
	}
	
	function getdataedit($kode){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('sys_menu');
		$this->db->where('menu_id', $kode);
		
		return $this->db->get();
	}
	
	function togrid($data, $count){
		$response->total = $count;
		$response->rows = array();
		if($count>0){
			$i=0;
			foreach($data->result_array() as $row){
				foreach($row as $key => $value){
					$response->rows[$i][$key]=$value;
				}
				$i++;
			}
		}
		return json_encode($response);
	}
	
	function InsertOnDb($data){
		$this->db->flush_cache();
        $this->db->set('menu_group', $data['menu_group']);
        $this->db->set('menu_name', $data['menu_name']);
        $this->db->set('menu_parent', $data['menu_parent']);
        $this->db->set('url', $data['url']);
        $this->db->set('position', $data['position']);
        $this->db->set('hide', isset($data['hide'])?'1':'0');
        $this->db->set('icon_class', $data['icon_class']);
        $this->db->set('policy', $data['policy']);
		$result = $this->db->insert('sys_menu');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function UpdateOnDb($data){
		//query insert data		
		$this->db->flush_cache();
     	$this->db->set('menu_group', $data['menu_group']);
      $this->db->set('menu_name', $data['menu_name']);
      $this->db->set('menu_parent', $data['menu_parent']);
      $this->db->set('url', $data['url']);
      $this->db->set('position', $data['position']);
      $this->db->set('hide', isset($data['hide'])?'1':'0');
      $this->db->set('icon_class', $data['icon_class']);
      $this->db->set('policy', $data['policy']);
		
		$this->db->where('menu_id', $data['kode']);
		$result = $this->db->update('sys_menu');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function DeleteOnDb($kode){		
		$this->db->where('menu_id', $kode);
		$result = $this->db->delete('sys_menu');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
}

?>