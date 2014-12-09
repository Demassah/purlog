<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_logistic extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order_logistic');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('request_order_logistic/index');
	}

	function grid(){
		$data = $this->mdl_request_order_logistic->getdata();
		echo $this->mdl_request_order_logistic->togrid($data['row_data'], $data['row_count']);
	}
		
	function add(){
		$data['kode'] = '';
	
		
		$this->load->view('request_order_logistic/form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_barang->getdataedit($kode);
		
    $data['id_kategori'] = $r->row()->id_kategori;
    $data['id_sub_kategori'] = $r->row()->id_sub_kategori;
    $data['kode_barang'] = $r->row()->kode_barang;
    $data['nama_barang'] = $r->row()->nama_barang;
    $data['jumlah'] = $r->row()->jumlah;
		$data['kode'] = $kode;
		
		$this->load->view('request_order_logistic/form', $data);
	}
	
}