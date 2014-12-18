<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shipment_req_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_shipment_req_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$data['list']=$this->mdl_shipment_req_order->add_sro();
		$this->load->view('shipment_req_order/index',$data);
	}
	
	function grid(){
		$data = $this->mdl_shipment_req_order->getdata();
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['user_id'] = '';
		$data['date_create']='';
		$data['id_ro'] = '';
		$data['list']=$this->mdl_shipment_req_order->add_sro();
		$this->load->view('shipment_req_order/sro_form', $data);
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
		$this->form_validation->set_rules("user_id", 'Requestor', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_ro", 'Request Order', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_shipment_req_order->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_shipment_req_order->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}


	function detail($id,$id_sro){	
		$data['id_ro']=$id;
		$data['id_sro']=$id_sro;
		$this->load->view('shipment_req_order/detail_sro',$data);
	}

	public function detail_grid($id,$id_sro) 
	{
		$data['id_ro']=$id;
		$data['id_sro']=$id_sro;
		$data = $this->mdl_shipment_req_order->detail($id,$id_sro);
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);
	}

	public function add_detail($id,$id_sro)
	{
		$data['id_ro']=$id;
		$data['id_sro']=$id_sro;
		$data['kode_barang']='';
		$data['list'] = $this->mdl_shipment_req_order->add_detail($id,$id_sro);
		$this->load->view('shipment_req_order/add_detail',$data);
	}

	public function save_detail($aksi)
	{
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		$id_sro=$this->input->post('id_sro');
		$data=$this->input->post('item');
		# get post data
		foreach($data as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi for
		$this->form_validation->set_rules("item", 'Item', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_sro", 'ID SRO', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_shipment_req_order->save_detail($data,$id_sro);
			}else { // edit
				$result=$this->mdl_shipment_req_order->UpdateOnDb($data);
			}
		}


		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
		
	}

	
}