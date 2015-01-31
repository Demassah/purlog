<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_menu');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('administrator/menu');
	}
	
	function grid(){
		$data = $this->mdl_menu->getdata();
		echo $this->mdl_menu->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$data['menu_id'] = '';
    $data['menu_group'] = '';
    $data['menu_name'] = '';
    $data['menu_parent'] = '';
    $data['url'] = '';
    $data['position'] = '';
    $data['hide'] = '';
    $data['icon_class'] = '';
    $data['policy'] = '';
		
		$this->load->view('administrator/menu_form', $data);
	}
	
	function edit($kode){
		$r = $this->mdl_menu->getdataedit($kode);
		
    $data['menu_group'] = $r->row()->menu_group;
    $data['menu_name'] = $r->row()->menu_name;
    $data['menu_parent'] = $r->row()->menu_parent;
    $data['url'] = $r->row()->url;
    $data['position'] = $r->row()->position;
    $data['hide'] = $r->row()->hide;
    $data['icon_class'] = $r->row()->icon_class;
    $data['policy'] = $r->row()->policy;
		$data['kode'] = $kode;
		
		$this->load->view('administrator/menu_form', $data);
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
		$this->form_validation->set_rules("menu_group", 'Kategori', 'trim|required|xss_clean');
		$this->form_validation->set_rules("menu_name", 'Sub Kategori', 'trim|required|xss_clean');
		//$this->form_validation->set_rules("menu_parent", 'Kode menu', 'trim|required|xss_clean');		

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			//$data["pesan_error"] .= trim(form_error('kd_menu',' ',' '))==''?'':form_error('kd_menu',' ',' ').'<br>';
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_menu->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_menu->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($kode){
		$result = $this->mdl_menu->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal dihapus'));
		}
	}
	
}