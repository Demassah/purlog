<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_purchase_order extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_pr';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_pr,a.id_ro,a.requestor,a.purpose,a.cat_req,a.ext_doc_no,a.ETD,a.status,b.departement_id,c.full_name,b.departement_name');
			$this->db->from('tr_po a');
			$this->db->join('ref_departement b', 'b.departement_id = a.departement');
			$this->db->join('sys_user c', 'c.user_id = a.requestor');
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

	function search_pr($data)
	{
		$this->db->select('*');
		$this->db->where('id_pr', $data['id_pr']);
		$query = $this->db->get('tr_pr');
		return $query->row();

	}
	function search_qr($data)
	{
		$this->db->select('id_qr');
		$this->db->where('id_pr', $data['id_pr']);
		$this->db->where('status', 2);
		$query = $this->db->get('tr_qr');
		return $query->row();
	}
	function Insert_qrs($data)
	{
		// function searc
		$pr = $this->mdl_purchase_order->search_pr($data);
		$qr = $this->mdl_purchase_order->search_qr($data);

		// function select
		$this->db->set('id_pr',$pr->id_pr);
		$this->db->set('id_ro',$pr->id_ro);
		$this->db->set('id_qr',$qr->id_qr);
		$this->db->set('requestor',$data['user_id']);
		$this->db->set('departement',$data['departement_id']);
		$this->db->set('purpose',$pr->purpose);
		$this->db->set('cat_req',$pr->cat_req);
		$this->db->set('ETD',$pr->ETD);
		$this->db->set('ext_doc_no',$pr->ext_doc_no);
		$this->db->set('date_create',$data['date_create']);
		$this->db->set('status',$data['status']);

		// function Insert
		$result = $this->db->insert('tr_po');

		// function Notif
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}

	}
	
} //End

?>