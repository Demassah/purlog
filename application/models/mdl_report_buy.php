<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_buy extends CI_Model {

function __construct(){
	    parent::__construct();
    }
	
	function getdata_report_buy($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_po';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';
		$supplier = isset($_POST['supplier']) ? strval($_POST['supplier']) : '';
		$kode_barang = isset($_POST['kode_barang']) ? strval($_POST['kode_barang']) : '';
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_po,b.name_vendor,c.kode_barang,d.nama_barang,c.qty,c.price,a.date_create,(c.qty*c.price) total');
		$this->db->from('tr_po a');
		$this->db->join('tr_qr x', 'x.id_po = a.id_po', 'left');
		$this->db->join('ref_vendor b', 'b.id_vendor = x.id_vendor', 'left');
		$this->db->join('tr_qr_detail c', 'c.id_qr = x.id_qr', 'left');
		$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

		#Filter


		if($date_1 != '' && $date_2 != '') {
			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			}else{
				if ($supplier !='') {
					$cari = "b.name_vendor = '$supplier'";
					$this->db->where($cari);
					}else{
						if($kode_barang !=''){
							$this->db->where('c.kode_barang', $kode_barang);
						}
				}


			//$this->db->where($cari);
			// $this->db->where('a.date_create  >=', $date_1);
			// $this->db->where('a.date_create  <=', $date_2);	
		}

		$this->db->where('x.status','2');
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
			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,b.name_vendor,c.kode_barang,d.nama_barang,c.qty,c.price,a.date_create,(c.qty*c.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qr x', 'x.id_po = a.id_po', 'left');
			$this->db->join('ref_vendor b', 'b.id_vendor = x.id_vendor', 'left');
			$this->db->join('tr_qr_detail c', 'c.id_qr = x.id_qr', 'left');
			$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');

			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_po', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_supp($supplier)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,b.name_vendor,c.kode_barang,d.nama_barang,c.qty,c.price,a.date_create,(c.qty*c.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qr x', 'x.id_po = a.id_po', 'left');
			$this->db->join('ref_vendor b', 'b.id_vendor = x.id_vendor', 'left');
			$this->db->join('tr_qr_detail c', 'c.id_qr = x.id_qr', 'left');
			$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');

			// $cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where('b.name_vendor',$supplier);
			$this->db->order_by('a.id_po', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_kode($kode_barang)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,b.name_vendor,c.kode_barang,d.nama_barang,c.qty,c.price,a.date_create,(c.qty*c.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qr x', 'x.id_po = a.id_po', 'left');
			$this->db->join('ref_vendor b', 'b.id_vendor = x.id_vendor', 'left');
			$this->db->join('tr_qr_detail c', 'c.id_qr = x.id_qr', 'left');
			$this->db->join('ref_barang d', 'd.kode_barang = c.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');

      // $cari = "a.date_create between '$date_1' and '$date_2'";
$this->db->where('c.kode_barang',$kode_barang);
$this->db->order_by('a.id_po', 'asc');       return
$this->db->get()->result();     $this->db->stop_cache();   }

}

/* End of file mdl_report_buy.php */
/* Location: ./application/models/mdl_report_buy.php */