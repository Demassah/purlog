<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_shipment_req_order extends CI_Model {
    
	function __construct(){
     parent::__construct();
   }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_sro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_sro,id_ro,date_create,id_user,status,b.full_name');
			$this->db->from('tr_sro a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user', 'left');
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

	function detail($id=null,$id_sro=null,$plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_sro';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('id_detail_ro,id_ro,ext_doc_no,kode_barang,qty,user_id,date_create,note,status,id_sro');
			$this->db->from('tr_ro_detail');
			$this->db->where ('id_sro', $id_sro);
			// $this->db->where('status', 3);
			$this->db->where('id_ro', $id);
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
	
		public function add_sro()
	{
		$this->db->select('id_ro,user_id,purpose,cat_req,ext_doc_no,ETD,date_create,status');
		$this->db->where('status', 6);
		$query = $this->db->get('tr_ro');
		return $query->result();
	}

	function InsertOnDb($data){
		$this->db->flush_cache();
      $this->db->set('id_user', $data['user_id']);
      $this->db->set('date_create', $data['date_create']);
      $this->db->set('id_ro', $data['id_ro']);
      $this->db->set('status', 1);

		$result = $this->db->insert('tr_sro');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function add_detail($id=null,$id_sro=null)
	{
			$this->db->flush_cache();
			$this->db->start_cache();
			$this->db->select('id_detail_ro,id_ro,ext_doc_no,a.kode_barang,qty,user_id,date_create,note,id_sro,b.nama_barang');
			// $this->db->from('tr_ro_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->where ('id_sro', '0');
			$this->db->where('a.status', 1);
			$this->db->where('id_ro', $id);
			$this->db->order_by('id_ro');
			$query = $this->db->get('tr_ro_detail a');
		$this->db->stop_cache();
		return $query->result();

		
	}

	public function save_detail($data,$id_sro)
	{
		$this->db->where('kode_barang', $data);
		$this->db->update('tr_ro_detail',array('id_sro' => $id_sro));
	}

	// function add_detail($id=null,$id_sro=null,$plimit=true){
	// 	# get parameter from easy grid
	// 	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
	// 	$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	// 	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_ro';  
	// 	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
	// 	$offset = ($page-1)*$limit;
		
	// 	# create query
	// 	$this->db->flush_cache();
	// 	$this->db->start_cache();
	// 		$this->db->select('id_detail_ro,id_ro,ext_doc_no,a.kode_barang,qty,user_id,date_create,note,id_sro,b.nama_barang');
	// 		$this->db->from('tr_ro_detail a');
	// 		$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
	// 		$this->db->where ('id_sro', '0');
	// 		$this->db->where('a.status', 1);
	// 		$this->db->where('id_ro', $id);
	// 		$this->db->order_by($sort, $order);
	// 	$this->db->stop_cache();
		
	// 	# get count
	// 	$tmp['row_count'] = $this->db->get()->num_rows();
		
	// 	# get data
	// 	if($plimit == true){
	// 		$this->db->limit($limit, $offset);
	// 	}
	// 	$tmp['row_data'] = $this->db->get();
		
	// 	return $tmp;
	// }
	
}

?>