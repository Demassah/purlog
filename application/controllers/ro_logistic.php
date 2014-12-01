<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ro_logistic extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->load->model('mdl_kategori');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('ro_logistic/kategori');
	}
	
	function grid(){
		$data = $this->mdl_kategori->getdata();
		echo $this->mdl_kategori->togrid($data['row_data'], $data['row_count']);
	}
	
	
	
}