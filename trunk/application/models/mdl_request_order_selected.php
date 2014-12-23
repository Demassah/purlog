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
			$this->db->from('tr_ro a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');

			$this->db->where('a.status','4');

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
		$response = new StdClass;
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
			$this->db->select('*, a.kode_barang, a.id_ro, c.full_name, d.departement_name, e.nama_barang');
			$this->db->from('tr_ro_detail a');
			$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
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
		$result = $this->db->update('tr_ro_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function done($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "5");
		
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function getdataedit($kode){
		$this->db->flush_cache();
		$this->db->select('*, a.id_ro, a.id_detail_ro, c.full_name, d.departement_name, e.nama_barang, e.type');
		$this->db->from('tr_ro_detail a');
		$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
		$this->db->join('sys_user c', 'c.user_id = a.user_id');
		$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
		$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

		$this->db->where('a.id_detail_ro', $kode);
		//$this->db->where('e.type', '3');

		return $this->db->get();
	}

	function isExistKode($kode){
		if ($kode!=null)
			$this->db->where('id_detail_ro',$kode);
		
		$this->db->select('*');
		$this->db->from('tr_ro_detail');
		$query = $this->db->get();
		
		$rs = $query->num_rows() ;		
		$query->free_result();
		
		return ($rs>0);
	}

	function UpdateOnDb($data){
		//query insert data		
		$this->db->flush_cache();
		//$this->db->set('id_detail_ro', $data['id_detail_ro']);
		$this->db->set('id_ro', $data['id_ro']);
		$this->db->set('ext_doc_no', $data['ext_doc_no']);
		$this->db->set('kode_barang', $data['kode_barang']);
		$this->db->set('qty', $data['qty']);
		$this->db->set('barang_bekas', $data['barang_bekas']);
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('date_create', $data['date_create']);
		$this->db->set('note', $data['note']);
		$this->db->set('status', $data['status']);		
		$this->db->set('status_delete', $data['status_delete']);		
		$this->db->set('id_sro', $data['id_sro']);

		$this->db->where('id_detail_ro', $data['kode']);
		$result = $this->db->update('tr_ro_detail');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

}

?>