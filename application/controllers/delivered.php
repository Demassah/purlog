<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivered extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_delivered');
		//$this->output->enable_profiler(TRUE);
	}
	
	/* --------------------------------list -------------------------------------- */

	function index(){
		$this->load->view('delivered/delivered');
	}
	
	function grid(){
		$data = $this->mdl_delivered->getdata();
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}
/* --------------------------------Detail -------------------------------------- */
	function detail_ros($id){
		$data['id_do'] = $id;
		$this->load->view('delivered/detail_ros', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_delivered->getdata_detail($id);
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

	/* --------------------------------Detail (Detail SRO) -------------------------------------- */

	function sro($id, $id_do){
		$data['id_sro'] = $id;
		$data['id_do'] = $id_do;
		$this->load->view('delivered/sro', $data);
	}

	function grid_detailSRO($id){
		$data = $this->mdl_delivered->getdata_detailSRO($id);
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

	function detail(){
		$this->load->view('delivered/detail_delivered');
	}

	function listSRO(){
		$this->load->view('delivered/list_sro');
	}

	function receive(){
		$this->load->view('delivered/receive');
	}

	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$this->load->view('delivered/delivered_form');
	}
	
}