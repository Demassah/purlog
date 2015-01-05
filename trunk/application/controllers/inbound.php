<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inbound extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_inbound');
	}
	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('inbound/index');
	}

	function grid(){
		$data = $this->mdl_inbound->getdata();
		echo $this->mdl_inbound->togrid($data['row_data'], $data['row_count']);
	}
	/* --------------------------------Function Add -------------------------------------- */
	function add()
	{

		$this->load->view('inbound/form_add');
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
		$this->form_validation->set_rules("id_po_re", 'ID purchase order / Return', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_sub_po_re", 'ID purchase order / Return', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			$result = $this->mdl_inbound->Insert_inbound($data);
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

/* End of file inbound.php */
/* Location: ./application/controllers/inbound.php */