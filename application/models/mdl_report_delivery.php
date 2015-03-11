<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_delivery extends CI_Model {

	function __construct(){
	    parent::__construct();
    }
	
	function getdata_report_delivery($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_do';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';

		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_sro, a.id_ro, a.id_do, a.date_create, a.id_user, a.status, b.full_name, c.departement_name, e.name_courir');
			$this->db->from('tr_sro a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');
			$this->db->join('tr_do d', 'd.id_do = a.id_do');
			$this->db->join('ref_courir e', 'e.id_courir = d.id_courir');
			$this->db->where('a.status', 2);
			$this->db->where('d.status', 1);

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

	function report_delivery_excel($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_sro, a.id_ro, a.id_do, a.date_create, a.id_user, a.status, b.full_name, c.departement_name, e.name_courir');
			$this->db->from('tr_sro a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');
			$this->db->join('tr_do d', 'd.id_do = a.id_do');
			$this->db->join('ref_courir e', 'e.id_courir = d.id_courir');
			$this->db->where('a.status', 2);
			$this->db->where('d.status', 1);

			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_do', 'asc');
			return $this->db->get();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_kode($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_sro, a.id_ro, a.id_do, a.date_create, a.id_user, a.status, b.full_name, c.departement_name, e.name_courir');
			$this->db->from('tr_sro a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');
			$this->db->join('tr_do d', 'd.id_do = a.id_do');
			$this->db->join('ref_courir e', 'e.id_courir = d.id_courir');
			$this->db->where('a.status', 2);
			$this->db->where('d.status', 1);

			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_do', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}


}

/* End of file mdl_report.php */
/* Location: ./application/models/mdl_report.php */