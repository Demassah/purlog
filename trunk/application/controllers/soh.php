<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class soh extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_stock');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('soh/stock');
	}
	
	function grid(){
		$data = $this->mdl_stock->getdata();
		echo $this->mdl_stock->togrid($data['row_data'], $data['row_count']);
	}

}