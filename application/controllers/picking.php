<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class picking extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_picking');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('pros/picking');
	}
	
	function grid(){
		$data = $this->mdl_picking->getdata();
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('pros/detail_picking');
	}
	
}