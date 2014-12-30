<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class document_receive extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_document_receive');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('document_receive/dr');
	}

	function grid(){
		$data = $this->mdl_document_receive->getdata();
		echo $this->mdl_document_receive->togrid($data['row_data'], $data['row_count']);
	}

	function add_dr(){
        $this->load->view('document_receive/add_dr');
    }

    function getdata(){
            // get post
            $data['id_sro'] = $this->input->post('id_sro');
            $data['jumlah'] = $this->input->post('jumlah');
           
            echo $this->mdl_document_receive->getdata_dr($data);
    }

    function save(){
            # init
            $status = "";
            $result = false;
            $data['pesan_error'] = '';
           
            # get post data
            foreach($_POST as $key => $value){
                    $data[$key] = $value;
            }
           
            $data['pesan_error'] = 'Data Gagal Disimpan';
           
            $result=$this->mdl_document_receive->InsertOnDB($data['data']);
           
            if($result){
                    echo json_encode(array('success'=>true));
            }else{
                    echo json_encode(array('msg'=>$data['pesan_error']));
            }
    }

    function doneData($kode) {
        $result = $this->mdl_document_receive->done($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal diterima'));
        }
    }

    function deleteData($kode) {
        $result = $this->mdl_document_receive->DeleteOnDB($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dihapus'));
        }
    }

/* --------------------------------Detail -------------------------------------- */

	function detail($id){
		$data['id_receive'] = $id;
		$this->load->view('document_receive/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_document_receive->getdata_detail($id);
		echo $this->mdl_document_receive->togrid($data['row_data'], $data['row_count']);
	}

	function save_qty(){
        # get post data
        $ids = array();
        foreach($_POST as $key => $value){
            $data[$key] = $value;
        }


        foreach($data['data_qty']['rows'] as $dt){
            $ids[] = $dt['id_detail_pros'];
        }

        if(sizeof($ids) > 0) {
            $prevData = $this->mdl_document_receive->getProsDetailIds  ($ids)->result();
        }


        # init
        $status = "";
        $data['pesan_error'] = 'Data gagal di realokasi';
       
        $error = false;
        $result = false;

        foreach($data['data_qty']['rows'] as $new) {
            $prev = $this->mdl_document_receive->getProsDetail   ($new['id_detail_pros'])->row();
            if($prev->qty < $new['qty'] || $new['qty'] < 0) {
                $error = true;
            }
        }
        if(!$error) {
            $result = $this->mdl_document_receive->update_qty($data);
        }
       
        if($result){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>$data['pesan_error']));
        }
    }

/* --------------------------------      -------------------------------------- */

	function detail_dr(){
		$this->load->view('document_receive/detail_dr');
	}

	function receive(){
		$this->load->view('document_receive/receive');
	}

	
	function add(){
		$data['kode'] = '';
		$data['id_kategori'] = '';
		$data['nama_kategori'] = '';
		
		$this->load->view('document_receive/dr_form', $data);
	}
	
	
}