<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class qrv extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		//$this->load->model('mdl_kategori');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('qrv/qrv');
	}
	
	function grid(){
		//$data = $this->mdl_kategori->getdata();
		//echo $this->mdl_kategori->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('qrv/qrv_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_kategori->getdataedit($kode);
    $data['nama_kategori'] = $r->row()->nama_kategori;
    
		$data['kode'] = $kode;	

		$this->load->view('master/kategori_form', $data);
	}
	
	function save($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("nama_kategori", 'Nama Kategori', 'trim|required|xss_clean');


		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_kategori->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_kategori->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_kategori->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}


	function test{

	}
}