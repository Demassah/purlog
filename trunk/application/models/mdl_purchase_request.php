<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_purchase_request extends CI_Model {
    
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
			$this->db->from('tr_pr a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('ref_departement c', 'c.departement_id = b.departement_id');

			$this->db->where('a.status','1');

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
	
	function getdata_pr($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_ro, a.user_id, a.purpose, a.cat_req, a.ext_doc_no, a.ETD, a.date_create, a.status, b.full_name, d.id_detail_pr');
			$this->db->from('tr_ro a');
			$this->db->join('sys_user b', 'b.user_id = a.user_id');
			$this->db->join('tr_pr_detail d', 'd.id_ro = a.id_ro');

			$this->db->where('a.id_ro', $dt['id_ro']);
			$this->db->where('a.status','6');
			$this->db->where('d.status','1');

		$this->db->limit($dt['jumlah'], 0);
		//$this->db->group_by('id_detail_pr');
		$this->db->group_by('id_ro');
		$this->db->order_by('a.id_ro', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			$out .= '     <input type="hidden" name="data['.$i.'][id_detail_pr]" value="'.$r->id_detail_pr.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][id_ro]" value="'.$r->id_ro.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][user_id]" value="'.$r->user_id.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][purpose]" value="'.$r->purpose.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][cat_req]" value="'.$r->cat_req.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][ext_doc_no]" value="'.$r->ext_doc_no.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][ETD]" value="'.$r->ETD.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
			//$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
						  
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_ro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->full_name.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->purpose.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->cat_req.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->ext_doc_no.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->ETD.'</td>';
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
	
	function InsertOnDB($data){
		$this->db->trans_start();

		foreach($data as $row){
			if(isset($row['chk'])){
				# update table purchase request detail
				//$this->db->flush_cache();
				//$this->db->set('id_pr', '1');
				//var_dump($row); exit();
				//$this->db->where('id_detail_pr', $row['id_detail_pr']);
				//$this->db->update('tr_pr_detail');

				# insert to table purchase reqeust
				$this->db->flush_cache();
				$this->db->set('id_ro', $row['id_ro']);
				$this->db->set('user_id', $row['user_id']);
				$this->db->set('purpose', $row['purpose']);
				$this->db->set('cat_req', $row['cat_req']);
				$this->db->set('ext_doc_no', $row['ext_doc_no']);
				$this->db->set('ETD', $row['ETD']);
				$this->db->set('date_create', $row['date_create']);
				$this->db->set('status', '1');

				$this->db->insert('tr_pr');
			}
		}

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function done($kode){
		
		$this->db->flush_cache();

		$this->db->set('status', "2");

		$this->db->where('id_pr', $kode);
		$result = $this->db->update('tr_pr');

		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function getdata_detail($id_pr, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_pr';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
			$this->db->select('*, a.id_pr, a.id_ro, a.qty, a.note, c.full_name, d.departement_name, a.kode_barang, e.nama_barang');
			$this->db->from('tr_pr_detail a');
			$this->db->join('tr_pr b', 'b.id_ro = a.id_ro');
			$this->db->join('sys_user c', 'c.user_id = a.user_id');
			$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
			$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

			$this->db->where('a.id_pr', $id_pr);
			//$this->db->where('a.status', '1');
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

	function get_id_ro($id_pr){
		$this->db->flush_cache();
		$this->db->select('id_ro');
		$this->db->from('tr_pr');
		$this->db->where('id_pr', $id_pr);

		$result = $this->db->get();
		if($result){
			return $result->row()->id_ro;
		}
		return false;
	}

	// function getdata_detailpr($id_pr, $plimit=true){
	// 	# get parameter from easy grid
	// 	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
	// 	$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	// 	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_pr';  
	// 	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
	// 	$offset = ($page-1)*$limit;
		
	// 	# create query
	// 	$this->db->flush_cache();
	// 	$this->db->start_cache();
	// 		$this->db->select('*, a.id_pr, a.id_ro, a.qty, a.note, c.full_name, d.departement_name, a.kode_barang, e.nama_barang');
	// 		$this->db->from('tr_pr_detail a');
	// 		$this->db->join('tr_pr b', 'b.id_ro = a.id_ro');
	// 		$this->db->join('sys_user c', 'c.user_id = a.user_id');
	// 		$this->db->join('ref_departement d', 'd.departement_id = c.departement_id');
	// 		$this->db->join('ref_barang e', 'e.kode_barang = a.kode_barang');

	// 		$this->db->where('a.id_pr', $id_pr);
	// 		$this->db->where('a.status', '1');
	// 		//$this->db->where('a.status_delete', '0');

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

	function getdata_detailpr($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_detail_pr, a.id_ro, a.id_detail_ro, a.kode_barang, b.nama_barang, a.qty, c.full_name, a.date_create, a.note');
			$this->db->from('tr_pr_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->join('sys_user c', 'c.user_id = a.user_id');
			//var_dump($dt); exit();
			$this->db->where('a.id_ro', $dt['id_ro']);
			$this->db->where('a.status','1');
			$this->db->where('a.id_pr','0');

		//$this->db->limit($dt['jumlah'], 0);
		//$this->db->group_by('id_detail_pr');
		//$this->db->group_by('id_ro');
		$this->db->order_by('a.id_ro', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			$out .= '     <input type="hidden" name="data['.$i.'][id_detail_pr]" value="'.$r->id_detail_pr.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][id_ro]" value="'.$r->id_ro.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][user_id]" value="'.$r->user_id.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][purpose]" value="'.$r->purpose.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][cat_req]" value="'.$r->cat_req.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][ext_doc_no]" value="'.$r->ext_doc_no.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][ETD]" value="'.$r->ETD.'">';
			// $out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
			//$out .= '     <input type="hidden" name="data['.$i.'][date_create]" value="'.$r->date_create.'">';
						  
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_ro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_detail_ro.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->kode_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->nama_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->qty.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->full_name.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->date_create.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->note.'</td>';
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
		$this->db->trans_start();

		foreach($data as $row){
			if(isset($row['chk'])){
				# update table purchase request detail
				//$this->db->flush_cache();

				$this->db->set('status', '2');
				if(isset($data['id_pr'])){
					$this->db->set('id_pr', $data['id_pr']);
				}
				//var_dump($row); exit();
				$this->db->where('id_detail_pr', $row['id_detail_pr']);
				$this->db->update('tr_pr_detail');

				# insert to table purchase reqeust
				//$this->db->flush_cache();
				// $this->db->set('id_ro', $row['id_ro']);
				// $this->db->set('user_id', $row['user_id']);
				// $this->db->set('purpose', $row['purpose']);
				// $this->db->set('cat_req', $row['cat_req']);
				// $this->db->set('ext_doc_no', $row['ext_doc_no']);
				// $this->db->set('ETD', $row['ETD']);
				// $this->db->set('date_create', $row['date_create']);
				//$this->db->set('status', '2');

				//$this->db->insert('tr_pr');
			}
		}

		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
}

?>