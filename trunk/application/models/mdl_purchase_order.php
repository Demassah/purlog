<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_purchase_order extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_po';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_po,a.id_pr,a.id_ro,a.requestor,a.departement,b.full_name,c.departement_name,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,a.date_create,a.status,d.id_qrs');
			$this->db->from('tr_po a');
			$this->db->join('sys_user b', 'b.user_id = a.requestor');
			$this->db->join('ref_departement c', 'c.departement_id = a.departement');
			$this->db->join('tr_qr d', 'd.id_po = a.id_po', 'left');
			$this->db->where('a.status',1);
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

	// detail po
	function detail($id_po)
	{
		$this->db->select('a.id_vendor,a.name_vendor,a.contact_vendor,a.mobile_vendor,a.address_vendor,b.id_po,b.id_detail_pr,b.kode_barang,b.nama_barang,b.qty,b.price,b.total,b.top');
		$this->db->where('id_po', $id_po);
		$this->db->join('ref_vendor a', 'a.id_vendor = b.id_vendor');
		$query = $this->db->get('v_po_detail_2 b');
		return $query->result();
	}

	function search_pr($id_pr)
	{
		$this->db->select('*');
		$this->db->where('id_pr', $id_pr);
		$query = $this->db->get('tr_pr');
		return $query->row();

	}
	function search_qr($data)
	{
		$this->db->select('id_qr,id_pr');
		$this->db->where('id_qrs', $data['id_qrs']);
		$this->db->where('status', 2);
		$query = $this->db->get('tr_qr');
		return $query->row();
	}
	function Insert_po($data)
	{
		// function searc
		$qr = $this->mdl_purchase_order->search_qr($data);
		$id_pr = $qr->id_pr;
		$pr = $this->mdl_purchase_order->search_pr($id_pr);
		

		// function select
		$this->db->set('id_pr',$pr->id_pr);
		$this->db->set('id_qrs',$data['id_qrs']);
		$this->db->set('id_ro',$pr->id_ro);
		$this->db->set('requestor',$pr->user_id);
		$this->db->set('departement',$data['departement_id']);
		$this->db->set('purpose',$pr->purpose);
		$this->db->set('cat_req',$pr->cat_req);
		$this->db->set('ETD',$pr->ETD);
		$this->db->set('ext_doc_no',$pr->ext_doc_no);
		$this->db->set('date_create',$data['date_create']);
		$this->db->set('status',$data['status']);

		// function Insert
		$result = $this->db->insert('tr_po');

		// function Notif
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}

	}

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

		$this->db->where('id_po', $kode);

		$result = $this->db->update('tr_po');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function delete($kode){
		
		$this->db->flush_cache();

		// $this->db->set('status', "2");

		$this->db->where('id_po', $kode);

		$result = $this->db->delete('tr_po');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	//cetak laporan
	
	function report($id_po)
	{
		$this->db->select('a.id_vendor,a.name_vendor,a.contact_vendor,a.mobile_vendor,a.address_vendor,b.id_po,b.id_detail_pr,b.kode_barang,b.note,b.qty,b.price,b.total,b.purpose,b.ext_doc_no,b.ETD,b.top,b.nama_barang,b.full_name,b.departement_name,b.cat_req,b.date_create');
		$this->db->where('id_po', $id_po);
		$this->db->join('ref_vendor a', 'a.id_vendor = b.id_vendor');
		$query = $this->db->get('v_po_detail_2 b');
		return $query->result();
	}
} //End

?>