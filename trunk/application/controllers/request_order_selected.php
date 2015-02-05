<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_selected extends CI_Controller {

function __construct(){
		parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
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

	function detailROS($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order_selected/detailROS', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_request_order_selected->getdata_detail($id);
		echo $this->mdl_request_order_selected->togrid($data['row_data'], $data['row_count']);
	}
	
	function add(){
		$data['kode'] = '';
		$this->load->view('request_order_selected/form', $data);
	}

	 function alocate($kode) {
        $result = $this->mdl_request_order_selected->alocate($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dialokasi'));
        }
    }

    function done($kode) {
    	$result = $this->mdl_request_order_selected->countNewItem($kode);
		if($result == 0){
	        $result = $this->mdl_request_order_selected->done($kode);
	        if (!$result){
                echo json_encode(array('msg'=>'Data gagal di kirim'));
            } else {
                echo json_encode(array('success'=>true));
            } 
        }else{
            echo json_encode(array('msg'=>'Detail Request Order Selected Masih Kosong'));
        }
    }

    function edit($kode) {
    	// $r = false;
     //    $data['pesan_error'] = '';

        $r = $this->mdl_request_order_selected->getdataedit($kode);
        
        $data['kode'] 				= $kode;
        $data['id_ro'] 				= $r->row()->id_ro;
        $data['ext_doc_no'] 		= $r->row()->ext_doc_no;
        $data['type'] 		        = $r->row()->type;
        $data['id_kategori'] 		= $r->row()->id_kategori;
        $data['id_sub_kategori'] 	= $r->row()->id_sub_kategori;
        $data['kode_barang'] 		= $r->row()->kode_barang;
        $data['qty'] 				= $r->row()->qty;
        $data['barang_bekas']		= $r->row()->barang_bekas;
        $data['user_id']			= $r->row()->user_id;
        $data['date_create'] 		= $r->row()->date_create;
        $data['note'] 				= $r->row()->note;
        $data['status']				= $r->row()->status;
        $data['status_delete'] 		= $r->row()->status_delete;
        $data['id_sro'] 			= $r->row()->id_sro;
        
        $this->load->view('request_order_selected/form_detail', $data);
        
        /*
        if ($r) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Bukan Type New Item'));
        }*/
        
    }

    function save($aksi) {
        // init
        $status = "";
        $result = false;
        $data['pesan_error'] = '';
        // get post data
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        # rules validasi form       
        $this->form_validation->set_rules("kode_barang", 'Barang', 'trim|required|xss_clean');

        # message rules
        $this->form_validation->set_message('required', 'Data Gagal Disimpan, Barang harus tipe New Item');
        //$data['pesan_error'] = 'Data Gagal Disimpan';

        $data['pesan_error'] = '';
        if ($this->form_validation->run() == FALSE){
            $data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
        }else{
            $result = $this->mdl_request_order_selected->UpdateOnDb($data);
        }
        
         if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $data['pesan_error']));
        }
    }

}

/* End of file request_order_selected.php */
/* Location: ./application/controllers/request_order_selected.php */