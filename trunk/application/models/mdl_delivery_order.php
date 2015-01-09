<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_delivery_order extends CI_Model {
    
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
			$this->db->select('id_do,date_create,b.name_courir,c.full_name');
			$this->db->from('tr_do a');
			$this->db->join('ref_courir b', 'b.id_courir = a.id_courir', 'left');
			$this->db->join('sys_user c', 'c.user_id = a.id_user', 'left');
			$this->db->where('a.status', 1);
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
	function cek_sro($kode)
	{
		$this->db->select('id_do');
		$this->db->where('id_do', $kode);
		$this->db->from('tr_sro');
		return $this->db->count_all_results();
	}
	function done($kode){
		
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->set('status', "2");
			$this->db->where('id_do', $kode);
			$result = $this->db->update('tr_do');
		$this->db->stop_cache();

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function delete($kode)
	{
		$this->db->flush_cache();
		$this->db->where('id_do', $kode);
		$result = $this->db->delete('tr_do');

		if($result) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function InsertOnDb($data){
		$this->db->flush_cache();
        $this->db->set('id_user', $data['id_user']);
        $this->db->set('id_courir', $data['id_courir']);
        $this->db->set('date_create',$data['date']);
        $this->db->set('status', $data['status']);

		$result = $this->db->insert('tr_do');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function getdatadetail($id_do)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_sro,id_ro,id_do,date_create,id_user,a.status,b.full_name');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->where('id_do', $id_do);
			$this->db->order_by('id_do', 'asc');
			$this->db->stop_cache();

			$query = $this->db->get('tr_sro a');

			return $query->result();

		

	}


	// detail sro
		function getdataadddetail()
	{
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('id_sro,id_ro,id_do,date_create,id_user,a.status,b.full_name');
		$this->db->join('sys_user b', 'b.user_id = a.id_user');
		$this->db->where('a.status', 2);
		$this->db->where('id_do', null);
		$this->db->stop_cache();

		$query = $this->db->get('tr_sro a');

		return $query->result_array();
	}

	// add sro
	function Insert_detail($data){
		$this->db->flush_cache();
		 $jumlah = count($data['id_sro']);
			for($i=0; $i < $jumlah; $i++) 
			{
			    $id_sro=$data['id_sro'][$i];
			    $this->db->where('id_sro', $id_sro);
			    $result = $this->db->update('tr_sro',array('id_do' =>$data['id_do']));
			}	
		
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

		$jumlah = count($data['id_sro']);
			for($i=0; $i < $jumlah; $i++) 
			{
			    $id_detail_pros=$data['id_sro'][$i];
			    $this->db->where('id_sro', $id_detail_pros);
			    $result = $this->db->update('tr_sro',array('id_do' => Null));
			}		
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}

	}

	// detail ro
	function detail_ro($id_sro='')
	{
		$this->db->select('a.id_detail_pros,a.id_detail_ro,a.id_ro,a.id_sro,a.id_stock,a.kode_barang,a.qty,a.id_lokasi,b.nama_barang');
		$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
		// $this->db->select('a.id_detail_ro,a.id_ro,a.id_sro,a.id_stock,a.kode_barang,a.qty,a.id_lokasi,a.date_create,c.nama_barang');
		// $this->db->join('tr_ro d', 'd.id_ro = a.id_ro');
		// $this->db->join('sys_user b', 'b.user_id = d.user_id');
		// $this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');		
		// $this->db->join('tr_ro_detail e', 'e.id_ro = d.id_ro');

		$this->db->where('a.id_sro', $id_sro);

		$query = $this->db->get('tr_pros_detail a');

		return $query->result();
	}



	
}


?>