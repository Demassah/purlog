<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shipment_req_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_shipment_req_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('shipment_req_order/sro');
	}
	
	function grid(){
		$data = $this->mdl_shipment_req_order->getdata();
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('shipment_req_order/sro_form', $data);
	}

	function detail(){		
		$this->load->view('shipment_req_order/detail_sro');
	}

	function checkout(){		
		$this->load->view('shipment_req_order/checkout');
	}
	
	function loadingList(){		
		$this->load->view('shipment_req_order/loading_list');
	}
	
}