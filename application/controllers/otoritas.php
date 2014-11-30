<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class otoritas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_otoritas');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('administrator/otoritas');
	}
	
	function grid(){
		$data = $this->mdl_otoritas->getdata();
		echo $this->mdl_otoritas->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['level_name'] = '';
		$data['level'] = '';
		$this->load->view('administrator/otoritas_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_otoritas->getdataedit($kode);
		
		$data['kode'] = $kode;
		$data['level_name'] = $r->row()->level_name;
		$data['level'] = $r->row()->level;
		
		$this->load->view('administrator/otoritas_form', $data);
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
		$this->form_validation->set_rules("level_name", 'Nama Otoritas', 'trim|required|xss_clean');
		$this->form_validation->set_rules("level", 'Posisi', 'trim|numeric|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			//$data["pesan_error"] .= trim(form_error('kd_otoritas',' ',' '))==''?'':form_error('kd_otoritas',' ',' ').'<br>';
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_otoritas->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_otoritas->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_otoritas->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
	
	function menu($id){
		$data['user_level_id'] = $id;
		$this->load->view('administrator/otoritas_form_menu', $data);
	}
	
	function menu_load($user_level){
		echo json_encode($this->mdl_otoritas->menu_load($user_level));
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
		
		$result = $this->mdl_otoritas->InsertMenu($data);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete_sap($kd_prodi, $kd_otoritas, $kd_materi){
		# init
		$result = false;
		$data['pesan_error'] = '';
		
		$result = $this->mdl_otoritas->DeleteSAP($kd_prodi, $kd_otoritas, $kd_materi);
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
}