<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_return extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_return';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$id_return = isset($_POST['id_return']) ? strval($_POST['id_return']) : '';
		$id_receive = isset($_POST['id_receive']) ? strval($_POST['id_receive']) : '';
		
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_return, a.id_receive, a.date_create, a.status, a.user_id, c.full_name');
			$this->db->from('tr_return a');
			$this->db->join('tr_receive b', 'b.id_receive = a.id_receive');
			$this->db->join('sys_user c', 'c.user_id = a.user_id', 'left');

			#Filter
			if($id_return != ''){
					$this->db->like('a.id_return', $id_return);
			}

			if($id_receive != '') {
					$this->db->like('a.id_receive', $id_receive);
			}

			$this->db->where('a.status',1);
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

	function getdata_add_return($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_receive, a.date_create, a.status, a.id_user, b.full_name');
			$this->db->from('tr_receive a');
			$this->db->join('sys_user b', 'b.user_id = a.id_user');

			$this->db->where('a.id_receive', $dt['id_receive']);
			$this->db->where('a.status','2');

		$this->db->limit($dt['jumlah'], 0);
		$this->db->group_by('id_receive');
		$this->db->order_by('a.id_receive', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			$out .= '     <input type="hidden" name="data['.$i.'][id_receive]" value="'.$r->id_receive.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][user_id]" value="'.$r->id_user.'">';
			
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_receive.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->date_create.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->full_name.'</td>';
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
				$this->db->set('id_receive', $row['id_receive']);
				$this->db->set('date_create', $row['date_create']);
				$this->db->set('user_id', $row['user_id']);
				$this->db->set('status', '1');

				$this->db->insert('tr_return');
			}
		}

		$this->db->trans_complete();
		if($kosong) {
			return false;
		}
		return $this->db->trans_status();
	}


	function getdata_detail($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_detail_return';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('a.id_detail_return, a.id_return, a.id_receive, a.id_detail_receive, a.id_detail_pros, a.id_ro, a.id_detail_ro, a.kode_barang, a.qty, a.date_create, a.status, b.nama_barang');
			$this->db->from('tr_return_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->where('a.status',2);
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

	function get_id_receive($id_return){
		$this->db->flush_cache();
		$this->db->select('id_receive');
		$this->db->from('tr_return');
		$this->db->where('id_return', $id_return);

		$result = $this->db->get();
		if($result){
			return $result->row()->id_receive;
		}
		return false;
	}

	function getdata_add_detail_return($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_detail_return, a.id_receive, a.id_detail_receive, a.id_detail_pros, a.id_ro, a.id_detail_ro, a.kode_barang, a.qty, a.date_create, a.status, b.nama_barang');
			$this->db->from('tr_return_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			
			//var_dump($dt); exit();
			$this->db->where('a.id_return', $dt['id_return']);
			$this->db->where('a.status','1');
			$this->db->where('a.id_return','0');

		$this->db->limit($dt['jumlah'], 0);
		$this->db->group_by('a.id_return');
		$this->db->order_by('a.id_return', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			$out .= '     <input type="hidden" name="data['.$i.'][id_detail_return]" value="'.$r->id_detail_return.'">';
						  
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_receive.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_detail_receive.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_detail_pros.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_ro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_detail_ro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->kode_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->nama_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->qty.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->date_create.'</td>';
			$out .= '  <td bgcolor="'.$color.'" align="center">';
			$out .= '   <label>
									<input style="margin-top:2px;" type="checkbox" name="data['.$i.'][chk]" id="checkbox"/>';
			$out .= '  </td>';
			$out .= '</tr>';
			$i++;
		}
		
		return $out;
	}

	function InsertDetailOnDB($data){
		$data_kosong = true;
		$this->db->trans_start();

		foreach($data as $row){
			if(isset($row['chk']) && $row['chk'] == 'on'){
				$data_kosong = false;
				
				# update table purchase request detail
				$this->db->flush_cache();
				$this->db->set('status', '2');
				if(isset($data['id_return'])){
					$this->db->set('id_return', $data['id_return']);
				}
				//var_dump($row); exit();
				$this->db->where('id_detail_return', $row['id_detail_return']);
				$this->db->update('tr_return_detail');
			}
		}

		$this->db->trans_complete();
		if($data_kosong) {
			return false;
		}
		return $this->db->trans_status();
	}

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

		$this->db->where('id_return', $kode);
		$result = $this->db->update('tr_return');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

} //End

?>