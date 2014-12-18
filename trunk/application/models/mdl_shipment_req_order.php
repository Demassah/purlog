<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_shipment_req_order extends CI_Model {

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
		$this->db->select('id_sro,id_ro,date_create,id_user,b.full_name');
		$this->db->from('tr_sro a');
		$this->db->join('sys_user b', 'b.user_id = a.id_user');
		$this->db->where('status', 1);
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

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

		$this->db->where('id_sro', $kode);
		$result = $this->db->update('tr_sro');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	public function get_ro()
	{
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('id_ro,user_id,status');
		$this->db->where('status', '6');
		$query = $this->db->get('tr_ro');
		$this->db->stop_cache();
		return $query->result();
	}

	public function search_ro($data)
	{
		$this->db->where('id_ro', $data['id_ro']);
		$query = $this->db->get('tr_ro');
		return $query->row();
	}

	public function update_ro($data)
	{

		$this->db->where('id_ro', $data['id_ro']);
		return $this->db->update('tr_ro', array('status' => 7));

	}

	function Insert($data){
		$this->db->flush_cache();
		// get search
			$result = $this->mdl_shipment_req_order->search_ro($data);
		// update state on tr_ro
			$this->mdl_shipment_req_order->update_ro($data);
		// insert data
    $this->db->set('id_user', $result->user_id);
    $this->db->set('id_ro', $result->id_ro);
    $this->db->set('date_create', $data['date_create']);
    $this->db->set('status',1 );    

		$result = $this->db->insert('tr_sro');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function Cancel($data)
	{
		$this->db->flush_cache();

		$jumlah = count($data['id_detail_pros']);
			for($i=0; $i < $jumlah; $i++) 
			{
			    $id_detail_pros=$data['id_detail_pros'][$i];
			    $this->db->where('id_detail_pros', $id_detail_pros);
			    $result = $this->db->update('tr_pros_detail',array('id_sro' => Null));
			}		
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}

	}
	
	function getdatadetail($id_ro,$id_sro)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('id_detail_pros,id_detail_ro,a.id_ro,id_sro,id_stock,a.kode_barang,qty,id_lokasi,a.status,c.nama_barang');
		$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
		$this->db->where('a.status', 1);
		$this->db->where('id_ro', $id_ro);
		$this->db->where('id_sro', $id_sro);
		$this->db->order_by('a.id_ro','asc' );
		$this->db->stop_cache();

		$query = $this->db->get('tr_pros_detail a');
		return $query->result();
	}

	function getdataadddetail($id_ro)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('id_detail_pros,id_detail_ro,a.id_ro,id_sro,id_stock,a.kode_barang,qty,id_lokasi,a.status,c.nama_barang');
		//$this->db->from('tr_ro_detail a');
		$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
		$this->db->where('a.status', 1);
		$this->db->where('id_ro', $id_ro);
		$this->db->where('id_sro',null);
		$this->db->stop_cache();

		$query = $this->db->get('tr_pros_detail a');
		return $query->result_array();
	}

	
	function Insert_detail($data){
		$this->db->flush_cache();
		// Update Status
		 $jumlah = count($data['id_detail_pros']);
			for($i=0; $i < $jumlah; $i++) 
			{
			    $id_detail_pros=$data['id_detail_pros'][$i];
			    $this->db->where('id_detail_pros', $id_detail_pros);
			    $result = $this->db->update('tr_pros_detail',array('id_sro' =>$data['id_sro']));
			}		
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

} //End

