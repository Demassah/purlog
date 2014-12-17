<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_delivered extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_do';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_do,a.id_courir,date_create,id_user,a.status,b.full_name,c.name_courir');
			$this->db->from('tr_do a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->join('ref_courir c', 'c.id_courir = a.id_courir');
			$this->db->where('a.status', 2);
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

	function getdatadetail($id_do,$plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_do';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_sro,id_ro,id_do,date_create,a.id_user,b.full_name');
			$this->db->from('tr_sro a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->where('a.status', 2);
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

	function getdatadetailsro($id_ro,$id_sro,$plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('id_detail_pros,id_detail_ro,a.id_ro,id_sro,id_stock,a.kode_barang,qty,id_lokasi,a.status');
		$this->db->from('tr_pros_detail a');
		$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
		$this->db->where('a.status', 1);
		$this->db->where('id_ro', $id_ro);
		$this->db->where('id_sro', $id_sro);
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
	
}

?>