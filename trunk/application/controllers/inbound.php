<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inbound extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_inbound');
	//$this->output->enable_profiler(TRUE);
	}
	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('inbound/index');
	}

	function grid(){
		$data = $this->mdl_inbound->getdata();
		echo $this->mdl_inbound->togrid($data['row_data'], $data['row_count']);
	}
	/* --------------------------------Function Add -------------------------------------- */
	function add()
	{
		$this->load->view('inbound/form_add');
	}

	function SubInbound($id_po_re)
	{
			echo $this->mdl_inbound->OptionInbound($id_po_re);
	}

	function save($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_po_re", 'ID purchase order / Return', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_sub_po_re", 'ID purchase order / Return', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_inbound->Insert_inbound($data);
			}else { // edit
			$result=$this->mdl_quotation_request_selected->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	/* --------------------------------Function Done Inbound-------------------------------------- */
	function done($kode)
	{
		$result = $this->mdl_inbound->cek_detail($kode);
		if($result>=1){
		$result = $this->mdl_inbound->done($kode);

		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Data Gagal Dikirim'));
		}
		}else{
			echo json_encode(array('msg'=>'Detail Masih Kosong'));
		}
	}
	/* --------------------------------Function Delete Detail Inbound-------------------------------------- */
	function cancel($kode)
	{
		$result = $this->mdl_inbound->cancel($kode);
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Detail berhasil dihapus'));
			}
	}
	/* --------------------------------Function Detail-------------------------------------- */
	function detail_in($id){
    $data['id_in'] = $id;
    $data['item'] = $this->mdl_inbound->getId($id);
    $this->load->view('inbound/detail_in', $data);
	}

	function grid_detail($id){
  	$data = $this->mdl_inbound->getdata_detail($id);
		echo $this->mdl_inbound->togrid($data['row_data'], $data['row_count']);
  }
  /* --------------------------------Function Add Inbound-------------------------------------- */
  function add_detailIn($id,$type,$id_in)
  {
  	// $data['id_detail'] = $id;
  	// $data['type']=$type;
  	$data['list']=$this->mdl_inbound->get_iddetail($id,$type,$id_in);
  	$this->load->view('inbound/form_add_detail', $data, FALSE);
  }

  function save_detail($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("detail_id[]", 'receive', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_inbound->Insert_detail($data);
			}else { // edit
				$result=$this->mdl_inbound->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}
	

	 /* --------------------------------Function Delete Inbound-------------------------------------- */
	 function delete($kode)
	 {
		 $result = 	$this->mdl_inbound->delete($kode);

		 if($result){
		 	echo json_encode(array('success' => true ));
		 }else{
		 	echo json_encode(array('msg'=>'Data Gagal Dihapus'));
		 }
	}
 /* --------------------------------Function Cetak laporan Inbound-------------------------------------- */
	function laporan_pdf($id_in,$type) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('P', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');

      	$data['data_pdf'] = $this->mdl_inbound->report($id_in,$type);

      $konten = $this->load->view('inbound/in_report', $data, true);

      $html2pdf->writeHTML($konten, false);

      $html2pdf->Output("in_".date('d-m-y')."_".$id_in.".pdf");
  }

   public function laporan_excel($id_in,$type) {
        $query = $this->mdl_inbound->report_excel($id_in,$type);
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('ID Detail In', 'Kode Barang', 'Nama Barang', 'Qty', 'Lokasi'));
        $this->excel_generator->set_column(array('id_detail_in', 'kode_barang', 'nama_barang', 'qty', 'lokasi'));
        $this->excel_generator->set_width(array(25, 15, 30, 15, 15));
        $this->excel_generator->exportTo2007("in_".date('d-m-y')."_".$id_in);
    }

}

/* End of file inbound.php */
/* Location: ./application/controllers/inbound.php */