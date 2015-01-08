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

/*---------------------Option Inbound--------------------------------------- */
	function select_po(){
		$this->db->select('a.id_pr,a.id_po,a.sisa');
		$this->db->order_by('a.id_pr', 'asc');
		$this->db->where('sisa !=',0);
		$this->db->group_by('a.id_po');
		$query = $this->db->get('v_po_inbound a');
		return $query->result();
	}

	function OptionInbound($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$id_po_re = isset($d['id_po_re'])?$d['id_po_re']:'';
		if($id_po_re == 1){
			$this->db->flush_cache();
			$this->db->start_cache();
				$list = $this->mdl_inbound->select_po();
				$id = '';
				foreach ($list as $l) {
					$id = $l->id_po;
					$this->db->where('b.id_po =', $id);
				}
				$this->db->select('b.id_po');
				$this->db->order_by('b.id_po', 'asc');
				$res = $this->db->get('tr_po b');
			$this->db->stop_cache();

			$out = '<option value="">-- Pilih ID --</option>';
			foreach($res->result() as $r){
				if(trim($r->id_po) == trim($value)){
					$out .= '<option value="'.$r->id_po.'" selected="selected">'.$r->id_po.'</option>';
				}else{
					$out .= '<option value="'.$r->id_po.'">'.$r->id_po.'</option>';
				}
			}
		}elseif($id_po_re == 2){
			$this->db->flush_cache();
			$this->db->start_cache();
				$list = $this->mdl_inbound->select_return();
				$id = '';
					foreach ($list as $l) {
						$id = $l->id_return();
						$this->db->where('id_return =', $id);
					}
				$this->db->select('id_return');
				$this->db->order_by('id_return', 'asc');
				$res = $this->db->get('tr_return');
			$this->db->stop_cache();

			$out = '<option value="">-- Pilih --</option>';
			foreach($res->result() as $r){
				if(trim($r->id_return) == trim($value)){
					$out .= '<option value="'.$r->id_return.'" selected="selected">'.$r->id_return.'</option>';
				}else{
					$out .= '<option value="'.$r->id_return.'">'.$r->id_return.'</option>';
				}
			}
		}
		
		return $out;
	}
	/*---------------------Add Inbound--------------------------------------- */

	function Insert_inbound($data='')
	{
		$item = array('ext_rec_no' => $data['id_sub_po_re'],
									'type'=> $data['id_po_re'],
									'date_create'=> $data['date_create'],
									'status' => $data['status'],
									'user_id' => $data['user_id']
									);
		$result = $this->db->insert('tr_in',$item);
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}

	}

	/*---------------------Detail Inbound--------------------------------------- */

	function getdata_detail($id, $plimit=true)
	{
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_detail_in';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_detail_in,a.id_in,a.kode_barang,a.qty,a.ext_rec_no_detail,a.lokasi,a.status,b.nama_barang');
		$this->db->from('tr_in_detail a');
		$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
		$this->db->where('id_in', $id);

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

	function getId($id=null)
	{
		$this->db->select('*');
		$this->db->where('id_in', $id);
		$query = $this->db->get('tr_in');
		return $query->result();
	}
	/*---------------------Done Inbound--------------------------------------- */
	function done($kode)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->set('status','2');
			$this->db->where('id_in', $kode);
			$result = $this->db->update('tr_in');
		$this->db->stop_cache();

		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/*---------------------Add Detail Inbound--------------------------------------- */
	function getIdPr($id)
	{
		$this->db->select('id_pr,id_po');
		$this->db->where('id_po', $id);
		return $this->db->get('tr_pr')->result();
	}

	function get_iddetail($id,$type,$id_in)
	{
		if($type == 1){
			$this->db->select('c.id_detail_pr,c.id_pr,c.id_po,c.kode_barang,c.asal,c.receive,c.sisa,c.nama_barang,a.id_in,a.ext_rec_no,b.id_lokasi,b.kode_barang');
			$this->db->where('id_po', $id);
			$this->db->where('c.sisa !=', 0);
			$this->db->where('a.id_in', $id_in);
			//$this->db->group_by('id_po');
			$this->db->join('tr_stock b', 'b.kode_barang = c.kode_barang');
			$query = $this->db->get('v_po_inbound c,tr_in a');
			$query->result();
			return $query->result();

		}elseif($type == 2){

			$this->db->select('a.kode_barang,a.qty,b.nama_barang');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->order_by('id_return', 'asc');
			$query = $this->db->get('tr_return_detail a');
			return $query->result();
		}
	}

		function Insert_detail($data)
		{
			$jumlah = count($data['detail_id']);
				for($i=0;$i<$jumlah;$i++){
					$this->db->set('id_in',$data['id_in'][$i]);
					$this->db->set('kode_barang',$data['kode_barang'][$i]);
					$this->db->set('ext_rec_no_detail',$data['ext_rec_no'][$i]);
					$this->db->set('qty',$data['receive'][$i]);
					$this->db->set('lokasi',$data['lokasi'][$i]);
					$this->db->set('status',1);

					$result = $this->db->insert('tr_in_detail');
				}

		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
		
	}


/*---------------------Delete Inbound--------------------------------------- */
	function delete($kode)
	{
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->where('id_in', $kode);
			$result = $this->db->delete('tr_in');
		$this->db->stop_cache();

		if($result){
			return TRUE;
		}else{
			return FALSE;
		}

	}


}

/* End of file mdl_inbound.php */
/* Location: ./application/models/mdl_inbound.php */