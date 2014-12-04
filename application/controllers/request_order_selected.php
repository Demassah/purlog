<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_selected extends CI_Controller {

function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order_selected');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('request_order_selected/index');
	}

	function grid(){
		$data = $this->mdl_request_order_selected->getdata();
		echo $this->mdl_request_order_selected->togrid($data['row_data'], $data['row_count']);
	}

	function detailROS(){
		$this->load->view('request_order_selected/detailROS');
	}
		
	function add(){
		$data['kode'] = '';
		$this->load->view('request_order_selected/form', $data);
	}

}

/* End of file request_order_selected.php */
/* Location: ./application/controllers/request_order_selected.php */