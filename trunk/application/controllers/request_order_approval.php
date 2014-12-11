<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_approval extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order_approval');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('request_order_approval/index');
	}

	function grid(){
		$data = $this->mdl_request_order_approval->getdata();
		echo $this->mdl_request_order_approval->togrid($data['row_data'], $data['row_count']);
	}


	function done($id){
		$result = $this->mdl_request_order_approval->DoneData($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di kirim'));
		}
	} 

	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order_approval/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_request_order_approval->getdata_detail($id);
		echo $this->mdl_request_order_approval->togrid($data['row_data'], $data['row_count']);
	}
	
	 function DeleteDetail($kode) {
        $result = $this->mdl_request_order_approval->DeleteDetail($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dihapus'));
        }
    }

	
}