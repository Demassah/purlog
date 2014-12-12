<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class departement extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_departement');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('administrator/departement');
	}
	
	function grid(){
		$data = $this->mdl_departement->getdata();
		echo $this->mdl_departement->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['departement_id'] = '';
		$data['departement_name'] = '';
		$data['status'] = '1';
		
		$this->load->view('administrator/departement_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_departement->getdataedit($kode);
    $data['departement_name'] = $r->row()->departement_name;
    
		$data['kode'] = $kode;	

		$this->load->view('administrator/departement_form', $data);
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
		$this->form_validation->set_rules("departement_name", 'Nama Departement', 'trim|required|xss_clean');


		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_departement->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_departement->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_departement->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
}