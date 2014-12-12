<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_barang extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nama_barang';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, b.nama_kategori, c.nama_sub_kategori');
			$this->db->from('ref_barang a');
			$this->db->join('ref_kategori b', 'b.id_kategori = a.id_kategori');
			$this->db->join('ref_sub_kategori c', 'c.id_sub_kategori = a.id_sub_kategori');
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
		$this->db->select('*');
		$this->db->from('ref_barang');
		$this->db->where('id', $kode);
		
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
        $this->db->set('id_kategori', $data['id_kategori']);
        $this->db->set('id_sub_kategori', $data['id_sub_kategori']);
        $this->db->set('kode_barang', $data['kode_barang']);
        $this->db->set('nama_barang', $data['nama_barang']);
        $this->db->set('status', isset($data['status'])?'1':'0');

		$result = $this->db->insert('ref_barang');
		
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
    $this->db->set('id_kategori', $data['id_kategori']);
    $this->db->set('id_sub_kategori', $data['id_sub_kategori']);
    $this->db->set('kode_barang', $data['kode_barang']);
    $this->db->set('nama_barang', $data['nama_barang']);
		
		$this->db->where('id', $data['kode']);
		$result = $this->db->update('ref_barang');
		
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
		
		$this->db->where('id', $kode);
		$result = $this->db->update('ref_barang');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
}

?>