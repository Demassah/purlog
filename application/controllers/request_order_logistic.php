<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_logistic extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->load->model('mdl_kategori');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('request_order_logistic/index');
	}

	function grid(){
		// $data = $this->mdl_barang->getdata();
		// echo $this->mdl_barang->togrid($data['row_data'], $data['row_count']);
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
	
	// function save($aksi){
	// 	# init
	// 	$status = "";
	// 	$result = false;
	// 	$data['pesan_error'] = '';
		
	// 	# get post data
	// 	foreach($_POST as $key => $value){
	// 		$data[$key] = $value;
	// 	}
		
	// 	# rules validasi form
	// 	$this->form_validation->set_rules("id_kategori", 'Kategori', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules("id_sub_kategori", 'Sub Kategori', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules("kode_barang", 'Kode Barang', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules("nama_barang", 'Nama Barang', 'trim|required|xss_clean');

	// 	# message rules
	// 	$this->form_validation->set_message('required', 'Field %s harus diisi.');

	// 	$data['pesan_error'] = '';
	// 	if ($this->form_validation->run() == FALSE){
	// 		//$data["pesan_error"] .= trim(form_error('kd_barang',' ',' '))==''?'':form_error('kd_barang',' ',' ').'<br>';
	// 		$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
	// 	}else{
	// 		if($aksi=="add"){ // add
	// 			$result = $this->mdl_barang->InsertOnDb($data);
	// 		}else { // edit
	// 			$result=$this->mdl_barang->UpdateOnDb($data);
	// 		}
	// 	}
		
	// 	if($result){
	// 		echo json_encode(array('success'=>true));
	// 	}else{
	// 		echo json_encode(array('msg'=>$data['pesan_error']));
	// 	}
	// }
	
	// function delete($kode){
	// 	$result = $this->mdl_barang->DeleteOnDb($kode);
	// 	if ($result){
	// 		echo json_encode(array('success'=>true));
	// 	} else {
	// 		echo json_encode(array('msg'=>'Data gagal dihapus'));
	// 	}
	// }
}