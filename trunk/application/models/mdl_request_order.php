<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_request_order extends CI_Model {
    
	function __construct(){
	    parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('*, a.id_ro, b.full_name, c.departement_name');
		$this->db->from('tr_ro a');
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

	
	function getdataedit($kode){
		$this->db->flush_cache();
		$this->db->select('a.id_ro, a.user_id, a.purpose, a.cat_req, a.ext_doc_no, a.ETD, a.date_create, a.status, b.full_name, c.departement_name');
		$this->db->from('tr_ro a');
		$this->db->join('sys_user b', 'b.user_id = a.user_id');
		$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');
		$this->db->where('a.id_ro', $kode);

		return $this->db->get();
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

	function InsertOnDb($data){
		$this->db->flush_cache();
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('purpose', $data['purpose']);
        $this->db->set('cat_req', $data['cat_req']);
        $this->db->set('ext_doc_no', $data['ext_doc_no']);
        $this->db->set('ETD', FormatDateToMysql($data['ETD']));
        $this->db->set('date_create', FormatDateToMysql($data['date_create']));
        $this->db->set('status', $data['status']);

		$result = $this->db->insert('tr_ro');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
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
		$this->db->from('tr_ro_detail a');
		$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
		$this->db->join('sys_user c', 'c.user_id = a.user_id');
		$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
		$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');
			
			$this->db->where('a.id_ro', $id_ro);
			
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

	function InsertDetail($data){
		$this->db->flush_cache();
    $this->db->set('id_ro', $data['id_ro']);
    $this->db->set('ext_doc_no', $data['ext_doc_no']);
    $this->db->set('id_barang', $data['id_barang']);
    $this->db->set('qty', $data['qty']);
    $this->db->set('user_id', $data['user_id']);
    $this->db->set('date_create', FormatDateToMysql($data['date_create']));
    $this->db->set('note', $data['note']);
    $this->db->set('status', $data['status']);

		$result = $this->db->insert('tr_ro_detail');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function getDetail($id_detail_ro){
		$this->db->where('id_detail_ro', $id_detail_ro);
		$this->db->from('tr_ro_detail');
		
		return $this->db->get();
	}

	function countDetail($id_ro){
		$this->db->where('id_ro', $id_ro);
		$this->db->from('tr_ro_detail');
		
		return $this->db->count_all_results();
	}

	function SendData($kode){
		$this->db->flush_cache();
		$this->db->set('status', "2");
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro');
	  
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function DeleteOnDb($kode){		
		$this->db->where('id_ro', $kode);
		$result = $this->db->delete('tr_ro');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function DeleteDetail($kode){		
		$this->db->where('id_detail_ro', $kode);
		$result = $this->db->delete('tr_ro_detail');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function load_kode_barang(){
		#get filter
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.kode_barang, concat(a.kode_barang, \' - \' ,a.nama_barang) as nama_barang', false);
			$this->db->from('ref_barang a');
			$this->db->order_by('a.nama_barang', 'ASC');
		$this->db->stop_cache();
		
		# get count
		$tmp['row_count'] = $this->db->get()->num_rows();
		
		# get data
		$tmp['row_data'] = $this->db->get();
		
		return $tmp;
	}

	function Update_DetailRO($data){
		$this->db->trans_start();

		$result = true;

		# tambah data ke tabel
		$this->db->flush_cache();
		$this->db->set('id_ro', $data['id_ro']);
		$this->db->set('ext_doc_no', $data['ext_doc_no']);
		$this->db->set('kode_barang', $data['kode_barang']);
		$this->db->set('qty', $data['qty']);
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('date_create', $data['date_create']);
		$this->db->set('note', $data['note']);
		$this->db->set('status', '1');
		$this->db->set('status_delete', '0');
		$this->db->set('id_sro', '0');

		$result = $this->db->insert('tr_ro_detail');

		//return
		$this->db->trans_complete();
		return $this->db->trans_status();

		}


}

?>