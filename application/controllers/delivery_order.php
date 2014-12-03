<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivery_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_picking');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivery_order/delivery_order');
	}
	
	function grid(){
		$data = $this->mdl_picking->getdata();
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('delivery_order/detail_delivery');
	}

	function available(){
		$this->load->view('pros/available');
	}

	function lock(){
		$this->load->view('pros/lock');
	}

	function pending(){
		$this->load->view('pros/pending');
	}
	
}