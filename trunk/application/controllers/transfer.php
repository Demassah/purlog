<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transfer extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_transfer');
		//$this->output->enable_profiler(TRUE);
	}
	/* ------------------------------------------------ Index ------------------------------------------------*/
	function index(){
		$this->load->view('transfer/transfer');
	}

	function grid(){
		$data = $this->mdl_transfer->getdata();
		echo $this->mdl_transfer->togrid($data['row_data'], $data['row_count']);
	}

	function send($id){
		$result = $this->mdl_request_order->countDetail($id);
		if($result > 0){
			$result = $this->mdl_request_order->SendData($id);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'Data gagal di kirim'));
			} 
		}else{
			echo json_encode(array('msg'=>'Detail Request Order Masih Kosong'));
		}
	}

	/* ------------------------------------------------ Add Data ------------------------------------------------*/
		
	function add(){
		$data['kode'] = '';
		$data['id_transfer'] = '';
	    $data['type_transfer'] = '';
	    $data['note'] = '';
	    $data['date_create'] =  date('Y-m-d H:i:s');
	    $data['user_id'] = '';
	    $data['status'] = '1';

		$this->load->view('transfer/form', $data);
	}

	function save(){
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';

		# rules validasi form		
		$this->form_validation->set_rules("type_transfer", 'Tipe Transfer', 'trim|required|xss_clean');
		$this->form_validation->set_rules("date_create", 'Date Create', 'trim|required|xss_clean');
		$this->form_validation->set_rules("user_id", 'Requestor', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			$result = $this->mdl_transfer->InsertOnDb($data);
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	

	/* ------------------------------------------------ Detail ------------------------------------------------*/

	function detail($id){
		$data['id_transfer'] = $id;
		$this->load->view('transfer/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_transfer->getdata_detail($id);
		echo $this->mdl_transfer->togrid($data['row_data'], $data['row_count']);
	}

	function deleteDetail($id){
		$result = $this->mdl_transfer->DeleteDetail($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	} 

	function load_kode_barang(){
		
		$data = $this->mdl_request_order->load_kode_barang( );
		$arr = array();
		array_push($arr, array('kode_barang'=>'','nama_barang'=>'&nbsp;'));
		foreach($data['row_data']->result() as $row){
			array_push($arr, array('kode_barang'=>$row->kode_barang, 'nama_barang'=>$row->nama_barang));
		}
		echo json_encode($arr);
	}

	/* ------------------------------------------------ add detail ------------------------------------------------*/
		function add_detail($id=null){
                if($id!=null){
                        $data['id_transfer'] = $id;
                }
                $this->load->view('transfer/form_detail', $data);
        }

        function getdata_transfer(){
                // get post
                $data['kode_barang'] = $this->input->post('kode_barang');
                $data['jumlah'] = $this->input->post('jumlah');
               
                echo $this->mdl_transfer->getdata_transfer($data);
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
                    $data['data']['id_transfer'] = $id;
            }

            $data['pesan_error'] = 'Data Gagal Disimpan';

            $result = $this->mdl_transfer->InsertDetailOnDB($data['data']);

            if($result) {
                    echo json_encode(array('success'=>true));
            } else {
                    echo json_encode(array('msg'=>$data['pesan_error']));
            }
        }

        function alokasi($kode){
		// get data
		$r  = $this->mdl_transfer->getdataedit($kode);

		# hidden input
		$data['kode'] = $kode;
		//$data['id_stock'] = $label->row()->id_stock;
		$data['kode_barang'] 	= $r->row()->kode_barang;
		$data['nama_barang'] 	= $r->row()->nama_barang;
		$data['qty_stock'] 		= $r->row()->qty_stock;
		$data['price'] 			= $r->row()->price;
		$data['lokasi_stock'] 	= $r->row()->lokasi_stock;
		$data['status'] 		= $r->row()->status;

		# data input barang
		$data['qty'] = '';
		$data['id_lokasi'] = '';

		$this->load->view('transfer/alokasi_form', $data);
	}


	function save_transfer(){
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';

		# rules validasi form		
		$this->form_validation->set_rules("qty", 'Qty', 'trim|numeric|required|xss_clean');
		$this->form_validation->set_rules("id_lokasi", 'Lokasi', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi dengan angka.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			$result = $this->mdl_transfer->Alokasi_insert($data);
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	function delete($id){
		$result = $this->mdl_transfer->DeleteOnDb($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	}

	function done($id){
		$result = $this->mdl_transfer->done($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	}

	function laporan_pdf($id_transfer) {
            $this->load->library('HTML2PDF');
            $html2pdf = new HTML2PDF('L', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            
            //filter
            //get filter
            //$fil['kd_prodi'] = $kd_prodi;
            
            //$data['nama'] = '';
            //$data['namaUniv'] = 'STMIK BANDUNG';
            //$data['alamatUniv'] = 'Jl.Phh.Mustofa No. 39. Grand Surapati Core (SUCORE) Blok M No.19, Telp.022 - 7207777';
            //$data['kotaUniv'] = 'Bandung, Jawa Barat';
            
            // ambil data dari tabel
            $data['data_pdf'] = $this->mdl_transfer->get_pdf($id_transfer);
            
            /* if (count($da['row'])==0){
            echo "Data Tidak Tersedia";
            return;
            } */
            
            $konten = $this->load->view('transfer/transfer_laporan', $data, true);
            
            $html2pdf->writeHTML($konten, false);
            
            $html2pdf->Output("transfer_".date('d-m-y')."_".$id_transfer.".pdf");
        }


}