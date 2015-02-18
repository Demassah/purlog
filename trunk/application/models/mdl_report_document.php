<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_document extends CI_Model {

	function __construct(){
	    parent::__construct();
    }
	
	function getdata_report_document($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_receive';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';

		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_receive, a.id_receive, a.id_detail_pros, a.id_detail_ro, a.id_ro, a.id_sro, a.kode_barang, c.nama_barang, d.qty AS qty_delivered, a.qty AS qty, a.date_create, b.id_courir, e.name_courir, b.date_create');
			$this->db->from('tr_receive_detail a');
			$this->db->join('tr_receive b', 'b.id_receive = a.id_receive');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->join('tr_pros_detail d', 'd.id_detail_pros = a.id_detail_pros');
			$this->db->join('ref_courir e', 'e.id_courir = b.id_courir');
			$this->db->where('b.status', '1');
			$this->db->where('a.status', '1');

		#Filter
		if($date_1 != '' && $date_2 != '') {
			$this->db->where('a.date_create  >=', $date_1);
			$this->db->where('a.date_create  <=', $date_2);	
				// $this->db->where("a.date_create BETWEEN $date_1 AND $date_2");
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

	function report_document_excel($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_receive, a.id_receive, a.id_detail_pros, a.id_detail_ro, a.id_ro, a.id_sro, a.kode_barang, c.nama_barang, d.qty AS qty_delivered, a.qty AS qty, a.date_create, b.id_courir, e.name_courir, b.date_create');
			$this->db->from('tr_receive_detail a');
			$this->db->join('tr_receive b', 'b.id_receive = a.id_receive');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->join('tr_pros_detail d', 'd.id_detail_pros = a.id_detail_pros');
			$this->db->join('ref_courir e', 'e.id_courir = b.id_courir');
			$this->db->where('b.status', '1');
			$this->db->where('a.status', '1');

			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_receive', 'asc');
			return $this->db->get();
		$this->db->stop_cache();
	}

	function report_document_pdf($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_receive, a.id_receive, a.id_detail_pros, a.id_detail_ro, a.id_ro, a.id_sro, a.kode_barang, c.nama_barang, d.qty AS qty_delivered, a.qty AS qty, a.date_create, b.id_courir, e.name_courir, b.date_create');
			$this->db->from('tr_receive_detail a');
			$this->db->join('tr_receive b', 'b.id_receive = a.id_receive');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->join('tr_pros_detail d', 'd.id_detail_pros = a.id_detail_pros');
			$this->db->join('ref_courir e', 'e.id_courir = b.id_courir');
			$this->db->where('b.status', '1');
			$this->db->where('a.status', '1');
			
			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			// $this->db->where('a.date_create  >=', $date_1);
			// $this->db->where('a.date_create  <=', $date_2);
			$this->db->order_by('a.id_receive', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}


}

/* End of file mdl_report.php */
/* Location: ./application/models/mdl_report.php */