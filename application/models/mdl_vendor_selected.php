<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_vendor_selected extends CI_Model {

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

			$where = "a.status = 1 and a.status_qrs = 3";
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
	
// --------------------------------------------------- Done QRS -------------------------------------------------------------- //
	function done($kode,$id_qrs){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

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

	function cek_pr_qr($kode,$id_qrs)
		{
			$this->db->flush_cache();
			$this->db->start_cache();
				$this->db->select('id_pr,status,id_qrs');
				$this->db->order_by('id_pr', 'asc');
				$this->db->from('tr_qr');
				$this->db->where('id_pr', $kode);
				$this->db->where('id_qrs', $id_qrs);
				$this->db->where('status', 2);
				return $this->db->count_all_results();
			$this->db->stop_cache();
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
		$id_vendor = $this->mdl_vendor_selected->check_tr_qr($id_pr,$id_qrs);
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
		$this->db->select('a.id_qr,a.id_qrs,a.id_pr,a.id_vendor,top,a.ETD,a.status,b.kode_barang,b.price,b.diskon,c.nama_barang,d.name_vendor,b.id_detail_qr,b.id_detail_pr,b.qty');
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
		// --------------------------------------------------- Select Vendor -------------------------------------------------------------- //
	function selected($kode,$id_pr,$id_qrs){
		$cek = $this->mdl_vendor_selected->cek_price($kode);
			foreach ($cek as $l) {
				$price = $l->price;
			}
				if($price !=0)
				{
					$this->mdl_vendor_selected->update_qr_vendor($id_pr,$id_qrs);
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

}

/* End of file mdl_vendor_selected.php */
/* Location: ./application/models/mdl_vendor_selected.php */