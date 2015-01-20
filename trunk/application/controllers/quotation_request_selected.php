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
        echo json_encode(array('msg' => 'Data gagal dikirim atau harga berisi Nol'));
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
  	$result = $this->mdl_quotation_request_selected->cek_no_vendor($kode);
  	if($result>=3){
  		$result = $this->mdl_quotation_request_selected->cek_pr_qr($kode);
  		if($result>=1){
		    $result = $this->mdl_quotation_request_selected->done($kode);
		    if ($result) {
		        echo json_encode(array('success' => true));
		    } else {
		        echo json_encode(array('msg' => 'Data gagal dikirim'));
		    }
		    } else {
		    	echo json_encode(array('msg'=> 'Tidak Ada Vendor yang dipilih'));
		    }
		  }else{
		    echo json_encode(array('msg'=> 'Jumlah Vendor Kurang dari 3'));
		  }
  }


  function Add_vendor($id_pr)
  {
  	$data['id_pr'] = $id_pr;
  	$data['list'] = $this->mdl_quotation_request_selected->list_vendor($id_pr);
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
		$this->form_validation->set_rules("top", 'TOP', 'trim|required|xss_clean');
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

	//add new Qrs
	function new_qrs()
  {
  	$data['id_pr'] = '';
  	$this->load->view('quotation_request_selected/form_newqrs',$data);
  }

  function SaveNewQrs($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
			 //echo print_r($value);
		}

		
		# rules validasi form
		$this->form_validation->set_rules("user_id", 'ID user', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_pr", 'ID PR', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_quotation_request_selected->Insert_Qrs($data);
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

	//detail 
	function detail_Qrs($id_qrs)
	{
		$data['id_qrs'] = $id_qrs;
		$this->load->view('quotation_request_selected/detail_qrs',$data);
	}

	function grid_detail($id_qrs){
		$data = $this->mdl_quotation_request_selected->getQrs($id_qrs);
		echo $this->mdl_quotation_request_selected->togrid($data['row_data'], $data['row_count']);
	}
	//add detail qrs
	function add_detail($id_pr)
	{
		$data['id_pr']= $id_pr;
		$data['list'] = $this->mdl_quotation_request_selected->select_detail_qrs($id_pr);
		$this->load->view('quotation_request_selected/form_add_detail_qrs',$data);
	}
	function SaveDetailQrs($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
			// echo print_r($value);
		}

		
		# rules validasi form
		$this->form_validation->set_rules("id_detail_pr[]", 'ID user', 'trim|required|xss_clean');
		// $this->form_validation->set_rules("pick", 'ID PR', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_quotation_request_selected->Insert_Detail_Qrs($data);
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

		function delete_detail($kode)
	{
		$result = $this->mdl_quotation_request_selected->delete_detail($kode);
		if($result){
			 echo json_encode(array('success' => true));
	    } else {
	     echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	//notif
	function notif()
	{
		$result = $this->mdl_quotation_request_selected->notif();
		if($result>=1){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	// autocomplete
  function selectqrs()
  {
  	$data = $this->input->post('term');
  	$query = $this->mdl_quotation_request_selected->searchQrs($data);
  	header('Content-type:application/json');
  	echo json_encode($query);
  }

}

/* End of file quotation_request_selected.php */
/* Location: ./application/controllers/quotation_request_selected.php */