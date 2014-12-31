<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_return');
		//$this->output->enable_profiler(TRUE);
	}

	function index(){
		$this->load->view('return/return');
	}

	function grid(){
        $data = $this->mdl_return->getdata();
        echo $this->mdl_return->togrid($data['row_data'], $data['row_count']);
    }

    function add_return(){
        $this->load->view('return/add_return');
    }

    function getdata_add_return(){
        // get post
        $data['id_receive'] = $this->input->post('id_receive');
        $data['jumlah'] = $this->input->post('jumlah');

        echo $this->mdl_return->getdata_add_return($data);
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

		$result=$this->mdl_return->InsertOnDB($data['data']);

		if($result){
				echo json_encode(array('success'=>true));
			}else{
					echo json_encode(array('msg'=>$data['pesan_error']));
			}
		}

// ----------------------------------------------------- Detail --------------------------------------------------

		function detail_return($id){
                $data['id_return'] = $id;
                $this->load->view('return/detail_return', $data);
        }

        function grid_detail($id){
                $data = $this->mdl_return->getdata_detail($id);
                echo $this->mdl_return->togrid($data['row_data'], $data['row_count']);
        }

        function add_detail_return($id=null){
                if($id!=null){
                        $data['id_return'] = $id;
                        $data['id_receive'] = $this->mdl_return->get_id_receive($id);
                }
                $this->load->view('return/add_detail_return', $data);
        }

        function getdata_add_detail_return(){
                // get post            
                $data['id_return'] = $this->input->post('id_return');
                $data['jumlah'] = $this->input->post('jumlah');
               
                echo $this->mdl_return->getdata_add_detail_return($data);
        }

        function saveDetail($id=null) {
            # init
            $result = false;
            $data['pesan_error'] = '';
           
            # get post data
            foreach($_POST as $key => $value) {
                    $data[$key] = $value;
            }

            if($id != null) {
                    $data['data']['id_return'] = $id;
            }

            $data['pesan_error'] = 'Data Gagal Disimpan';

            $result = $this->mdl_return->InsertDetailOnDB($data['data']);

            if($result) {
                    echo json_encode(array('success'=>true));
            } else {
                    echo json_encode(array('msg'=>$data['pesan_error']));
            }
        }

        function doneData($kode) {
	        $result = $this->mdl_return->done($kode);
	        if ($result) {
	            echo json_encode(array('success' => true));
	        } else {
	            echo json_encode(array('msg' => 'Data gagal dikirim'));
	        }
	    }


}