<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_logistic extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_request_order_logistic');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('request_order_logistic/index');
	}

	function grid(){
		$data = $this->mdl_request_order_logistic->getdata();
		echo $this->mdl_request_order_logistic->togrid($data['row_data'], $data['row_count']);
	}

	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order_logistic/detail', $data);
	}
		
	function grid_detail($id){
		$data = $this->mdl_request_order_logistic->getdata_detail($id);
		echo $this->mdl_request_order_logistic->togrid($data['row_data'], $data['row_count']);
	}

	function done($id){
		$result = $this->mdl_request_order_logistic->DoneData($id);
		if (!$result){
				echo json_encode(array('msg'=>'Data gagal di kirim'));
			} else {
				echo json_encode(array('success'=>true, 'id_object'=>$result));
			} 
	}

	function rejected($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order_logistic/rejected', $data);
	}
		
	function grid_rejected($id){
		$data = $this->mdl_request_order_logistic->getdata_rejected($id);
		echo $this->mdl_request_order_logistic->togrid($data['row_data'], $data['row_count']);
	}

}