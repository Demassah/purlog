<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class purchase_request extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_purchase_request');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('purchase_request/pr');
	}
	
	function grid(){
		$data = $this->mdl_purchase_request->getdata();
		echo $this->mdl_purchase_request->togrid($data['row_data'], $data['row_count']);
	}

	function detail_pr(){
		$this->load->view('purchase_request/detail_pr');
	}

	function qrs(){
		$this->load->view('purchase_request/qrs');
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('pr/pr_form', $data);
	}
	
}