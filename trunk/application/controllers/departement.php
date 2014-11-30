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
	
	
	function menu($id){
		$data['user_level_id'] = $id;
		$this->load->view('administrator/pengguna_form_menu', $data);
	}
	
	function menu_load($user_level){
		echo json_encode($this->mdl_departement->menu_load($user_level));
	}
	
	function save_menu(){
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		$result = $this->mdl_departement->InsertMenu($data);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete_sap($kd_prodi, $kd_pengguna, $kd_materi){
		# init
		$result = false;
		$data['pesan_error'] = '';
		
		$result = $this->mdl_departement->DeleteSAP($kd_prodi, $kd_pengguna, $kd_materi);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
}