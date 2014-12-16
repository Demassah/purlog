<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_picking extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
	# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, b.full_name, c.departement_name');
			$this->db->from('tr_ro a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');

			$this->db->where('a.status','5');

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

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "6");

		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

/*--------------------------------------- Index -----------------------------------------------------------*/	

	function getdata_detail($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_ro, a.id_ro, a.kode_barang, b.nama_barang, a.sisa');
			$this->db->from('v_pros_detail a');
			//$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			//$this->db->join('tr_ro_detail c', 'c.id_detail_ro = a.id_detail_ro');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.sisa !=', '0');
			//$this->db->where('a.status_delete', '0');

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

	function alocate($kode){
		
		$this->db->flush_cache();
		
		$CI =& get_instance();

		$CI->load->model('mdl_stock');

		// Get ROS Detail
		$this->db->where('id_detail_ro', $kode);
		$ros_get = $this->db->get('v_pros_detail');
		$ros_detail = $ros_get->row();
		$ros_arr = $ros_get->row_array();

		$this->db->flush_cache();


		//#PickingAlocate 
		$stocks = $this->mdl_stock->getStock('kode_barang', $ros_detail->kode_barang);
        $request = $ros_detail->sisa;

        foreach ($stocks->result() as $stock) {
            if($stock->qty >= $request){
                $newQty = $stock->qty - $request;
                $prosQty = $request;
            }elseif($stock->qty < $request){
                $newQty = 0;
                $prosQty = $stock->qty;
            }

            //$request -= $stock->qty;
            //$CI->mdl_stock->updateStock($stock->id_stock, $newQty);
        	
        	// Buat tr_pros_detail
			$params = array(
				'id_detail_ro' => $ros_detail->id_detail_ro,
				'id_ro' => $ros_detail->id_ro,
				//'id_sro' => $ros_detail->id_sro,
				'id_stock' => $stock->id_stock,
				'kode_barang' => $stock->kode_barang,
				'qty' => $prosQty,
				'id_lokasi' => $stock->id_lokasi,
				'status' => 1,
			);
			$result = $this->addProsDetail($params);
            
            if($request == 0) {break;}
        }

        //Pending
        //if($request > 0){
			//$alocQty = $ros_detail->qty - $request;
        	//$this->addPending($ros_arr, $request);	
	    	//$this->db->set('qty', $alocQty);
        //}
    	//$this->db->set('status', '2');
    	//$this->db->where('id_detail_ro', $ros_detail->id_detail_ro);
		
		//$result = $this->db->update('tr_ro_detail');
		//END #PickingAlocate

		// //return
		 if($result) {
		 	return TRUE;
		 }else {
		 	return FALSE;
		 }
	}

	function rosExists($params = array())
	{
		$this->db->flush_cache();

		foreach($params as $key => $val) {
			$this->db->where($key, $val);
		}

		if($this->db->get('tr_ro_detail') == false) {
			return false;
		}
		return true;
	}

	function alocateAll($kode){
		
		$this->db->flush_cache();
		
		// EDIT BY SCC;
		// $this->db->set('status', "2");
		$this->db->where('status', '1');
		$this->db->where('id_ro', $kode);
		$items = $this->db->get('tr_ro_detail');

		foreach ($items->result() as $item) {
			$result = $this->alocate($item->id_detail_ro);
		}
		// END EDIT;
	   	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	/*--------------------------------------- Detail -----------------------------------------------------------*/	

	function getdata_available($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, a.qty, d.nama_barang');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			$this->db->join('tr_ro_detail c', 'c.id_detail_ro = a.id_detail_ro');
			$this->db->join('ref_barang d', 'd.kode_barang = a.kode_barang');
			$this->db->join('tr_stock e', 'e.id_stock = a.id_stock');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.status', '1');
			//$this->db->where('a.status_delete', '0');

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

	function realocateData($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "1");
		
		$this->db->where('id_detail_ro', $kode);
		$result = $this->db->update('tr_pros_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function lockSRO($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "6");
		
		$this->db->where('id_detail_ro', $kode);
		$result = $this->db->update('tr_ro_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function lockAll($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "6");
		$this->db->where('status', '5');
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro_detail');
	   	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function realocateAll($kode){
		
		$this->db->flush_cache();
		
		$this->db->where('status', '5');
		$this->db->set('status', "4");
		
		$this->db->where('id_ro', $kode);
		$result = $this->db->update('tr_ro_detail');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function getdata_input($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, a.qty, d.nama_barang');
			$this->db->from('tr_pros_detail a');
			$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			$this->db->join('tr_ro_detail c', 'c.id_detail_ro = a.id_detail_ro');
			$this->db->join('ref_barang d', 'd.kode_barang = a.kode_barang');
			$this->db->join('tr_stock e', 'e.id_stock = a.id_stock');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.status', '1');
			//$this->db->where('a.status_delete', '0');

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

	function update_stock($data){
		$this->db->trans_start();
		
		$result = true;
		
		# tambah ke tabel
		foreach($data['data_stock']['rows'] as $row){
			
			$this->db->flush_cache();
			$this->db->set('qty', $row['qty']);

			$this->db->where('id_detail_pros', $row['id_detail_pros']);

			$result = $this->db->update('tr_pros_detail');
			
		}
		
		//return
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}

	/*--------------------------------------- Available (picking) -----------------------------------------------------------*/	

	function getdata_lock($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, a.id_ro, a.qty, a.note, c.full_name, d.departement_name, a.kode_barang, e.nama_barang');
			$this->db->from('tr_ro_detail a');
			$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			$this->db->join('sys_user c', 'c.user_id = a.user_id');
			$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.status', '5');
			//$this->db->where('a.status_delete', '0');

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

	/*--------------------------------------- lock -----------------------------------------------------------*/	

	function getdata_pending($id_ro, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_ro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_ro, a.id_ro, a.kode_barang, b.nama_barang, a.sisa');
			$this->db->from('v_pros_detail a');
			//$this->db->join('tr_ro b', 'b.id_ro = a.id_ro');
			//$this->db->join('tr_ro_detail c', 'c.id_detail_ro = a.id_detail_ro');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');

			$this->db->where('a.id_ro', $id_ro);
			$this->db->where('a.sisa !=', '0');
			//$this->db->where('a.status_delete', '0');

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

	// //#addPending BY SCC
	// function addPending($data, $qty){
		
	// 	$this->db->flush_cache();
		
	// 	$data['id_detail_ro'] = null;
	// 	$data['status'] = '7';
	// 	$data['qty'] = $qty;

	// 	$result = $this->db->insert('tr_ro_detail',$data);
	   
	// 	if($result) {
	// 		return TRUE;
	// 	}else{
	// 		return FALSE;
	// 	}
	// }
	// //END #addPending

	//#addProsDetail BY SCC
	function addProsDetail($data){
		
		$this->db->flush_cache();

		$result = $this->db->insert('tr_pros_detail',$data);
	   
		if($result) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//END #addProsDetail
	
}

?>