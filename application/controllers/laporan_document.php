<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_document extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_document');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_document/index');
	}

	function grid(){
		$data = $this->mdl_report_document->getdata_report_document();
		echo $this->mdl_report_document->togrid($data['row_data'], $data['row_count']);
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_document->report_document_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID DR', 'ID Detail DR', 'ID RO','ID SRO', 'Kode Barang','Nama Barang','Qty Delivered', 'Qty Received','Date Create'));
    $this->excel_generator->set_column(array('id_receive', 'id_detail_receive', 'id_ro', 'id_sro', 'kode_barang','nama_barang', 'qty_delivered', 'qty', 'date_create'));
    $this->excel_generator->set_width(array(15, 15,15, 15, 20, 25, 10, 10, 20));
    $this->excel_generator->exportTo2007("Report_document-receive_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('L', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      	$data['data_pdf'] = $this->mdl_report_document->report_document_pdf($date_1,$date_2);
      	$konten = $this->load->view('report_document/document_report', $data, true);
     		$html2pdf->writeHTML($konten, false);
    	$html2pdf->Output("Report_document_".$date_1." To ".$date_2.".pdf");
  }



}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */