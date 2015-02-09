<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class courir extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_courir');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('master/courir');
	}
	
	function grid(){
		$data = $this->mdl_courir->getdata();
		echo $this->mdl_courir->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_courir'] = '';
		$data['name_courir'] = '';
		$data['contact'] = '';
		$data['status'] = '1';
		
		$this->load->view('master/courir_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_courir->getdataedit($kode);
    	$data['name_courir'] = $r->row()->name_courir;
    	$data['contact'] = $r->row()->contact;
    	$data['status'] = $r->row()->status;
    
		$data['kode'] = $kode;	

		$this->load->view('master/courir_form', $data);
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
		$this->form_validation->set_rules("name_courir", 'Nama Courir', 'trim|required|xss_clean');
		$this->form_validation->set_rules("contact", 'Contact', 'trim|required|xss_clean');


		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_courir->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_courir->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_courir->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
}