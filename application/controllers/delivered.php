<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivered extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_delivered');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivered/index');
	}
	
	function grid(){
		$data = $this->mdl_delivered->getdata();
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

	function detail_do($id_do)
	{
		$data['id_do']=$id_do;
		$this->load->view('delivered/detail', $data);
	}
	
	function detail_grid($id_do)
	{
		$data = $this->mdl_delivered->getdatadetail($id_do);
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

	function detail_sro($id_ro,$id_sro)
	{
		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$this->load->view('delivered/detail_delivered', $data);
	}
	
	function detail_grid_sro($id_ro,$id_sro)
	{
		$data = $this->mdl_delivered->getdatadetailsro($id_ro,$id_sro);
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
	}

}