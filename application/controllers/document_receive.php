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

/* --------------------------------Detail -------------------------------------- */

	function detail($id){
		$data['id_do'] = $id;
		$this->load->view('document_receive/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_delivered->getdata_detail($id);
		echo $this->mdl_delivered->togrid($data['row_data'], $data['row_count']);
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