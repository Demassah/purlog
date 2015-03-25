<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_quotation_request_selected extends CI_Model {

	function __construct(){
    parent::__construct();
  }
	// ---------------------------------------------------Grid QRS -------------------------------------------------------------- //

  function getdata($plimit=true){
	# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_qrs';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
			#get filter
		$id_qrs = isset($_POST['id_qrs']) ? strval($_POST['id_qrs']) : '';

		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_qrs,a.id_pr,a.id_ro,a.status,a.status_qrs,a.date_create,a.user_id,b.full_name,c.departement_name,d.purpose,d.cat_req,d.ext_doc_no,d.ETD');
			$this->db->from('tr_qrs a');
			#filter
			if($id_qrs != '') {
					$this->db->like('a.id_qrs', $id_qrs);
				}
			$this->db->join('sys_user b', 'b.user_id = a.user_id','left');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id','left');
			$this->db->join('tr_pr d', 'd.id_pr = a.id_pr','left');

			$where = "a.status = 1 and a.status_qrs = 1";
			$this->db->where($where);

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
	// ---------------------------------------------------List Vendor/PR -------------------------------------------------------------- //

	function check_tr_qr($id_pr,$id_qrs)
	{
		$this->db->select('b.id_vendor,b.id_pr,b.id_qrs');
		$this->db->where('b.id_pr', $id_pr);
		$this->db->where('b.id_qrs', $id_qrs);
		$query = $this->db->get('tr_qr b');
		return $query->result();

	}

	function list_vendor($id_pr,$id_qrs)
	{
		$id_vendor = $this->mdl_quotation_request_selected->check_tr_qr($id_pr,$id_qrs);
		$item ='';
		foreach ($id_vendor as $l) {
			$item = $l->id_vendor;
			// echo $item;
			$this->db->where('a.id_vendor !=', $item);
		}

		$this->db->select('a.id_vendor,a.name_vendor');
		$query = $this->db->get('ref_vendor a');
		return $query->result();
	}

	function list_pr($id_pr,$id_qrs)
	{
		$this->db->select('a.id_qr,a.id_qrs,a.id_pr,a.id_vendor,top,a.ETD,a.status,b.kode_barang,b.price,c.nama_barang,d.name_vendor,b.id_detail_qr,b.id_detail_pr,b.qty');
		$this->db->join('tr_qr_detail b', 'b.id_qr = a.id_qr');
		$this->db->join('ref_barang c', 'c.kode_barang = b.kode_barang');
		$this->db->join('ref_vendor d', 'd.id_vendor = a.id_vendor');
		$this->db->join('tr_pr e', 'e.id_pr = a.id_pr');
		$this->db->order_by('a.id_vendor asc,  b.kode_barang asc');
		$this->db->where('e.id_pr',$id_pr);
		$this->db->where('a.id_qrs',$id_qrs);
		$this->db->where('e.status', 2);

		$query = $this->db->get('tr_qr a');
		return $query->result_array();
	}
	// --------------------------------------------------- Update Harga -------------------------------------------------------------- //
	function update($id,$data)
	{
		$harga = str_replace(",","",$data);
		$this->db->where('id_detail_qr', $id);
		$this->db->set('price',$harga);
		$this->db->update('tr_qr_detail');
	}
	// --------------------------------------------------- Update Vendor -------------------------------------------------------------- //
	function update_qr_vendor($id_pr,$id_qrs)
	{
		$this->db->set('status','1');
		$this->db->where('id_pr', $id_pr);
		$this->db->where('id_qrs', $id_qrs);
		return $this->db->update('tr_qr');
	}
		// --------------------------------------------------- Cek Harga -------------------------------------------------------------- //
	function cek_price($kode)
	{
		$this->db->select('price,id_pr,id_detail_qr');
		$this->db->where('id_qr', $kode);
		$query = $this->db->get('tr_qr_detail');
		return $query->result();
	}
	// --------------------------------------------------- Select Vendor -------------------------------------------------------------- //
	function selected($kode,$id_pr,$id_qrs){
		$cek = $this->mdl_quotation_request_selected->cek_price($kode);
			foreach ($cek as $l) {
				$price = $l->price;
			}
				if($price !=0)
				{
					$this->mdl_quotation_request_selected->update_qr_vendor($id_pr,$id_qrs);
					//cek id_qr dan status menjadi 2
					$this->db->flush_cache();

					$this->db->set('status', "2");

					$this->db->where('id_qr', $kode);
					$this->db->where('id_qrs', $id_qrs);
	
					$result = $this->db->update('tr_qr');
				}else{
					return FALSE;
				}
				
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	// --------------------------------------------------- Delete Vendor -------------------------------------------------------------- //
	function Delete($kode)
	{
		$this->db->flush_cache();
		$this->db->where('id_qr', $kode);
		$result = $this->db->delete('tr_qr');

		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}



	// --------------------------------------------------- Done QRS -------------------------------------------------------------- //
	function done($kode,$id_qrs){
		
		$this->db->flush_cache();

		$this->db->set('status_qrs', "2");

		$this->db->where('id_pr', $kode);
		$this->db->where('id_qrs', $id_qrs);
		$result = $this->db->update('tr_qrs');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function cek_no_vendor($kode,$id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('x.id_pr,x.status');
			$this->db->order_by('x.id_pr', 'asc');
			$this->db->from('tr_qr x');
			$this->db->where('id_pr', $kode);
			$this->db->where('id_qrs', $id_qrs);
			return $this->db->count_all_results();
		$this->db->stop_cache();
	}

	function cek_no_detail($kode,$id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_pr');
			$this->db->order_by('id_pr', 'asc');
			$this->db->from('tr_qrs_detail');
			$this->db->where('id_pr', $kode);
			$this->db->where('id_qrs', $id_qrs);
			return $this->db->count_all_results();
		$this->db->stop_cache();
	}

	function cek_pr_qr($kode,$id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_pr,status');
			$this->db->order_by('id_pr', 'asc');
			$this->db->from('tr_qr');
			$this->db->where('id_pr', $kode);
			$this->db->where('id_qrs', $id_qrs);
			$this->db->where('status', 2);
			return $this->db->count_all_results();
		$this->db->stop_cache();
	}

	// --------------------------------------------------- Add Vendor -------------------------------------------------------------- //

	function Insert_vendor($data)
	{
		$this->db->flush_cache();
		// insert data
    $this->db->set('id_pr', $data['id_pr']);
    $this->db->set('id_qrs', $data['id_qrs']);
    $this->db->set('id_vendor',$data['id_vendor']);
    $this->db->set('top',$data['top']);
    $this->db->set('ETD', $data['date_create']);
    $this->db->set('status',$data['status'] );

		$result = $this->db->insert('tr_qr');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

// ---------------------------------------------------Add QRS -------------------------------------------------------------- //
	function select_pr($data)
	{
		$this->db->select('id_pr,id_ro,status');
		$this->db->from('tr_pr');
		$this->db->where('id_pr', $data['id_pr']);
		$this->db->where('status', 2);
		$this->db->order_by('id_pr', 'asc');
		$query = $this->db->get();
		return $query->row();
		
	}

	function Insert_Qrs($data)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$pr = $this->mdl_quotation_request_selected->select_pr($data);

			$this->db->set('id_pr',$pr->id_pr);
			$this->db->set('id_ro',$pr->id_ro);
			$this->db->set('date_create',$data['date_create']);
			$this->db->set('user_id',$data['user_id']);
			$this->db->set('status',$data['status']);
			$this->db->set('status_qrs',$data['status_qrs']);

			$result = $this->db->insert('tr_qrs');
		$this->db->stop_cache();

		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
// ---------------------------------------------------Detail QRS -------------------------------------------------------------- //

	 function getQrs($id_qrs, $plimit=true){
	# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_detail_qrs';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		

		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_qrs,a.id_qrs,a.id_pr,a.id_detail_pr,a.kode_barang,a.qty,b.nama_barang');
			$this->db->from('tr_qrs_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang','left');

			$this->db->where('a.id_qrs',$id_qrs);

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

// ---------------------------------------------------Search/Autocomplete -------------------------------------------------------------- //

	function searchQrs($data)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_qrs as label,id_ro,status');
			$this->db->order_by('id_qrs', 'asc');
			$this->db->like("id_ro",$data);
			$this->db->where('status', 1);
			$query = $this->db->get('tr_qrs', 100, 0);
			return $query->result();
		$this->db->stop_cache();
	}



// ---------------------------------------------------Insert Detail QRS -------------------------------------------------------------- //

	function select_detail_qrs($id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_pr,a.id_detail_qrs,a.id_pr,a.id_ro,a.kode_barang,a.qty,a.pick,a.sisa,b.id_qrs,c.nama_barang');
			$this->db->from('v_qrs_detail a');
			$this->db->join('tr_qrs b', 'b.id_pr = a.id_pr', 'left');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->where('b.id_qrs',$id_qrs);
			$this->db->where('a.sisa !=', 0);
			$this->db->order_by('a.id_detail_pr', 'asc');
			return $this->db->get()->result_array();
		$this->db->stop_cache();
	}

	function cek_detail($value)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_detail_pr,kode_barang');
			$this->db->where('id_detail_pr', $value);
			return $this->db->get('v_qrs_detail')->row();
		$this->db->stop_cache();
	}

	function cek_id_pr($value,$id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_detail_pr,id_qrs,qty');
			$this->db->where('id_detail_pr', $value);
			$this->db->where('id_qrs', $id_qrs);
			return $this->db->get('tr_qrs_detail')->row();
		$this->db->stop_cache();
	}

	function cek_qty($value,$id_qrs)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_detail_pr,id_qrs,qty');
			$this->db->from('tr_qrs_detail');
			$this->db->where('id_detail_pr', $value);
			$this->db->where('id_qrs', $id_qrs);
			return $this->db->count_all_results();
		$this->db->stop_cache();
	}

	function Insert_Detail_Qrs()
	{
		$pick = $this->input->post('pick');
		$id_qrs = $this->input->post('id_qrs');
		$id_pr = $this->input->post('id_pr');
		$detail = $this->input->post('id_detail_pr');
		$data = explode(',',$detail);
		$pick = explode(',',$pick);
		$z=0;
		foreach ($data as $detail_key => $detail_value) {
			//print_r($pick[$z]);
			if($pick[$z] != 0){
				$item_list = $this->mdl_quotation_request_selected->cek_qty($detail_value,$id_qrs);
				// if($detail_value === $item_id->id_detail_pr && $id_qrs === $item_id->id_qrs){
				if($item_list > 0 ){
					$item_id = $this->mdl_quotation_request_selected->cek_id_pr($detail_value,$id_qrs);
					$this->db->where('id_detail_pr', $item_id->id_detail_pr);
					$this->db->where('id_qrs', $item_id->id_qrs);
					$total[$z] = $pick[$z] + $item_id->qty;
					$this->db->set('qty',$total[$z]);
					$result = $this->db->update('tr_qrs_detail');
					}else{
				$item = $this->mdl_quotation_request_selected->cek_detail($detail_value);
					$this->db->set('id_detail_pr',$item->id_detail_pr);
					$this->db->set('kode_barang',$item->kode_barang);
					$this->db->set('qty',$pick[$z]);
					$this->db->set('id_qrs',$id_qrs);
					$this->db->set('id_pr',$id_pr);
					$this->db->set('status',1);
					$result = $this->db->insert('tr_qrs_detail',$item);
				}
			}
			$z++;
		}
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	// --------------------------------------------------- Delete Detail QRS -------------------------------------------------------------- //
	function delete_detail($kode)
	{
		$this->db->where('id_detail_qrs', $kode);
		$result = $this->db->delete('tr_qrs_detail');

		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	// --------------------------------------------------- Delete QRS -------------------------------------------------------------- //
	function delete_qrs($id_qrs)
	{
		$this->db->where('id_qrs', $id_qrs);
		$result = $this->db->delete('tr_qrs');
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

/* End of file mdl_quotation_request_selected.php */
/* Location: ./application/models/mdl_quotation_request_selected.php */