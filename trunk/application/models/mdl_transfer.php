<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_transfer extends CI_Model {
    
	function __construct(){
	    parent::__construct();
    }
	
	function getdata($plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_transfer';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;

		#get filter
		$id_transfer = isset($_POST['id_transfer']) ? strval($_POST['id_transfer']) : '';
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('*, a.id_transfer, a.type_transfer, a.note, a.date_create, a.user_id, b.full_name');
		$this->db->from('tr_transfer a');
		$this->db->join('sys_user b', 'b.user_id = a.user_id');

		if($id_transfer != '') {
				$this->db->like('a.id_transfer', $id_transfer);
		}

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

	function InsertOnDb($data){
		$this->db->flush_cache();
        $this->db->set('type_transfer', $data['type_transfer']);
        $this->db->set('note', $data['note']);
        $this->db->set('date_create', ($data['date_create']));
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('status', isset($data['status'])?'1':'0');

		$result = $this->db->insert('tr_transfer');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function getdata_detail($id_transfer, $plimit=true){
		# get parameter from easy grid
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_detail_transfer';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;
		
		# create query
		$this->db->flush_cache();
		$this->db->start_cache();
		$this->db->select('a.id_detail_transfer, a.id_transfer, a.id_stock, a.kode_barang, a.qty, a.price, a.id_lokasi, a.status, b.nama_barang, c.qty AS qty_stock, c.id_lokasi AS lokasi_stock');
		$this->db->from('tr_transfer_detail a');
		$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
		$this->db->join('tr_stock c', 'c.id_stock = a.id_stock', 'left');
			
			$this->db->where('a.id_transfer', $id_transfer);
			
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

	function getdata_transfer($dt){
		$this->db->flush_cache();
		$this->db->select('a.id_stock, a.kode_barang, a.price, a.kode_barang, a.status, b.nama_barang, a.qty, a.id_lokasi');
			$this->db->from('tr_stock a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->join('tr_transfer_detail c', 'c.id_stock = a.id_stock', 'left');
			//var_dump($dt); exit();
			$this->db->where('a.kode_barang', $dt['kode_barang']);
			//$this->db->where('a.status','1');

		//$this->db->limit($dt['jumlah'], 0);
		//$this->db->group_by('id_detail_pr');
		$this->db->order_by('a.kode_barang', 'ASC');
		
		$q = $this->db->get()->result();
		
		$out = '';
		$i=1;
		$color = '';
		foreach($q as $r){
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			$out .= '<tr>';
			$out .= '  <td bgcolor="'.$color.'">'.$i;
			$out .= '     <input type="hidden" name="data['.$i.'][id_stock]" value="'.$r->id_stock.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][kode_barang]" value="'.$r->kode_barang.'">';
			$out .= '     <input type="hidden" name="data['.$i.'][price]" value="'.$r->price.'">';
						  
			$out .= '  </td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_stock.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->kode_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->nama_barang.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->qty.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->price.'</td>';
			$out .= '  <td bgcolor="'.$color.'">'.$r->id_lokasi.'</td>';
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

				# update table sock
				$this->db->flush_cache();
				
				//$this->db->set('id_stock', $row['id_stock']);
				$this->db->set('kode_barang', $row['kode_barang']);
				$this->db->set('price', $row['price']);
				//var_dump($row); exit();
				$this->db->where('id_stock', $row['id_stock']);
				$this->db->update('tr_stock');
				
				# update table purchase request detail
				$this->db->flush_cache();
				$this->db->set('status', '2');
				if(isset($data['id_transfer'])){
					$this->db->set('id_transfer', $data['id_transfer']);
				}
				$this->db->set('id_stock', $row['id_stock']);
				$this->db->set('kode_barang', $row['kode_barang']);
				$this->db->set('price', $row['price']);
				$this->db->set('status', '1');
				//var_dump($row); exit();
				//$this->db->where('id_detail_pr', $row['id_detail_pr']);
				$this->db->insert('tr_transfer_detail');
			}
		}

		$this->db->trans_complete();
		if($data_kosong) {
			return false;
		}
		return $this->db->trans_status();
	}

	function getdataedit($kode){
		# create query
		$this->db->flush_cache();
		$this->db->select('a.id_detail_transfer, a.id_transfer, a.id_stock, a.kode_barang, a.qty, a.price, a.id_lokasi, a.status, b.nama_barang, c.qty AS qty_stock, c.id_lokasi AS lokasi_stock');
		$this->db->from('tr_transfer_detail a');
		$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
		$this->db->join('tr_stock c', 'c.id_stock = a.id_stock', 'left');

		$this->db->where('a.id_detail_transfer', $kode);

		return $this->db->get();
	}

	function getDetail($id_detail_transfer){
		$this->db->where('id_detail_transfer', $id_detail_transfer);
		$this->db->from('tr_transfer_detail');
		
		return $this->db->get();
	}


	function Alokasi_insert($data){
		$this->db->trans_start();

		$result = true;
		// tambah data ke tabel
		$this->db->flush_cache();
		$this->db->set('kode_barang', $data['kode_barang']);
		$this->db->set('qty', $data['qty']);
		$this->db->set('price', $data['price']);
		$this->db->set('id_lokasi', $data['id_lokasi']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id_detail_transfer', $data['kode']);
		$result = $this->db->update('tr_transfer_detail');

		//return
		$this->db->trans_complete();
		return $this->db->trans_status();

	}

	function DeleteOnDb($kode){		
		$this->db->where('id_transfer', $kode);
		$result = $this->db->delete('tr_transfer');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function DeleteDetailOnDb($kode){		
		$this->db->where('id_detail_transfer', $kode);
		$result = $this->db->delete('tr_transfer_detail');
		
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function done($kode){
		
		$this->db->flush_cache();
		
		$this->db->set('status', "2");
		
		$this->db->where('id_transfer', $kode);
		$result = $this->db->update('tr_transfer');
	   
	   
		//return
		if($result) {
				return TRUE;
		}else {
				return FALSE;
		}
	}

	function getTransferDetailIds($ids) {
		$this->db->flush_cache();
		$this->db->where_in('id_detail_transfer', $ids);
		return $this->db->get('tr_transfer_detail');
	}

	function getTransferDetail($id) {
		$this->db->flush_cache();
		$this->db->where('id_detail_transfer', $id);
		return $this->db->get('tr_transfer_detail');
	}

	function get_pdf($id_transfer){        
        # get data
        $this->db->flush_cache();
        $this->db->start_cache();

        	$this->db->select('a.id_detail_transfer, a.id_transfer, a.id_stock, a.kode_barang, a.qty, a.price, a.id_lokasi, a.status, b.nama_barang, c.qty AS qty_stock, c.id_lokasi AS lokasi_stock, d.type_transfer, d.date_create, e.full_name');
			$this->db->from('tr_transfer_detail a');
			$this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
			$this->db->join('tr_stock c', 'c.id_stock = a.id_stock', 'left');
			$this->db->join('tr_transfer d', 'd.id_transfer = a.id_transfer');
			$this->db->join('sys_user e', 'e.user_id = d.user_id');
			$this->db->where('a.id_transfer', $id_transfer);
			//$this->db->where('a.id_ro', $kode);
			$this->db->where('a.status', '1');

        // proses
            $result = $this->db->get();
        
	        if ($result->num_rows() > 0) {
	            foreach ($result->result() as $data) {
	                $data_pdf[] = $data;
	            }
	        return $data_pdf;           
        }
        
    }

    function countDetail($qty){
		$this->db->where('qty', $qty);
		$this->db->from('tr_transfer_detail');
		
		return $this->db->count_all_results();
	}

}

