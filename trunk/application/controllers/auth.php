<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model('mdl_departement');
	}
	
	function index(){
		redirect('auth/login');
	}
	
	function login(){
		$data['pesan'] = '';
		$data['username'] = '';
		$data['department'] = $this->mdl_departement->getsingledata();
		$this->load->view('auth/form_login', $data);
	}
	
	function login_proses(){
		$data['pesan'] = '';
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$this->form_validation->set_rules("username", 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules("password", 'Password', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan'].=(trim(form_error('username',' ',' '))==''?'':form_error('username',' ','<br>'));
			$data['pesan'].=(trim(form_error('password',' ',' '))==''?'':form_error('password',' ','<br>'));
			
			$this->load->view('auth/form_login', $data);
		}else{
			$result = $this->mdl_auth->ceklogin($data);
			if($result->num_rows() > 0){
				$this->session->set_userdata('user_id', $result->row()->user_id);
				$this->session->set_userdata('user_name', $result->row()->user_name);
				$this->session->set_userdata('full_name', $result->row()->full_name);
				$this->session->set_userdata('user_level_id', $result->row()->user_level_id);
				$this->session->set_userdata('kd_fakultas', $result->row()->kd_fakultas);
				$this->session->set_userdata('kd_prodi', $result->row()->kd_prodi);
				$this->session->set_userdata('login', TRUE);
				redirect('main');
			}else{
				$data['pesan'].='<b>Login Gagal<b> <br> masukan username dan password dengan benar.';
				$this->load->view('auth/form_login', $data);
			}
		}
		
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('auth/login');
	}
	
	function cekstatuslogin(){
		if($this->session->userdata('login')){
			echo $this->session->userdata('login');
		}else{
			echo 0;
		}
	}
	
	function loadMenu(){
		echo $this->mdl_auth->createmenu();
	}
	
	function listUser(){
		$this->load->view('auth/user_list');
	}
	
	function listLevel(){
		
	}
	
	function debugsql(){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('tbl_fakultas');
		
		$query = $this->db->get();
		
		foreach($query->result_array() as $row){
			foreach($row as $k => $v){
				echo 'Key : '.$k." - Value : ".$v."___";
			}
			echo '<br>';
		}
		
	}
	
}