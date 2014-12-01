<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detail_picking extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_barang');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('pros/detail_picking');
	}

	function grid(){
		$data = $this->mdl_barang->getdata();
		echo $this->mdl_barang->togrid($data['row_data'], $data['row_count']);
	}
	
	
}