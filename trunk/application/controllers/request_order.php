<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order');
		//$this->output->enable_profiler(TRUE);
	}
	
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

	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order/list_detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_request_order->getdata_detail($id);
		echo $this->mdl_request_order->togrid($data['row_data'], $data['row_count']);
	}

	function add_detail(){
			$data['kode'] = '';
			$data['id_detail_ro'] = '';
	    $data['id_ro'] = '';
	    $data['ext_doc_no'] = '';
	    $data['id_barang'] = '';
	    $data['qty'] = '';
	    $data['user_id'] = '';
	    $data['date_create'] = date('d/m/Y');
	    $data['note'] = '';
			$data['status'] = '';

		$this->load->view('request_order/form_detail', $data);
	}

	function save_detail(){
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		// $this->form_validation->set_rules("user_id", 'Requestor', 'trim|required|xss_clean');
		// $this->form_validation->set_rules("purpose", 'Purpose', 'trim|required|xss_clean');
		// $this->form_validation->set_rules("cat_req", 'Category Request', 'trim|required|xss_clean');

		# message rules
		// $this->form_validation->set_message('required', 'Field %s harus diisi.');

		//$data['pesan_error'] = '';
		// if ($this->form_validation->run() == FALSE){
		// 	$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		// }else{
			//if($aksi=="add_detail"){ // add
				$result = $this->mdl_request_order->InsertDetail($data);
			//}else { // edit
				//$result=$this->mdl_request_order->UpdateOnDb($data);
			//}
		//}
		
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

	function deleteDetail($id){
		$result = $this->mdl_request_order->DeleteDetail($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	} 

	

}