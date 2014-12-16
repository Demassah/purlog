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

	function getdata(){
		// get post
		$data['id_ro'] = $this->input->post('id_ro');
		$data['jumlah'] = $this->input->post('jumlah');
		
		echo $this->mdl_purchase_request->getdata_pr($data);
	}

	function save(){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		$data['pesan_error'] = '';
		
		$result=$this->mdl_purchase_request->InsertOnDB($data['data']);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	function detail_pr($id){
		$data['id_pr'] = $id;
		$this->load->view('purchase_request/detail_pr', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_purchase_request->getdata_detail($id);
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function add_detailPR($id){
		$data['id_pr'] = $id;
		$this->load->view('purchase_request/add_detailpr', $data);
	}

	function grid_detailPR($id){
		$data = $this->mdl_purchase_request->getdata_detailpr($id);
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function qrs(){
		$this->load->view('purchase_request/qrs');
	}
}