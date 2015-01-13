<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_pengguna extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'user_name';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, c.departement_name');
			$this->db->from('sys_user a');
			$this->db->join('sys_user_level b', 'b.user_level_id = a.user_level_id');
			$this->db->join('ref_departement c', 'c.departement_id = a.departement_id', 'left');
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
		$this->db->from('sys_user');
		$this->db->where('user_id', $kode);
		
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
		$this->db->set('nik', $data['nik']);
        $this->db->set('user_name', $data['user_name']);
        $this->db->set('full_name', $data['full_name']);
        $this->db->set('passwd', md5($data['passwd']));
        $this->db->set('departement_id', $data['departement_id']);
        $this->db->set('user_level_id', $data['user_level_id']);

		$result = $this->db->insert('sys_user');
		
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
				$this->db->set('nik', $data['nik']);
        $this->db->set('user_name', $data['user_name']);
        $this->db->set('full_name', $data['full_name']);
		if($data['passwd'] != '')
			$this->db->set('passwd', md5($data['passwd']));
				$this->db->set('departement_id', $data['departement_id']);
        $this->db->set('user_level_id', $data['user_level_id']);
		
		$this->db->where('user_id', $data['kode']);
		$result = $this->db->update('sys_user');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function DeleteOnDb($kode){		
		$this->db->where('user_id', $kode);
		$result = $this->db->delete('sys_user');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
	/*------------------- untuk menu ----------------------------*/
	function menu_load($user_level){
		// kamus data
		$data['total'] = '';
		$data['rows'] = '';
		
		// get menu
		$this->db->flush_cache();
		$this->db->order_by('menu_parent');
		$this->db->order_by('position');
		$res_menu = $this->db->get('sys_menu');
		
		$data['total'] = $res_menu->num_rows();
		$i=0;
		foreach($res_menu->result() as $menu){
			// init policy menu
			$data['rows'][$i]['menu_id'] = $menu->menu_id;
			$data['rows'][$i]['menu_parent'] = $menu->menu_parent;
			$data['rows'][$i]['menu_name'] = $menu->menu_name;
			$data['rows'][$i]['menu_group'] = $menu->menu_group;
			$data['rows'][$i]['access1'] = strpos($menu->policy, 'ACCESS')===false?0:1;
			$data['rows'][$i]['add1'] = strpos($menu->policy, 'ADD')===false?0:1;
			$data['rows'][$i]['edit1'] = strpos($menu->policy, 'EDIT')===false?0:1;
			$data['rows'][$i]['delete1'] = strpos($menu->policy, 'DELETE')===false?0:1;
			$data['rows'][$i]['detail1'] = strpos($menu->policy, 'DETAIL')===false?0:1;
			$data['rows'][$i]['print1'] = strpos($menu->policy, 'PRINT')===false?0:1;			
			$data['rows'][$i]['pdf1'] = strpos($menu->policy, 'PDF')===false?0:1;
			$data['rows'][$i]['excel1'] = strpos($menu->policy, 'EXCEL')===false?0:1;			
			$data['rows'][$i]['import1'] = strpos($menu->policy, 'IMPORT')===false?0:1;
			$data['rows'][$i]['approve1'] = strpos($menu->policy, 'APPROVE')===false?0:1;
			
			// get menu access
			$this->db->where('menu_id', $menu->menu_id);
			$this->db->where('user_level_id', $user_level);
			$res_level = $this->db->get('sys_user_access');
			
			if($res_level->num_rows()>0){
				// init policy menu access
				$data['rows'][$i]['user_access_id'] = $res_level->row()->user_access_id;
				$data['rows'][$i]['access'] = strpos($res_level->row()->policy, 'ACCESS')===false?0:1;
				$data['rows'][$i]['add'] = strpos($res_level->row()->policy, 'ADD')===false?0:1;
				$data['rows'][$i]['edit'] = strpos($res_level->row()->policy, 'EDIT')===false?0:1;
				$data['rows'][$i]['deleted'] = strpos($res_level->row()->policy, 'DELETE')===false?0:1;
				$data['rows'][$i]['detail'] = strpos($res_level->row()->policy, 'DETAIL')===false?0:1;
				$data['rows'][$i]['print'] = strpos($res_level->row()->policy, 'PRINT')===false?0:1;
				$data['rows'][$i]['pdf'] = strpos($res_level->row()->policy, 'PDF')===false?0:1;
				$data['rows'][$i]['excel'] = strpos($res_level->row()->policy, 'EXCEL')===false?0:1;				
				$data['rows'][$i]['import'] = strpos($res_level->row()->policy, 'IMPORT')===false?0:1;				
				$data['rows'][$i]['approve'] = strpos($res_level->row()->policy, 'APPROVE')===false?0:1;
			}else{
				// init policy menu access
				$data['rows'][$i]['user_access_id'] = 0;
				$data['rows'][$i]['access'] = 0;
				$data['rows'][$i]['add'] = 0;
				$data['rows'][$i]['edit'] = 0;
				$data['rows'][$i]['deleted'] = 0;
				$data['rows'][$i]['detail'] = 0;
				$data['rows'][$i]['print'] = 0;
				$data['rows'][$i]['pdf'] = 0;
				$data['rows'][$i]['excel'] = 0;
				$data['rows'][$i]['import'] = 0;				
				$data['rows'][$i]['approve'] = 0;
			}
			
			$i++;
		}
		
		return $data;
	}
	
	function InsertMenu($data){
		$this->db->trans_start();
		
		# tambah sap ke tabel
		foreach($data['data']['rows'] as $row){
			/*
				jika user_access_id == 0 maka insert
				jika tidak update
			*/
			/* populate policy */
			$policy = '';
			$policy .= $row['access']==1?'ACCESS;':'';
			$policy .= $row['add']==1?'ADD;':'';
			$policy .= $row['edit']==1?'EDIT;':'';
			$policy .= $row['deleted']==1?'DELETE;':'';
			$policy .= $row['detail']==1?'DETAIL;':'';
			$policy .= $row['print']==1?'PRINT;':'';			
			$policy .= $row['pdf']==1?'PDF;':'';
			$policy .= $row['excel']==1?'EXCEL;':'';
			$policy .= $row['import']==1?'IMPORT;':'';
			$policy .= $row['approve']==1?'APPROVE;':'';
			
			$this->db->set('menu_id', $row['menu_id']);
			$this->db->set('user_level_id', $data['user_level_id']);
			$this->db->set('policy', $policy);
			
			if($row['user_access_id'] == 0){
				$this->db->insert('sys_user_access');
			}else{
				$this->db->where('user_access_id', $row['user_access_id']);
				$this->db->update('sys_user_access');
			}
		}
		
		//return
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}
	
}

?>