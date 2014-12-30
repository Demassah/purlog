<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quotation_request_selected extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_quotation_request_selected');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('quotation_request_selected/index');
	}

	function grid(){
		$data = $this->mdl_quotation_request_selected->getdata();
		echo $this->mdl_quotation_request_selected->togrid($data['row_data'], $data['row_count']);
	}

	function add_qrs($id_pr)
	{
		$data['id_pr'] = $id_pr;
		$data['list'] = $this->mdl_quotation_request_selected->list_pr($id_pr);

		$this->load->view('quotation_request_selected/add_qrs', $data, FALSE);
	}

	function update($id)
	{
		$data = $this->input->post('harga');
		$this->mdl_quotation_request_selected->update($id,$data);
		//$this->load->view('quotation_request_selected/load', $data, FALSE);
	}

	function Selected($kode,$id_pr) {
    $result = $this->mdl_quotation_request_selected->selected($kode,$id_pr);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }	

  function Delete($kode) {
    $result = $this->mdl_quotation_request_selected->Delete($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }


  function Done($kode) {
    $result = $this->mdl_quotation_request_selected->done($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }

  function Add_vendor($id_pr)
  {
  	$data['id_pr'] = $id_pr;
  	$data['list'] = $this->mdl_quotation_request_selected->list_vendor();
  	$this->load->view('quotation_request_selected/form', $data);
  }

  function save_vendor($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_vendor", 'ID vendor', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_quotation_request_selected->Insert_vendor($data);
			}else { // edit
				$result=$this->mdl_quotation_request_selected->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	
	function after_select($id_pr)
	{
		$data['id_pr'] = $id_pr;
		$data['list'] = $this->mdl_quotation_request_selected->list_pr($id_pr);

		$this->load->view('quotation_request_selected/load', $data, FALSE);
	}

}

/* End of file quotation_request_selected.php */
/* Location: ./application/controllers/quotation_request_selected.php */