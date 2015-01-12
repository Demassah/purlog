<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class satuan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_satuan');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('master/satuan');
	}
	
	function grid(){
		$data = $this->mdl_satuan->getdata();
		echo $this->mdl_satuan->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_satuan'] = '';
		$data['nama_satuan'] = '';
		$data['status'] = '1';
		
		$this->load->view('master/satuan_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_satuan->getdataedit($kode);
    	$data['nama_satuan'] = $r->row()->nama_satuan;
    	$data['status'] = $r->row()->status;
    
		$data['kode'] = $kode;	

		$this->load->view('master/satuan_form', $data);
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
		$this->form_validation->set_rules("nama_satuan", 'Nama Satuan', 'trim|required|xss_clean');


		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_satuan->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_satuan->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_satuan->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
}