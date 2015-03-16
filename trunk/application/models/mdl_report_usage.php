<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_usage extends CI_Model {
function __construct(){
	   parent::__construct();
   }

	function getdata_report_usage($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_detail_pros';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';
		$no_rangka = isset($_POST['no_rangka']) ? strval($_POST['no_rangka']) : '';
		$kode_barang = isset($_POST['kode_barang']) ? strval($_POST['kode_barang']) : '';
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_detail_pros,a.qty,a.kode_barang,b.date_create,c.no_rangka,c.no_polisi,d.price,e.nama_barang,(a.qty*d.price) total');
		$this->db->from('tr_pros_detail a');
		$this->db->join('tr_sro b', 'b.id_sro = a.id_sro');
		$this->db->join('tr_ro c', 'c.id_ro = a.id_ro');
		$this->db->join('tr_stock d', 'd.id_stock = a.id_stock');
		$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');
		

			if($date_1 != '' && $date_2 != '') {
			$cari = "b.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			}else{
				if ($no_rangka !='') {
					$cari = "c.no_rangka = '$no_rangka'";
					$this->db->where($cari);
					}else{
						if($kode_barang !=''){
							$this->db->where('a.kode_barang', $kode_barang);
						}
				}
		}	
		$this->db->where('b.status','2');
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
	
		function report_delivery_pdf($date_1,$date_2)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_pros,c.purpose,c.cat_req,c.ext_doc_no,c.ETD,y.full_name,z.departement_name,a.kode_barang,e.nama_barang,a.qty,d.price,a.date_create,(a.qty*d.price) total,c.no_rangka,c.no_polisi');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_sro b', 'b.id_sro = a.id_sro');
			$this->db->join('tr_ro c', 'c.id_ro = a.id_ro');
			$this->db->join('tr_stock d', 'd.id_stock = a.id_stock');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->join('sys_user y', 'y.user_id = c.user_id');
			$this->db->join('ref_departement z', 'z .departement_id = y.departement_id');

			$cari = "b.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_detail_pros', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_rangka($no_rangka)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_pros,c.purpose,c.cat_req,c.ext_doc_no,c.ETD,y.full_name,z.departement_name,a.kode_barang,e.nama_barang,a.qty,d.price,a.date_create,(a.qty*d.price) total,c.no_rangka,c.no_polisi');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_sro b', 'b.id_sro = a.id_sro');
			$this->db->join('tr_ro c', 'c.id_ro = a.id_ro');
			$this->db->join('tr_stock d', 'd.id_stock = a.id_stock');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->join('sys_user y', 'y.user_id = c.user_id');
			$this->db->join('ref_departement z', 'z .departement_id = y.departement_id');

			// $cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where('c.no_rangka',$no_rangka);
			$this->db->order_by('a.id_detail_pros', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_polisi($no_polisi)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_pros,c.purpose,c.cat_req,c.ext_doc_no,c.ETD,y.full_name,z.departement_name,a.kode_barang,e.nama_barang,a.qty,d.price,a.date_create,(a.qty*d.price) total,c.no_rangka,c.no_polisi');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_sro b', 'b.id_sro = a.id_sro');
			$this->db->join('tr_ro c', 'c.id_ro = a.id_ro');
			$this->db->join('tr_stock d', 'd.id_stock = a.id_stock');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->join('sys_user y', 'y.user_id = c.user_id');
			$this->db->join('ref_departement z', 'z .departement_id = y.departement_id');

			// $cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where('c.no_polisi',$no_polisi);
			$this->db->order_by('a.id_detail_pros', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_kode($kode_barang)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_pros,c.purpose,c.cat_req,c.ext_doc_no,c.ETD,y.full_name,z.departement_name,a.kode_barang,e.nama_barang,a.qty,d.price,a.date_create,(a.qty*d.price) total,c.no_rangka,c.no_polisi');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_sro b', 'b.id_sro = a.id_sro');
			$this->db->join('tr_ro c', 'c.id_ro = a.id_ro');
			$this->db->join('tr_stock d', 'd.id_stock = a.id_stock');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->join('sys_user y', 'y.user_id = c.user_id');
			$this->db->join('ref_departement z', 'z .departement_id = y.departement_id');

      // $cari = "a.date_create between '$date_1' and '$date_2'";
		$this->db->where('a.kode_barang',$kode_barang);
		$this->db->order_by('a.id_detail_pros', 'asc');       return
		$this->db->get()->result();     $this->db->stop_cache();   

	}

}

/* End of file mdl_report_usage.php */
/* Location: ./application/models/mdl_report_usage.php */