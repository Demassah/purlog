<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quotation_request_selected extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_quotation_request_selected');
		//$this->output->enable_profiler(TRUE);
	}
	// -------------------------------------------------------Index Grid------------------------------------------------------------- //
	function index(){
		$this->load->view('quotation_request_selected/index');
	}

	function grid(){
		$data = $this->mdl_quotation_request_selected->getdata();
		echo $this->mdl_quotation_request_selected->togrid($data['row_data'], $data['row_count']);
	}

	// ---------------------------------------------------Add QRS -------------------------------------------------------------- //

	function new_qrs()
  {
  	$data['id_pr'] = '';
  	$data['user_id']=$this->session->userdata('user_id');
  	$data['date_create']=date('Y-m-d H:i:s');
  	$data['status']=1;
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
			//echo $value;
		}

		# rules validasi form
		$this->form_validation->set_rules("user_id", 'ID User', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_pr", 'ID PR', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data['id_pr']);
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
	function Delete_Qrs($id_qrs)
	{
		$result = $this->mdl_quotation_request_selected->delete_qrs($id_qrs);
		if($result){
			 echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dihapus'));
		}
	}

	// --------------------------------------------------- Detail QRS -------------------------------------------------------------- //
	function detail_Qrs($id_qrs)
	{
		$data['id_qrs'] = $id_qrs;
		$this->load->view('quotation_request_selected/detail_qrs',$data);
	}

	function grid_detail($id_qrs){
		$data = $this->mdl_quotation_request_selected->getQrs($id_qrs);
		echo $this->mdl_quotation_request_selected->togrid($data['row_data'], $data['row_count']);
	}

	// --------------------------------------------------- Add Detail QRS ----------------------------------------------------------- //

	function add_detail($id_pr)
	{
		$data['id_pr']= $id_pr;
		$data['kode_barang']='';
		$data['list'] = $this->mdl_quotation_request_selected->select_detail_qrs($id_pr);
		$this->load->view('quotation_request_selected/form_add_detail_qrs',$data);
	}
	function SaveDetailQrs($aksi){
		# init
			
		$status = "";
		$result = false;
		$data['pesan_error'] = '';

			if($aksi=="add"){ // add
			//print_r($data['id_detail_qrs']);
			$result = $this->mdl_quotation_request_selected->Insert_Detail_Qrs();
			}else { // edit
				$result=$this->mdl_quotation_request_selected->cancel($data);
			}		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim '));
		}
	}

	// --------------------------------------------------- Delete Detail QRS -------------------------------------------------------- //

		function delete_detail($kode)
	{
		$result = $this->mdl_quotation_request_selected->delete_detail($kode);
		if($result){
			 echo json_encode(array('success' => true));
	    } else {
	     echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	// ---------------------------------------------------Add QRS Vendor ------------------------------------------------------------ //
	function add_qrs($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
		$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_quotation_request_selected->list_pr($id_pr,$id_qrs);

		$this->load->view('quotation_request_selected/add_qrs', $data, FALSE);
	}

	// ---------------------------------------------------Cek Vendor -------------------------------------------------------------- //
  function Done($kode,$id_qrs) {
  	$result = $this->mdl_quotation_request_selected->cek_no_detail($kode,$id_qrs);
  		if($result >= 1){
	  	$result = $this->mdl_quotation_request_selected->cek_no_vendor($kode,$id_qrs);
	  	if($result>=3){
	  		$result = $this->mdl_quotation_request_selected->cek_pr_qr($kode,$id_qrs);
	  		if($result>=1){
			    $result = $this->mdl_quotation_request_selected->done($kode,$id_qrs);
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
			  }else{
			  echo json_encode(array('msg'=> 'Detail Kosong'));	
			  }
  }

// ---------------------------------------------------CRUD Vendor -------------------------------------------------------------- //

  function Add_vendor($id_pr,$id_qrs)
  {
  	$data['id_pr'] = $id_pr;
  	$data['id_qrs'] = $id_qrs;
  	$data['list'] = $this->mdl_quotation_request_selected->list_vendor($id_pr,$id_qrs);
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
	
	function after_select($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
  	$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_quotation_request_selected->list_pr($id_pr,$id_qrs);

		$this->load->view('quotation_request_selected/load', $data, FALSE);
	}

	function update($id)
	{
		$data = $this->input->post('harga');
		$this->mdl_quotation_request_selected->update($id,$data);
	}

	function Selected($kode,$id_pr,$id_qrs) {
    $result = $this->mdl_quotation_request_selected->selected($kode,$id_pr,$id_qrs);
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

	

	// --------------------------------------------------- Search QRS -------------------------------------------------------------- //

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