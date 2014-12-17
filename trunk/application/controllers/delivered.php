<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivered extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_delivered');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivered/delivered');
	}
	
	function grid(){
		$data = $this->mdl_delivered->getdata();
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('delivered/detail_delivered');
	}

	function listSRO(){
		$this->load->view('delivered/list_sro');
	}

	function receive(){
		$this->load->view('delivered/receive');
	}

	function detail_ros(){
		$this->load->view('delivered/detail_ros');
	}

	function sro(){
		$this->load->view('delivered/sro');
	}

	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$this->load->view('delivered/delivered_form');
	}
	
}