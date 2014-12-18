<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shipment_req_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_shipment_req_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		$this->load->view('shipment_req_order/index');
	}

	function grid()
	{
		$data = $this->mdl_shipment_req_order->getdata();
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);	
	}

	function done($kode) {
    $result = $this->mdl_shipment_req_order->done($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }	
  
	function add()
	{
		$data['id_ro']='';
		$data['user_id']='';
		$data['date_create']='';
		$data['list']=$this->mdl_shipment_req_order->get_ro();
		$this->load->view('shipment_req_order/form_add', $data);
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
		$this->form_validation->set_rules("id_ro", 'Requestor', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_shipment_req_order->Insert($data);
			}else { // edit
				$result=$this->mdl_shipment_req_order->Update($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	
	// detail function

	function detail($id_ro,$id_sro)
	{
		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$this->load->view('shipment_req_order/detail', $data, FALSE);
	}

	function detail_grid($id_ro,$id_sro)
	{
		$data = $this->mdl_shipment_req_order->getdatadetail($id_ro,$id_sro);
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);	
	}

	function add_detail($id_ro,$id_sro)
	{
		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$data['list']=$this->mdl_shipment_req_order->getdataadddetail($id_ro,$id_sro);
		$this->load->view('shipment_req_order/add_detail', $data, FALSE);
	}

	function save_add_detail($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_detail_pros[]", 'ID Pros Detail', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_shipment_req_order->Insert_detail($data);
			}else { // edit
				$result=$this->mdl_shipment_req_order->Update_detail($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}


	
}