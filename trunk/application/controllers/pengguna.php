<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengguna extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_pengguna');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('administrator/pengguna');
	}
	
	function grid(){
		$data = $this->mdl_pengguna->getdata();
		echo $this->mdl_pengguna->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['user_id'] = '';
		$data['nik'] = '';
	    $data['user_name'] = '';
	    $data['full_name'] = '';
	    $data['passwd'] = '';
	    $data['departement_id'] = '';
	    $data['user_level_id'] = '';
		
		$this->load->view('administrator/pengguna_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_pengguna->getdataedit($kode);
		$data['nik'] = $r->row()->nik;
	    $data['user_name'] = $r->row()->user_name;
	    $data['full_name'] = $r->row()->full_name;
	    //$data['passwd'] = $r->row()->passwd;
	    $data['departement_id'] = $r->row()->departement_id;
	    $data['user_level_id'] = $r->row()->user_level_id;
		$data['kode'] = $kode;
		
		$this->load->view('administrator/pengguna_form', $data);
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
		$this->form_validation->set_rules("user_name", 'Nama pengguna', 'trim|required|xss_clean');
		//$this->form_validation->set_rules("departement_id", 'Departement', 'trim|required|xss_clean');
		//$this->form_validation->set_rules("level", 'Posisi', 'trim|numeric|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			//$data["pesan_error"] .= trim(form_error('kd_pengguna',' ',' '))==''?'':form_error('kd_pengguna',' ',' ').'<br>';
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_pengguna->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_pengguna->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_pengguna->DeleteOnDb($kode);
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
		echo json_encode($this->mdl_pengguna->menu_load($user_level));
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
		
		$result = $this->mdl_pengguna->InsertMenu($data);
		
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
		
		$result = $this->mdl_pengguna->DeleteSAP($kd_prodi, $kd_pengguna, $kd_materi);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
}