<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_inbound extends CI_Model {

	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_in';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_in,a.ext_rec_no,a.type,a.date_create,a.status,a.user_id,b.full_name');
			$this->db->from('tr_in a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->where('a.status', '1');
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

	function Insert_inbound($data='')
	{
		// $id_po_re = $data['id_po_re'];
		// if($id_po_re == 1){

			$this->db->set('ext_rec_no',$data['id_sub_po_re']);
			$this->db->set('type',$data['id_po_re']);
			$this->db->set('date_create',$data['date_create']);
			$this->db->set('status',$data['status']);
			$this->db->set('user_id',$data['user_id']);

			$result = $this->db->insert('tr_in');
		// }elseif($id_po_re == 2){

		// 	$this->db->set('ext_rec_no',$data['id_return']);
		// 	$this->db->set('type',$data['id_po_re']);
		// 	$this->db->set('date_create',$data['date_create']);
		// 	$this->db->set('status',1);
		// 	$this->db->set('user_id',$data['user_id']);

		// 	$result = $this->db->insert('tr_in');
		// }

		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}

	}
	

}

/* End of file mdl_inbound.php */
/* Location: ./application/models/mdl_inbound.php */