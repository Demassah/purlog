<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_inbound extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_inbound');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_inbound/index');
	}

	function grid(){
		$data = $this->mdl_inbound->getdata_report();
		echo $this->mdl_inbound->togrid($data['row_data'], $data['row_count']);
	}

}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */