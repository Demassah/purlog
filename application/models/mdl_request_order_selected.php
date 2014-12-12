<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_request_order_selected extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, b.full_name, c.departement_name');
			$this->db->from('tr_ros a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');

			$this->db->where('a.status','1');

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

	function getdata_detail($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, a.id_ro, c.full_name, d.departement_name, e.nama_barang');
			$this->db->from('tr_ros_detail a');
			$this->db->join('tr_ros b', 'b.id_ro = a.id_ro');
			$this->db->join('sys_user c', 'c.user_id = a.user_id');
			$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.status_delete', '0');

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

	function alocate($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "2");
		
		$this->db->where('id_detail_ro', $kode);
		$result = $this->db->update('tr_ros_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function done($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "2");
		
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ros');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
}

?>