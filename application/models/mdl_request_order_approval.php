<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_request_order_approval extends CI_Model {
    
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

		#get filter
		$departement_id = isset($_POST['departement_id']) ? strval($_POST['departement_id']) : '';
		$id_ro = isset($_POST['id_ro']) ? strval($_POST['id_ro']) : '';
		$ext_doc_no = isset($_POST['ext_doc_no']) ? strval($_POST['ext_doc_no']) : '';
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_ro, a.purpose, a.cat_req, a.ext_doc_no, a.etd, a.date_create, b.full_name, c.departement_name, d.status_delete');
			$this->db->from('tr_ro a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');
			$this->db->join('tr_ro_detail d', 'd.id_ro = a.id_ro');

			#Filter
			if($this->session->userdata('departement_id')!='0'){
				$this->db->where('b.departement_id', $this->session->userdata('departement_id'));
			}else{
				if($departement_id != '')
					$this->db->where('b.departement_id', $departement_id);
			}

			if($id_ro != '') {
					$this->db->like('a.id_ro', $id_ro);
			}

			if($ext_doc_no != '') {
					$this->db->like('a.ext_doc_no', $ext_doc_no);
			}

			// if($id_ro != ''){
			// 		$this->db->where('b.id_ro', $id_ro);
			// }

			$this->db->where('a.status','2');
			$this->db->group_by('a.id_ro');

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

	function DoneData($kode){
		date_default_timezone_set('Asia/Jakarta');
		$time =  date('Y-m-d H:i:s');
		
		$this->db->flush_cache();		
		$this->db->set('status', "3");
		$this->db->set('date_approve', $time);		
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro');
	   
	   
		$this->db->flush_cache();
		$this->db->set('status', "0");
		$this->db->where('id_object', $kode);
		$result = $this->db->update('tr_notifikasi');
	  
		//return
		if($result) {
				return $kode;
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
			$this->db->where('a.status', '1');
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
	
	function DeleteDetail($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status_delete', "1");
		
		$this->db->where('id_detail_ro', $kode);
		$result = $this->db->update('tr_ro_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function countDetail($id_ro){
		$this->db->where('id_ro', $id_ro);
		$this->db->where('status_delete', '0');
		$this->db->from('tr_ro_detail');
		
		return $this->db->count_all_results();
	}

	function reject($kode){
		date_default_timezone_set('Asia/Jakarta');
		$time =  date('Y-m-d H:i:s');
		
		$this->db->flush_cache();
		
		$this->db->set('status', "9");
		$this->db->set('date_reject', $time);
		
		$this->db->where('id_ro', $kode);
		//$this->db->where('status_delete', '0');
		$result = $this->db->update('tr_ro');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function getRODetail($id) {
		$this->db->flush_cache();
		$this->db->where('id_detail_ro', $id);
		return $this->db->get('tr_ro_detail');
	}

	function update_qty($data){
		$this->db->trans_start();
		
		$result = true;
		
		# tambah ke tabel
		foreach($data['data_qty']['rows'] as $row){
			
			$this->db->flush_cache();
			$this->db->set('qty', $row['qty']);

			$this->db->where('id_detail_ro', $row['id_detail_ro']);

			$result = $this->db->update('tr_ro_detail');
			
		}
		
		//$this->db->where('id_ro', $id_ro);
		//$this->db->where('qty', '0');
		//$result = $this->db->delete('tr_ro_detail');

		//return
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}
}

?>