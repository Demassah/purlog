<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_soh extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }

  function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_barang';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$id_stock = isset($_POST['id_stock']) ? strval($_POST['id_stock']) : '';
		$id_lokasi = isset($_POST['id_lokasi']) ? strval($_POST['id_lokasi']) : '';
		$kode_barang = isset($_POST['kode_barang']) ? strval($_POST['kode_barang']) : '';
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_stock, a.kode_barang, a.qty, a.price, a.id_lokasi, a.status, b.nama_barang');
			$this->db->from('tr_stock a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');

			#--ID Stock
			if($id_stock != ''){
				$this->db->where('a.id_stock', $id_stock);
			}
			#--ID Lokasi
			if($id_lokasi != ''){
				$this->db->where('a.id_lokasi', $id_lokasi);
			}
			#--ID Barang
			if($kode_barang != ''){
				$this->db->where('a.kode_barang', $kode_barang);
			}

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

}

?>