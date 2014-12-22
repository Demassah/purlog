<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order_approval extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_request_order_approval');
		$this->load->model('mdl_request_order');
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
		$result = $this->mdl_request_order_approval->countDetail($id);
		if($result > 0){
			$result = $this->mdl_request_order_approval->DoneData($id);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
			echo json_encode(array('msg'=>'Data gagal di kirim'));
			}
		}else{
			echo json_encode(array('msg'=>'Detail Request Order Masih Kosong'));
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

    function add_detail($id){
		// get data
		$label  = $this->mdl_request_order->getdataedit($id);
		$detail = $this->mdl_request_order->getDetail($label->row()->id_ro);

		# hidden input
		$data['id_ro'] = $id;
		$data['ext_doc_no'] = $label->row()->ext_doc_no;
		$data['full_name'] = $label->row()->full_name;
		$data['user_id'] = $label->row()->user_id;
		$data['date_create'] = $label->row()->date_create;
		
		# data input barang
		$data['id_kategori'] = '';
		$data['id_sub_kategori'] = '';
		$data['kode_barang'] = '';
		$data['qty'] = '';
		$data['barang_bekas'] = '';
		$data['note'] = '';
		$data['status'] = '';
		$data['status_delete'] = '';
		$data['id_sro'] = '';

		$this->load->view('request_order_approval/form_detail', $data);
	}
	
}