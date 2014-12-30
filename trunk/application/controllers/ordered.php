<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ordered extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_ordered');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('ordered/index');
	}
	
	function grid(){
		$data = $this->mdl_ordered->getdata();
		echo $this->mdl_ordered->togrid($data['row_data'], $data['row_count']);
	}

	function detail_orde($id_po){
		$data['list']=$this->mdl_ordered->detail_orde_qr($id_po);
		$data['item']=$this->mdl_ordered->detail_orde_qr_detail($id_po);
		$this->load->view('ordered/detail_orde',$data);
	}
	
	// function add(){
	// 	$data['kode'] = '';
	// 	$data['id_po'] = '';
	// 	$data['id_ro'] = '';

	// 	$this->load->view('ordered/orde_form', $data);
	// }

 //  function save($aksi){
	// 	# init
	// 	$status = "";
	// 	$result = false;
	// 	$data['pesan_error'] = '';
		
	// 	# get post data
	// 	foreach($_POST as $key => $value){
	// 		$data[$key] = $value;
	// 	}
		
	// 	# rules validasi form
	// 	$this->form_validation->set_rules("id_pr", 'ID purchase order', 'trim|required|xss_clean');
	// 	# message rules
	// 	$this->form_validation->set_message('required', 'Field %s harus diisi.');

	// 	$data['pesan_error'] = '';
	// 	if ($this->form_validation->run() == FALSE){
	// 		$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
	// 	}else{
	// 		if($aksi=="add"){ // add
	// 		//print_r($data);
	// 		$result = $this->mdl_ordered->Insert_qrs($data);
	// 		}else { // edit
	// 			// $result=$this->mdl_quotation_request_selected->cancel($data);
	// 		}
	// 	}
		
	// 	if($result){
	// 		echo json_encode(array('success'=>true));
	// 	}else{
	// 		echo json_encode(array('msg' => 'Data gagal dikirim'));
	// 	}
	// }

	// function done_orde($kode) {
 //    $result = $this->mdl_ordered->done($kode);
 //    if ($result) {
 //        echo json_encode(array('success' => true));
 //    } else {
 //        echo json_encode(array('msg' => 'Data gagal dihapus'));
 //    }
 //  }

 //  function delete_orde($kode) {
 //    $result = $this->mdl_ordered->delete($kode);
 //    if ($result) {
 //        echo json_encode(array('success' => true));
 //    } else {
 //        echo json_encode(array('msg' => 'Data gagal dihapus'));
 //    }
 //  }	


	
}