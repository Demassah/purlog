<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class purchase_request extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_purchase_request');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('purchase_request/purchase_request');
	}
	
	function grid(){
		$data = $this->mdl_purchase_request->getdata();
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function add_pr(){
		$this->load->view('purchase_request/add_pr');
	}

	function grid_pr(){
		$data = $this->mdl_purchase_request->getdata_pr();
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function detail_pr($id){
		$data['id_pr'] = $id;
		$this->load->view('purchase_request/detail_pr', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_purchase_request->getdata_detail($id);
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function qrs(){
		$this->load->view('purchase_request/qrs');
	}
	
	// function detail_pr(){
	// 	$this->load->view('picking_req_order_selected/detail_pr');
	// }

	
	
}