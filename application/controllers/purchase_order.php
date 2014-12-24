<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class purchase_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_purchase_order');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('purchase_order/po');
	}
	
	function grid(){
		$data = $this->mdl_purchase_order->getdata();
		echo $this->mdl_purchase_order->togrid($data['row_data'], $data['row_count']);
	}

	function detail_po($id_po){
		$data['list']=$this->mdl_purchase_order->detail_po_qr($id_po);
		$data['item']=$this->mdl_purchase_order->detail_po_qr_detail($id_po);
		$this->load->view('purchase_order/detail_po',$data);
	}
	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('purchase_order/po_form', $data);
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
		$this->form_validation->set_rules("id_pr", 'ID purchase order', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_purchase_order->Insert_qrs($data);
			}else { // edit
				// $result=$this->mdl_quotation_request_selected->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}


	
}