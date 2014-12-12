<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class picking_req_order_selected extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_picking');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('picking_req_order_selected/picking');
	}
	
	function grid(){
		$data = $this->mdl_picking->getdata();
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function doneData($kode) {
        $result = $this->mdl_picking->done($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dikirim'));
        }
    }


	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('picking_req_order_selected/detail_picking', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_picking->getdata_detail($id);
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function alocateData($kode) {
        $result = $this->mdl_picking->alocate($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dialokasi'));
        }
    }

    function alocateAll($kode) {
        $result = $this->mdl_picking->alocateAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dialokasi'));
        }
    }

	function available($id){
		$data['id_ro'] = $id;
		$this->load->view('picking_req_order_selected/available', $data);
	}

	function grid_available($id){
		$data = $this->mdl_picking->getdata_available($id);
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function realocateData($kode) {
        $result = $this->mdl_picking->realocateData($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal direlokasi'));
        }
    }

    function realocateAll($kode) {
        $result = $this->mdl_picking->realocateAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal direlokasi'));
        }
    }

   function lockSRO($kode) {
        $result = $this->mdl_picking->lockSRO($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dikunci'));
        }
    }

	function lock($id){
		$data['id_ro'] = $id;
		$this->load->view('picking_req_order_selected/lock', $data);
	}

	function lockAll($kode) {
        $result = $this->mdl_picking->lockAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dikunci'));
        }
    }

	function grid_lock($id){
		$data = $this->mdl_picking->getdata_lock($id);
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function pending($id){
		$data['id_ro'] = $id;
		$this->load->view('picking_req_order_selected/pending', $data);
	}

	function grid_pending($id){
		$data = $this->mdl_picking->getdata_pending($id);
		echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
	}

	function purchase(){
		$this->load->view('purchase_request/purchase_request');
	}
	
}