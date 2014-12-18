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

	function doneData($kode) {
    $result = $this->mdl_delivery_order->done($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
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

	// Detail Function

	function detail($id_do){
		$data['id_do']=$id_do;
		$this->load->view('delivery_order/detail_delivery',$data);
	}

	function detail_grid($id_do)
	{
		$data = $this->mdl_delivery_order->getdatadetail($id_do);
		echo $this->mdl_delivery_order->togrid($data['row_data'], $data['row_count']);	
	}

	// funtion Add SRO
	function add_detail($id_do)
	{
		$data['id_do']=$id_do;
		$data['list']=$this->mdl_delivery_order->getdataadddetail();
		$this->load->view('delivery_order/add_detail', $data);
	}

	function save_add($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_sro[]", 'ID Pros Detail', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_delivery_order->Insert_detail($data);
			}else { // edit
				$result=$this->mdl_delivery_order->Update_detail($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	
	
}