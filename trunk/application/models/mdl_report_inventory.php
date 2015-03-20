<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_report_inventory extends CI_Model {

		function getdata_report_inventory($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		// $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'c.id_stock';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$date_1 = isset($_POST['date_1']) ? strval($_POST['date_1']) : '';
		//$date_2 = isset($_POST['date_2']) ? strval($_POST['date_2']) : '';
		$supplier = isset($_POST['supplier']) ? strval($_POST['supplier']) : '';
		$kode_barang = isset($_POST['kode_barang']) ? strval($_POST['kode_barang']) : '';
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$query = $this->db->query("select a.id_detail_in, a.id_in, c.id_stock, a.kode_barang, a.qty as masuk, coalesce(sum(d.qty),0) as keluar, (a.qty - coalesce(sum(d.qty),0)) as stock, c.price, c.id_lokasi, x.nama_barang
			from tr_in_detail a
			JOIN ref_barang x	on x.kode_barang = a.kode_barang
			LEFT JOIN tr_in b	on a.id_in = b.id_in
			LEFT JOIN tr_stock c	on a.id_detail_in = c.id_detail_in
			LEFT JOIN tr_pros_detail d on c.id_stock = d.id_stock and DATE_FORMAT(d.date_create,'%Y-%m-%d') BETWEEN '$date_1' and NOW()

			where DATE_FORMAT(b.date_create,'%Y-%m-%d') BETWEEN '$date_1' and NOW()
			GROUP BY id_detail_in ASC;");
		// $this->db->select(' a.id_detail_in, a.id_in, c.id_stock, a.kode_barang, x.nama_barang, c.price, c.id_lokasi, a.qty masuk, sum(d.qty) keluar, (a.qty - sum(d.qty)) stock,b.date_create');
		// $this->db->from('tr_in_detail a');
		// $this->db->join('ref_barang x', 'x.kode_barang = a.kode_barang', 'left');
		// $this->db->join('tr_in b', 'b.id_in = a.id_in', 'left');
		// $this->db->join('tr_stock c', 'c.id_detail_in = a.id_detail_in', 'left');


		// if($date_1 != '') {
		// 	$date_2 = '2015-02-03';
		// 	$cari = "d.id_stock = c.id_stock and d.date_create between '$date_1' and '$date_2'";
		// 	$this->db->join('tr_pros_detail d',$cari,'left');
		// 	//$cari = "d.id_stock = c.id_stock and d.date_create between '$date_1' and now()";
		// 	$cari2 = "b.date_create between '$date_1' and '$date_2'";
		// 	$this->db->where($cari2);
		// 	}else{
		// 		// if ($supplier !='') {
		// 		// 	$cari = "g.name_vendor = '$supplier'";
		// 		// 	$this->db->where($cari);
		// 		// 	}else{
		// 				if($kode_barang !=''){
		// 					$this->db->where('a.kode_barang', $kode_barang);
		// 				}else{
		// 					$this->db->join('tr_pros_detail d', 'd.id_stock = c.id_stock', 'left');
		// 				}
		// 		//}
		// 	}

		
		// $this->db->where('a.status','1');
		// $this->db->group_by('id_detail_in asc');
		// $this->db->order_by($sort, $order);
		$this->db->stop_cache();
		
		# get count
		$tmp['row_count'] = $query->num_rows();
		
		# get data
		if($plimit == true){
			$this->db->limit($limit, $offset);
		}
		$tmp['row_data'] = $query;
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
/* --------------------------------Report Excel -------------------------------------- */
function report_inventory_excel_kode($date_1)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$query = $this->db->query("select a.id_detail_in, a.id_in, c.id_stock, a.kode_barang, a.qty as masuk, coalesce(sum(d.qty),0) as keluar, (a.qty - coalesce(sum(d.qty),0)) as stock, c.price, c.id_lokasi, x.nama_barang,b.date_create
			from tr_in_detail a
			JOIN ref_barang x	on x.kode_barang = a.kode_barang
			LEFT JOIN tr_in b	on a.id_in = b.id_in
			LEFT JOIN tr_stock c	on a.id_detail_in = c.id_detail_in
			LEFT JOIN tr_pros_detail d on c.id_stock = d.id_stock and DATE_FORMAT(d.date_create,'%Y-%m-%d') BETWEEN '$date_1' and NOW()

			where DATE_FORMAT(b.date_create,'%Y-%m-%d') BETWEEN '$date_1' and NOW()
			GROUP BY id_detail_in ASC;");
		return	$query;     
	$this->db->stop_cache();   

	}

}

/* End of file mdl_report_inventory.php */
/* Location: ./application/models/mdl_report_inventory.php */

