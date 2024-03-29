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

		#get filter
		$departement_id = isset($_POST['departement_id']) ? strval($_POST['departement_id']) : '';
		$id_ro = isset($_POST['id_ro']) ? strval($_POST['id_ro']) : '';
		$ext_doc_no = isset($_POST['ext_doc_no']) ? strval($_POST['ext_doc_no']) : '';
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('*, a.id_ro, b.full_name, c.departement_name');
		$this->db->from('tr_ro a');
		$this->db->join('sys_user b', 'b.user_id = a.user_id');
		$this->db->join('ref_departement c', 'c.departement_id = b.departement_id','left');

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
		$this->db->trans_start();
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('purpose', $data['purpose']);
        $this->db->set('cat_req', $data['cat_req']);
        $this->db->set('ext_doc_no', $data['ext_doc_no']);
        $this->db->set('no_rangka', $data['no_rangka']);
        $this->db->set('no_polisi', $data['no_polisi']);
        $this->db->set('ETD', FormatDateToMysql($data['ETD']));
        $this->db->set('date_create', ($data['date_create']));
        $this->db->set('status', $data['status']);

		$result = $this->db->insert('tr_ro');
		$id = $this->db->insert_id();
		$this->db->trans_complete();
		
		//return
		if($result) {
			return $id;
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
		$this->db->set('barang_bekas', $data['barang_bekas']);
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


	function get_pdf($id_ro){        
        # get data
        $this->db->flush_cache();
        $this->db->start_cache();

        	$this->db->select('a.id_detail_ro, a.id_ro, a.ext_doc_no, a.kode_barang, a.qty, a.barang_bekas, a.date_create, a.note, a.status, c.nama_barang, b.purpose, b.cat_req, b.ext_doc_no, b.etd, b.date_create, d.full_name');
			$this->db->from('tr_ro_detail a');
			$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->join('sys_user d', 'd.user_id = a.user_id');
			$this->db->where('a.id_ro', $id_ro);
			//$this->db->where('a.id_ro', $kode);
			$this->db->where('a.status', '1');

        // proses
            $result = $this->db->get();
        
	        if ($result->num_rows() > 0) {
	            foreach ($result->result() as $data) {
	                $data_pdf[] = $data;
	            }
	        return $data_pdf;           
        }
        
    }

}

?>