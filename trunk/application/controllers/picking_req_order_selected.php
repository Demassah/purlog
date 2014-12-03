<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class picking_req_order_selected extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_picking');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('picking_req_order_selected/picking');
	}
	
	function grid(){
		$data = $this->mdl_picking->getdata();
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('picking_req_order_selected/detail_picking');
	}

	function available(){
		$this->load->view('picking_req_order_selected/available');
	}

	function lock(){
		$this->load->view('picking_req_order_selected/lock');
	}

	function pending(){
		$this->load->view('picking_req_order_selected/pending');
	}
	
}