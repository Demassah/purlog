<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_in extends CI_Model {

	function __construct(){
	    parent::__construct();
    }
	
	function getdata_report_inbound($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_in';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';

		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_in,a.ext_rec_no,a.date_create,a.type,a.user_id,b.full_name,c.id_detail_in,c.kode_barang,c.qty,c.ext_rec_no_detail,c.lokasi,d.nama_barang');
		$this->db->from('tr_in a');
		$this->db->join('sys_user b', 'b.user_id = a.user_id','left');
		$this->db->join('tr_in_detail c', 'c.id_in = a.id_in', 'left');
		$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

		#Filter


		if($date_1 != '' && $date_2 != '') {
			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			// $this->db->where('a.date_create  >=', $date_1);
			// $this->db->where('a.date_create  <=', $date_2);	
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

	function report_in_excel($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_in,a.ext_rec_no,a.date_create,a.type,a.user_id,b.full_name,c.id_detail_in,c.kode_barang,c.qty,c.ext_rec_no_detail,c.lokasi,d.nama_barang');
			$this->db->from('tr_in a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id','left');
			$this->db->join('tr_in_detail c', 'c.id_in = a.id_in', 'left');
			$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			// $this->db->where('a.date_create  >=', $date_1);
			// $this->db->where('a.date_create  <=', $date_2);
			$this->db->where('a.status', 1);
			$this->db->order_by('a.id_in', 'asc');
			return $this->db->get();
		$this->db->stop_cache();
	}

	function report_in_pdf($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_in,a.ext_rec_no,a.date_create,a.type,a.user_id,b.full_name,c.id_detail_in,c.kode_barang,c.qty,c.ext_rec_no_detail,c.lokasi,d.nama_barang,departement_name');
			$this->db->from('tr_in a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id','left');
			$this->db->join('tr_in_detail c', 'c.id_in = a.id_in', 'left');
			$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');
			$this->db->join('ref_departement e ', 'e.departement_id = b.departement_id', 'left');
			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			// $this->db->where('a.date_create  >=', $date_1);
			// $this->db->where('a.date_create  <=', $date_2);
			$this->db->where('a.status', 1);
			$this->db->order_by('a.id_in', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}


}

/* End of file mdl_report.php */
/* Location: ./application/models/mdl_report.php */