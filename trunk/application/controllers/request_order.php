<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_request_order');
		//$this->output->enable_profiler(TRUE);
	}
	/* ------------------------------------------------ Index ------------------------------------------------*/
	function index(){
		$this->load->view('request_order/index');
	}

	function grid(){
		$data = $this->mdl_request_order->getdata();
		echo $this->mdl_request_order->togrid($data['row_data'], $data['row_count']);
	}
		
	function add(){
		date_default_timezone_set('Asia/Jakarta');
		$data['kode'] = '';
		$data['id_ro'] = '';
	    $data['user_id'] = '';
	    $data['purpose'] = '';
	    $data['cat_req'] = '';
	    $data['ext_doc_no'] = '';
	    $data['no_rangka'] = '';
	    $data['no_polisi'] = '';
	    $data['ETD'] = date('d/m/Y');
	    $data['date_create'] =  date('Y-m-d H:i:s');
		$data['status'] = '';

		$this->load->view('request_order/form', $data);
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
		$this->form_validation->set_rules("user_id", 'Requestor', 'trim|required|xss_clean');
		$this->form_validation->set_rules("purpose", 'Purpose', 'trim|required|xss_clean');
		$this->form_validation->set_rules("cat_req", 'category Req', 'trim|required|xss_clean');
		$this->form_validation->set_rules("ext_doc_no", 'Ext Document No', 'trim|required|xss_clean');
		$this->form_validation->set_rules("no_rangka", 'No. Rangka', 'trim|required|xss_clean');
		$this->form_validation->set_rules("no_polisi", 'No. Polisi', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			$result = $this->mdl_request_order->InsertOnDb($data);
		}
		
		if(!$result){
			echo json_encode(array('msg'=>$data['pesan_error']));
		}else{
			echo json_encode(array('success'=>true, 'id_object'=>$result));
		}
	}

	function send($id){
		$result = $this->mdl_request_order->countDetail($id);
		if($result > 0){
			$result = $this->mdl_request_order->SendData($id);
			if (!$result){
				echo json_encode(array('msg'=>'Data gagal di kirim'));
			} else {
				echo json_encode(array('success'=>true, 'id_object'=>$result));
			} 
		}else{
			echo json_encode(array('msg'=>'Detail Request Order Masih Kosong'));
		}
	}

	function delete($id){
		$result = $this->mdl_request_order->DeleteOnDb($id);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di hapus'));
		}
	} 

	/* ------------------------------------------------ Detail ------------------------------------------------*/

	function detail($id){
		$data['id_ro'] = $id;
		$this->load->view('request_order/detail', $data);
	}

	function grid_detail($id){
		$data = $this->mdl_request_order->getdata_detail($id);
		echo $this->mdl_request_order->togrid($data['row_data'], $data['row_count']);
	}

	function deleteDetail($id){
		$result = $this->mdl_request_order->DeleteDetail($id);
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

		$this->load->view('request_order/form_detail', $data);
	}
	
	function save_detail(){
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';

		# rules validasi form		
		$this->form_validation->set_rules("kode_barang", 'Barang', 'trim|required|xss_clean');
		$this->form_validation->set_rules("qty", 'Qty', 'trim|numeric|required|xss_clean');
		$this->form_validation->set_rules("barang_bekas", 'Barang Bekas', 'trim|required|xss_clean');
		$this->form_validation->set_rules("note", 'Note', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi dengan angka.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			$result = $this->mdl_request_order->Update_DetailRO($data);
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	function laporan_pdf($id_ro) {
            $this->load->library('HTML2PDF');
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            
            //filter
            //get filter
            //$fil['kd_prodi'] = $kd_prodi;
            
            //$data['nama'] = '';
            //$data['namaUniv'] = 'STMIK BANDUNG';
            //$data['alamatUniv'] = 'Jl.Phh.Mustofa No. 39. Grand Surapati Core (SUCORE) Blok M No.19, Telp.022 - 7207777';
            //$data['kotaUniv'] = 'Bandung, Jawa Barat';
            
            // ambil data dari tabel
            $data['data_pdf'] = $this->mdl_request_order->get_pdf($id_ro);
            
            /* if (count($da['row'])==0){
            echo "Data Tidak Tersedia";
            return;
            } */
            
            $konten = $this->load->view('request_order/ro_laporan', $data, true);
            
            $html2pdf->writeHTML($konten, false);
            
            $html2pdf->Output("ros_".date('d-m-y')."_".$id_ro.".pdf");
        }

}