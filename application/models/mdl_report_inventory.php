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
		$query = $this->db->query("select a.id_stock, a.kode_barang, d.nama_barang, a.price, a.id_lokasi, a.qty as soh, 
			coalesce(sum(b.qty),0) as keluar, coalesce(c.qty,0) as masuk, ((a.qty + coalesce(sum(b.qty),0))- coalesce(c.qty,0)) as stock
			FROM tr_stock a
			left join tr_pros_detail b on a.id_stock = b.id_stock and date_format(b.date_create, '%Y-%m-%d') between '$date_1' and now()
			left join tr_in_detail c on a.id_detail_in = c.id_detail_in and date_format(c.date_create, '%Y-%m-%d') between '$date_1' and now()
			join ref_barang d on a.kode_barang = d.kode_barang
			group by a.id_stock
			HAVING stock <> 0 ;");
				
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
			$query = $this->db->query("select a.id_stock, a.kode_barang, d.nama_barang, a.price, a.id_lokasi, a.qty as soh, 
			coalesce(sum(b.qty),0) as keluar, coalesce(c.qty,0) as masuk, ((a.qty + coalesce(sum(b.qty),0))- coalesce(c.qty,0)) as stock
			FROM tr_stock a
			left join tr_pros_detail b on a.id_stock = b.id_stock and date_format(b.date_create, '%Y-%m-%d') between '$date_1' and now()
			left join tr_in_detail c on a.id_detail_in = c.id_detail_in and date_format(c.date_create, '%Y-%m-%d') between '$date_1' and now()
			join ref_barang d on a.kode_barang = d.kode_barang
			group by a.id_stock
			HAVING stock <> 0
			;");
		return	$query;     
	$this->db->stop_cache();   

	}

}

/* End of file mdl_report_inventory.php */
/* Location: ./application/models/mdl_report_inventory.php */

