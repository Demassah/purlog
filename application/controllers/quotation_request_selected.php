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
		
	

}

/* End of file quotation_request_selected.php */
/* Location: ./application/controllers/quotation_request_selected.php */