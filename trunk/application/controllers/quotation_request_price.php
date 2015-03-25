<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quotation_request_price extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_quotation_request_price');
	}
	// -------------------------------------------------------Index Grid------------------------------------------------------------- //
	function index(){
		$this->load->view('quotation_request_price/index');
	}

	function grid(){
		$data = $this->mdl_quotation_request_price->getdata();
		echo $this->mdl_quotation_request_price->togrid($data['row_data'], $data['row_count']);
	}

	// ---------------------------------------------------Add QRS Vendor ------------------------------------------------------------ //
	function add_qrs($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
		$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_quotation_request_price->list_pr($id_pr,$id_qrs);

		$this->load->view('quotation_request_price/add_qrs', $data, FALSE);
	}
	// ---------------------------------------------------CRUD Vendor -------------------------------------------------------------- //

  function Add_vendor($id_pr,$id_qrs)
  {
  	$data['id_pr'] = $id_pr;
  	$data['id_qrs'] = $id_qrs;
  	$data['list'] = $this->mdl_quotation_request_price->list_vendor($id_pr,$id_qrs);
  	$this->load->view('quotation_request_price/form', $data);
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
		$this->form_validation->set_rules("top", 'TOP', 'trim|required|xss_clean');
		$this->form_validation->set_rules("ppn", 'PPN', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_quotation_request_price->Insert_vendor($data);
			}else { // edit
				$result=$this->mdl_quotation_request_price->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	
	function after_select($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
  	$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_quotation_request_price->list_pr($id_pr,$id_qrs);

		$this->load->view('quotation_request_price/load', $data, FALSE);
	}

	function update($id)
	{
		$data = $this->input->post('harga');
		$this->mdl_quotation_request_price->update($id,$data);
	}

	function update_diskon($id)
	{
		$data = $this->input->post('diskon');
		$this->mdl_quotation_request_price->update_diskon($id,$data);
	}

	function Selected($kode,$id_pr,$id_qrs) {
    $result = $this->mdl_quotation_request_price->selected($kode,$id_pr,$id_qrs);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim atau harga berisi Nol'));
    }
  }	

  function Delete($kode) {
    $result = $this->mdl_quotation_request_price->Delete($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }
  // ---------------------------------------------------Done Vendor -------------------------------------------------------------- //
   function Done($kode,$id_qrs)
  {
  	$result = $this->mdl_quotation_request_price->cek_no_vendor($kode,$id_qrs);
  	if($result >= 3){
  		$result = $this->mdl_quotation_request_price->done($kode,$id_qrs);
	  	if($result)
	  	{
	  		echo json_encode(array('success' => true));
	  	}else{
	  		echo json_encode(array('msg'=> 'vendors less than 3'));	
	  	}
	  }else{
	  	echo json_encode(array('msg'=> 'vendors less than 3'));	
	  }
  }


}

/* End of file quotation_request_price.php */
/* Location: ./application/controllers/quotation_request_price.php */