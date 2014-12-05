<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class document_receive extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_document_receive');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('document_receive/dr');
	}

	function detail(){
		$this->load->view('document_receive/detail');
	}
	
	function detail_dr(){
		$this->load->view('document_receive/detail_dr');
	}

	function receive(){
		$this->load->view('document_receive/receive');
	}

	function grid(){
		$data = $this->mdl_document_receive->getdata();
		echo $this->mdl_document_receive->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('document_receive/dr_form', $data);
	}
	
	
}