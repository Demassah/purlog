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

			if($aksi=="add"){ // add
			//print_r($data['id_detail_qrs']);
			$result = $this->mdl_quotation_request_selected->Insert_detail();
			}else { // edit
				$result=$this->mdl_quotation_request_selected->cancel($data);
			}		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim '));
		}
	


  // function save_detail($aksi){
		// # init
		// $status = "";
		// $result = false;
		// $data['pesan_error'] = '';
		
		// # get post data
		// foreach($_POST as $key => $value){
		// 	$data[$key] = $value;
		// }
		
		// # rules validasi form
		// $this->form_validation->set_rules("detail_id[]", 'receive', 'trim|required|xss_clean');
		// # message rules
		// $this->form_validation->set_message('required', 'Field %s harus diisi.');

		// $data['pesan_error'] = '';
		// if ($this->form_validation->run() == FALSE){
		// 	$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		// }else{
		// 	if($aksi=="add"){ // add
		// 	//print_r($data);
		// 	$result = $this->mdl_inbound->Insert_detail($data);
		// 	}else { // edit
		// 		$result=$this->mdl_inbound->cancel($data);
		// 	}
		// }

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

		public function laporan_excel2($id_in,$type) {
        $data['data_pdf'] = $this->mdl_inbound->report($id_in,$type);
        $this->load->view('inbound/in_report_excel', $data, FALSE);
    }

   public function laporan_excel1($id_in,$type) {
        $query = $this->mdl_inbound->report_excel($id_in,$type);
        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('ID Detail In', 'Kode Barang', 'Nama Barang', 'Qty', 'Lokasi'));
        $this->excel_generator->set_column(array('id_detail_in', 'kode_barang', 'nama_barang', 'qty', 'lokasi'));
        $this->excel_generator->set_width(array(25, 15, 30, 15, 15));
        $this->excel_generator->exportTo2007("in_".date('d-m-y')."_".$id_in);
    }

    public function laporan_excel($id_in,$type)
        {
            //load librarynya terlebih dahulu
            //jika digunakan terus menerus lebih baik load ini ditaruh di auto load
            $this->load->library("PHPExcel/PHPExcel");
 						$file = "in_".date('d-m-y')."_".$id_in;
            //membuat objek PHPExcel
            $objPHPExcel = new PHPExcel();
 						$data_pdf = $this->mdl_inbound->report($id_in,$type);
            //set Sheet yang akan diolah 
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(1);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(1);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11.25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
            //Mengeset Syle nya
							//Mengeset Syle nya



            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Header
                    										->setCellValue('E1', 'Inbound')
                                        ->setCellValue('D2', 'ID IN')
                                        ->setCellValue('E2',':')
                                        ->setCellValue('F2',$data_pdf[0]->id_in)
                    //Detail Info
                    										->setCellValue('B3','Requestor')
                    										->setCellValue('C3',':')
                    										->setCellValue('D3',$data_pdf[0]->full_name)
                    										->setCellValue('F3','Requestor')
                    										->setCellValue('G3',':')
                    										->setCellValue('H3',$data_pdf[0]->ext_doc_no)

                    										->setCellValue('B4','Departement')
                    										->setCellValue('C4',':')
                    										->setCellValue('D4',$data_pdf[0]->departement_name)
                    										->setCellValue('F4','Date Create')
                    										->setCellValue('G4',':')
                    										->setCellValue('H4',$data_pdf[0]->date_create)

                    										->setCellValue('B5','Purpose')
                    										->setCellValue('C5',':')
                    										->setCellValue('D5',$data_pdf[0]->purpose)
                    										->setCellValue('F5','ID PR')
                    										->setCellValue('G5',':')
                    										->setCellValue('H5',$data_pdf[0]->id_pr)

                    										->setCellValue('B6','Category Request')
                    										->setCellValue('C6',':')
                    										->setCellValue('D6',$data_pdf[0]->cat_req)
                    										->setCellValue('F6','ID RO')
                    										->setCellValue('G6',':')
                    										->setCellValue('H6',$data_pdf[0]->id_ro)

                    										->setCellValue('B8','ID Detail In')
                    										->setCellValue('D8','Kode Barang')
                    										->setCellValue('E8','Nama Barang')
                    										->setCellValue('F8','Qty')
                    										->setCellValue('H8','Lokasi');
             $baris  = 9;
             foreach ($data_pdf as $data){
             		$objPHPExcel->setActiveSheetIndex(0)
             														->setCellValue('B'.$baris,$data->id_detail_in)
                    										->setCellValue('D'.$baris,$data->kode_barang)
                    										->setCellValue('E'.$baris,$data->nama_barang)
                    										->setCellValue('F'.$baris,$data->qty)
                    										->setCellValue('H'.$baris,$data->lokasi);
                $baris++;    										
              };
							
							
            //set title pada sheet (me rename nama sheet)
            $objPHPExcel->getActiveSheet()->setTitle('Report Inbound_'.$file);
 
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh

            header('Content-Disposition: attachment;filename='.$file.'.xlsx');
            //unduh file
            $objWriter->save("php://output");
 
            //Mulai dari create object PHPExcel itu ada dokumentasi lengkapnya di PHPExcel, 
            // Folder Documentation dan Example
            // untuk belajar lebih jauh mengenai PHPExcel silakan buka disitu
 
        }

}

/* End of file inbound.php */
/* Location: ./application/controllers/inbound.php */