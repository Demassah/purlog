<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivery_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_delivery_order');
		$this->load->model('mdl_courir');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivery_order/index');
	}
	
	function grid(){
		$data = $this->mdl_delivery_order->getdata();
		echo $this->mdl_delivery_order->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('delivery_order/detail_delivery');
	}

	function listSRO(){
		$this->load->view('delivery_order/list_sro');
	}

	function detailSROlist(){
		$this->load->view('delivery_order/detailSRO_list');
	}

	function add(){
		$this->data['id_user'] = '';
		$this->data['date'] = '';
		$this->data['list'] = $this->mdl_courir->v_courir();
		$this->load->view('delivery_order/form',$this->data);
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
		$this->form_validation->set_rules("id_user", 'Requestor', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_courir", 'Courir', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_delivery_order->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_delivery_order->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
}