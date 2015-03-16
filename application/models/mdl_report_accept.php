<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_accept extends CI_Model {

	function __construct(){
	   parent::__construct();
   }

	function getdata_report_accept($plimit=true){
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
		$this->db->select('a.id_po, g.name_vendor, f.kode_barang, h.nama_barang, d.qty dipesan, f.qty diterima, d.price, a.date_create, (f.qty*d.price) total');
		$this->db->from('tr_po a');
		$this->db->join('tr_qrs b', 'b.id_po = a.id_po');
			$join_qr = "c.id_qrs = b.id_qrs and c.id_po = b.id_po";
		$this->db->join('tr_qr c', $join_qr);
		$this->db->join('tr_qr_detail d', 'd.id_qr = c.id_qr');
		$this->db->join('tr_in e', 'e.ext_rec_no = c.id_po');
			$join = "f.id_in = e.id_in and f.kode_barang = d.kode_barang";
		$this->db->join('tr_in_detail f', $join);
		$this->db->join('ref_vendor g', 'g.id_vendor = c.id_vendor');
		$this->db->join('ref_barang h', 'h.kode_barang = f.kode_barang');

			if($date_1 != '' && $date_2 != '') {
			$cari = "a.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			}else{
				if ($supplier !='') {
					$cari = "g.name_vendor = '$supplier'";
					$this->db->where($cari);
					}else{
						if($kode_barang !=''){
							$this->db->where('f.kode_barang', $kode_barang);
						}
				}

		}
		$this->db->where('e.status','2');
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
			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,g.name_vendor,f.kode_barang,h.nama_barang,d.qty diterima,f.qty dipesan,d.price,a.date_create,(f.qty*d.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qrs b', 'b.id_po = a.id_po', 'left');
			$join_qr = "c.id_qrs = b.id_qrs and c.id_po = b.id_po";
			$this->db->join('tr_qr c', $join_qr, 'left');
			$this->db->join('tr_qr_detail d', 'd.id_qr = c.id_qr', 'left');
			$this->db->join('tr_in e', 'e.ext_rec_no = c.id_po', 'left');
				$join = "f.id_in = e.id_in and f.kode_barang = d.kode_barang";
			$this->db->join('tr_in_detail f', $join, 'left');
			$this->db->join('ref_vendor g', 'g.id_vendor = c.id_vendor', 'left');
			$this->db->join('ref_barang h', 'h.kode_barang = f.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');

			$cari = "e.date_create between '$date_1' and '$date_2'";
			$this->db->where($cari);
			$this->db->order_by('a.id_po', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_supp($supplier)
	{
		$this->db->flush_cache();
		$this->db->start_cache();

			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,g.name_vendor,f.kode_barang,h.nama_barang,d.qty diterima,f.qty dipesan,d.price,a.date_create,(f.qty*d.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qrs b', 'b.id_po = a.id_po', 'left');
				$join_qr = "c.id_qrs = b.id_qrs and c.id_po = b.id_po";
			$this->db->join('tr_qr c', $join_qr, 'left');
			$this->db->join('tr_qr_detail d', 'd.id_qr = c.id_qr', 'left');
			$this->db->join('tr_in e', 'e.ext_rec_no = c.id_po', 'left');
				$join = "f.id_in = e.id_in and f.kode_barang = d.kode_barang";
			$this->db->join('tr_in_detail f', $join, 'left');
			$this->db->join('ref_vendor g', 'g.id_vendor = c.id_vendor', 'left');
			$this->db->join('ref_barang h', 'h.kode_barang = f.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');

			$this->db->where('g.name_vendor',$supplier);
			$this->db->order_by('a.id_po', 'asc');
			return $this->db->get()->result();
		$this->db->stop_cache();
	}

	function report_delivery_pdf_kode($kode_barang)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_po,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,y.full_name,z.departement_name,g.name_vendor,f.kode_barang,h.nama_barang,d.qty diterima,f.qty dipesan,d.price,a.date_create,(f.qty*d.price) total');
			$this->db->from('tr_po a');
			$this->db->join('tr_qrs b', 'b.id_po = a.id_po', 'left');
				$join_qr = "c.id_qrs = b.id_qrs and c.id_po = b.id_po";
			$this->db->join('tr_qr c', $join_qr, 'left');
			$this->db->join('tr_qr_detail d', 'd.id_qr = c.id_qr', 'left');
			$this->db->join('tr_in e', 'e.ext_rec_no = c.id_po', 'left');
				$join = "f.id_in = e.id_in and f.kode_barang = d.kode_barang";
			$this->db->join('tr_in_detail f', $join, 'left');
			$this->db->join('ref_vendor g', 'g.id_vendor = c.id_vendor', 'left');
			$this->db->join('ref_barang h', 'h.kode_barang = f.kode_barang', 'left');

			$this->db->join('sys_user y', 'y.user_id = a.requestor');
			$this->db->join('ref_departement z', 'z .departement_id = a.departement');


		$this->db->where('f.kode_barang',$kode_barang);
		$this->db->order_by('a.id_po', 'asc');       return
		$this->db->get()->result();     $this->db->stop_cache();   

	}

}

/* End of file mdl_report_accept.php */
/* Location: ./application/models/mdl_report_accept.php */