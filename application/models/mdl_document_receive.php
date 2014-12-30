<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_document_receive extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_receive';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_receive, a.id_sro, a.id_courir, a.date_create, b.name_courir, c.full_name');
			$this->db->from('tr_receive a');
			$this->db->join('ref_courir b', 'b.id_courir = a.id_courir');
			$this->db->join('sys_user c', 'c.user_id = a.id_user');
			$this->db->where('a.status', 1);
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


	function getdata_detail($id_receive, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_detail_receive';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_receive, a.id_receive, a.id_detail_pros, a.id_detail_ro, a.id_ro, a.id_sro, a.kode_barang, c.nama_barang, d.qty AS qty_delivered, a.qty AS qty, a.date_create');
			$this->db->from('tr_receive_detail a');
			$this->db->join('tr_receive b', 'b.id_receive = a.id_receive');
			$this->db->join('ref_barang c', 'c.kode_barang = a.kode_barang');
			$this->db->join('tr_pros_detail d', 'd.id_detail_pros = a.id_detail_pros');

			$this->db->where('b.id_receive', $id_receive);

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


	function get_id_sro($id_receive){
		$this->db->flush_cache();
		$this->db->select('id_sro');
		$this->db->from('tr_receive');
		$this->db->where('id_receive', $id_receive);

		$result = $this->db->get();
		if($result){
			return $result->row()->id_sro;
		}
		return false;
	}


	function getdata_dr($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_sro, a.date_create, a.id_user, b.id_courir, d.name_courir, c.full_name');
			$this->db->from('tr_sro a');
			$this->db->join('tr_do b', 'b.id_do = a.id_do');
			$this->db->join('sys_user c', 'c.user_id = a.id_user');
			$this->db->join('ref_courir d', 'd.id_courir = b.id_courir');
			//$this->db->join('tr_receive_detail e', 'e.id_receive = a.id_receive');
			

			$this->db->where('a.id_sro', $dt['id_sro']);
			$this->db->where('a.status','2');
			//$this->db->where('e.status','0');

		$this->db->limit($dt['jumlah'], 0);
		//$this->db->group_by('id_detail_pr');
		$this->db->group_by('id_sro');
		$this->db->order_by('a.id_sro', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			//$out .= '     <input type="hidden" name="data['.$i.'][id_detail_pr]" value="'.$r->id_detail_pr.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][id_sro]" value="'.$r->id_sro.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][id_courir]" value="'.$r->id_courir.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][id_user]" value="'.$r->id_user.'">';
			//$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
						  
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_sro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_courir.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->date_create.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_user.'</td>';
			$out .= '  <td bgcolor="'.$color.'" align="center">';
			$out .= '   <label>
									<input style="margin-top:2px;" type="checkbox" name="data['.$i.'][chk]" id="checkbox"/>';
			$out .= '  </td>';
			$out .= '</tr>';
			$i++;
		}
		
		return $out;
	}


	function InsertOnDB($data){
		$kosong = true;
		$this->db->trans_start();

		foreach($data as $row){
			if(isset($row['chk'])){
				$kosong = false;

				# insert to table purchase reqeust
				$this->db->flush_cache();
				$this->db->set('id_sro', $row['id_sro']);
				$this->db->set('id_courir', $row['id_courir']);
				$this->db->set('date_create', $row['date_create']);
				$this->db->set('id_user', $row['id_user']);
				$this->db->set('status', '1');

				$this->db->insert('tr_receive');
			}
		}

		$this->db->trans_complete();
		if($kosong) {
			return false;
		}
		return $this->db->trans_status();
	}

	function getProsDetailIds($ids) {
		$this->db->flush_cache();
		$this->db->where_in('id_detail_pros', $ids);
		return $this->db->get('tr_pros_detail');
	}

	function getProsDetail($id) {
		$this->db->flush_cache();
		$this->db->where('id_detail_pros', $id);
		return $this->db->get('tr_pros_detail');
	}

	function update_qty($data){
		$this->db->trans_start();
		
		$result = true;
		
		# tambah ke tabel
		foreach($data['data_qty']['rows'] as $row){
			
			$this->db->flush_cache();
			$this->db->set('qty', $row['qty']);

			$this->db->where('id_detail_receive', $row['id_detail_receive']);

			$result = $this->db->update('tr_receive_detail');
			
		}
		
		
		//$this->db->where('qty', '0');
		//$result = $this->db->delete('tr_pros_detail');

		//return
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

		$this->db->where('id_receive', $kode);
		$result = $this->db->update('tr_receive');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function DeleteOnDB($kode){		
		$this->db->where('id_receive', $kode);
		$result = $this->db->delete('tr_receive');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

}

?>