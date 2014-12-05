<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class purchase_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_purchase_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('purchase_order/po');
	}
	
	function grid(){
		$data = $this->mdl_purchase_order->getdata();
		echo $this->mdl_purchase_order->togrid($data['row_data'], $data['row_count']);
	}

	function detail_po(){
		$this->load->view('purchase_order/detail_po');
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('purchase_order/po_form', $data);
	}
	
}