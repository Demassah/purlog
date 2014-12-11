<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_logistic extends CI_Controller {
	
	function __construct(){
		parent::__construct();
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

}