<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order');
		//$this->output->enable_profiler(TRUE);
	}
	/* ------------------------------------------------ Index ------------------------------------------------*/
	function index(){
		$this->load->view('request_order/index');
	}

	function grid(){
		$data = $this->mdl_request_order->getdata();
		echo $this->mdl_request_order->togrid($data['row_data'], $data['row_count']);
	}
		
	function add(){
		$data['kode'] = '';
		$data['id_ro'] = '';
	    $data['user_id'] = '';
	    $data['purpose'] = '';
	    $data['cat_req'] = '';
	    $data['ext_doc_no'] = '';
	    $data['ETD'] = date('d/m/Y');
	    $data['date_create'] = date('d/m/Y');
		$data['status'] = '';

		$this->load->view('request_order/form', $data);
	}

	function save($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("user_id", 'Requestor', 'trim|required|xss_clean');
		$this->form_validation->set_rules("purpose", 'Purpose', 'trim|required|xss_clean');
		$this->form_validation->set_rules("cat_req", 'Category Request', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_request_order->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_request_order->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	function send($id){
		$result = $this->mdl_request_order->SendData($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di kirim'));
		}
	}

	function delete($id){
		$result = $this->mdl_request_order->DeleteOnDb($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	} 

	/* ------------------------------------------------ Detail ------------------------------------------------*/

	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_request_order->getdata_detail($id);
		echo $this->mdl_request_order->togrid($data['row_data'], $data['row_count']);
	}

	function deleteDetail($id){
		$result = $this->mdl_request_order->DeleteDetail($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	} 

	function load_kode_barang(){
		$data = $this->mdl_request_order->load_kode_barang( );
		$arr = array();
		array_push($arr, array('kode_barang'=>'','nama_barang'=>'&nbsp;'));
		foreach($data['row_data']->result() as $row){
			array_push($arr, array('kode_barang'=>$row->kode_barang, 'nama_barang'=>$row->nama_barang));
		}
		echo json_encode($arr);
	}

	/* ------------------------------------------------ add detail ------------------------------------------------*/


	function add_detail($id){
		  
		   	$data['kode'] = '';
			$data['id_ro'] = '';
		    $data['ext_doc_no'] = '';
		    $data['kode_barang'] = '';
		    $data['qty'] = '';
		    $data['user_id'] = '';
		    $data['date_create'] = date('d/m/Y');
		    $data['note'] = '';
			$data['status'] = '1';
			$data['status_delete'] = '0';
			$data['id_sro'] = '0';
			

		// get data
		$label 	= $this->mdl_request_order->getdataedit($id);
		// var_export($label->row()); exit();
		$detail = $this->mdl_request_order->getDetail($label->row()->id_ro);
		
		# hidden input
		$data['id_ro'] = $id;
		$data['ext_doc_no'] = $label->row()->ext_doc_no;
		$data['full_name'] = $label->row()->full_name;
		$data['user_id'] = $label->row()->user_id;
		$data['date_create'] = $label->row()->date_create;
		
		# data input detail
		$detail_row = $detail->num_rows();
		if($detail_row > 0){
			$data['data_detail'] = json_encode($detail->result_array()); 
		}else{
			$data['data_detail'] = '['.json_encode(array(
										'kode_barang'=>'',
										'qty'=>'',
										'note'=>'',
										'status'=>'',
									)).']';
		}

		$this->load->view('request_order/form_detail', $data);
	}

	
	function save_detail(){
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		//var_dump($_POST['data_nilai']);
		
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		$result = $this->mdl_request_order->Update_DetailRO($data);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	

}