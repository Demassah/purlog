<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_lokasi extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_lokasi';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.*, b.type_lokasi, b.storage_lokasi, b.status_lokasi');
			$this->db->from('ref_lokasi a');
			$this->db->join('v_lokasi b', 'b.id_lks = a.id_lks');
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
		$this->db->from('ref_lokasi');
		$this->db->where('id_lks', $kode);
		
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
        $this->db->set('id_lokasi', $data['id_lokasi']);
        $this->db->set('type', $data['type']);
        $this->db->set('storage', $data['storage']);
        $this->db->set('status', isset($data['status'])?'1':'0');

		$result = $this->db->insert('ref_lokasi');
		
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
		 $this->db->set('id_lokasi', $data['id_lokasi']);
        $this->db->set('type', $data['type']);
        $this->db->set('storage', $data['storage']);
        $this->db->set('status', isset($data['status'])?'1':'0');
		
		$this->db->where('id_lks', $data['kode']);
		$result = $this->db->update('ref_lokasi');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	

	function DeleteOnDb($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "0");
		
		$this->db->where('id_lks', $kode);
		$result = $this->db->update('ref_lokasi');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
}

?>