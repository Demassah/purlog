<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_sub_kategori extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }

  function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nama_sub_kategori';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, b.nama_kategori');
			$this->db->from('ref_sub_kategori a');
			$this->db->join('ref_kategori b', 'b.id_kategori = a.id_kategori');
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
	
	function getsingledata(){
		$this->db->flush_cache();
		$this->db->select('DISTINCT *',false);
		$this->db->from('ref_sub_kategori');		
		
		return $this->db->get()->row();
	}

	function InsertOnDb($data){
		//query insert data		
		$this->db->flush_cache();
		$this->db->set('id_kategori', $data['id_kategori']);
		$this->db->set('nama_sub_kategori', $data['nama_sub_kategori']);
		
		$result = $this->db->insert('ref_sub_kategori');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function getdataedit($kode){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('ref_sub_kategori');
		$this->db->where('id_sub_kategori', $kode);
		
		return $this->db->get();
	}

	function UpdateOnDb($data){
		//query insert data		
		$this->db->flush_cache();
		$this->db->set('id_kategori', $data['id_kategori']);
		$this->db->set('nama_sub_kategori', $data['nama_sub_kategori']);

		
		$this->db->where('id_sub_kategori', $data['kode']);
		$result = $this->db->update('ref_sub_kategori');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function DeleteOnDb($kode){		
		$this->db->where('id_sub_kategori', $kode);
		$result = $this->db->delete('ref_sub_kategori');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}
	
}

?>