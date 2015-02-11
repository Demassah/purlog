<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lokasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_lokasi');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('master/lokasi');
	}
	
	function grid(){
		$data = $this->mdl_lokasi->getdata();
		echo $this->mdl_lokasi->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_lks'] = '';
		$data['id_lokasi'] = '';
		$data['type'] = '';
		$data['storage'] = '';
		$data['status'] = '1';
		
		$this->load->view('master/lokasi_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_lokasi->getdataedit($kode);
    	$data['id_lokasi'] 	= $r->row()->id_lokasi;
    	$data['type'] 		= $r->row()->type;
    	$data['storage'] 	= $r->row()->storage;
    
		$data['kode'] = $kode;	

		$this->load->view('master/lokasi_form', $data);
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
		$this->form_validation->set_rules("id_lokasi", 'ID lokasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules("type", 'Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules("storage", 'Storage', 'trim|required|xss_clean');


		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_lokasi->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_lokasi->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_lokasi->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
}