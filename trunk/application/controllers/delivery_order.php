<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivery_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_delivery_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivery_order/delivery_order');
	}
	
	function grid(){
		$data = $this->mdl_delivery_order->getdata();
		echo $this->mdl_delivery_order->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('delivery_order/detail_delivery');
	}

	function listSRO(){
		$this->load->view('delivery_order/list_sro');
	}

	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$this->load->view('delivery_order/delivery_order_form');
	}
	
}