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
		$data = $this->input->post('price');
		$this->mdl_quotation_request_selected->update($id,$data);
	}

	function Selected($kode) {
    $result = $this->mdl_quotation_request_selected->selected($kode);
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

		
	

}

/* End of file quotation_request_selected.php */
/* Location: ./application/controllers/quotation_request_selected.php */