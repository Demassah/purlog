<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_outstanding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_outstanding');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_outstanding/index');
	}

	function grid(){
		$data = $this->mdl_report_outstanding->getdata_report_outstanding();
		echo $this->mdl_report_outstanding->togrid($data['row_data'], $data['row_count']);
	}
/* --------------------------------Report -------------------------------------- */
  function laporan_pdf($date_1,$date_2) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_outstanding->report_delivery_pdf($date_1,$date_2);
    	$konten = $this->load->view('report_outstanding/outstanding_report', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_outstanding".$date_1." To ".$date_2.".pdf");
  }

  function laporan_pdf_supp($supplier) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_outstanding->report_delivery_pdf_supp($supplier);
    	$konten = $this->load->view('report_outstanding/outstanding_report_supp', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_outstanding".$supplier.".pdf");
  }

  function laporan_pdf_kode($kode_barang) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_outstanding->report_delivery_pdf_kode($kode_barang);
    	$konten = $this->load->view('report_outstanding/outstanding_report_kode', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_outstanding".$kode_barang.".pdf");
  }

}

/* End of file laporan_penerimaan.php */
/* Location: ./application/controllers/laporan_penerimaan.php */