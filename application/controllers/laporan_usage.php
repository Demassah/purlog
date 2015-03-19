<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_usage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_usage');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_usage/index');
	}

	function grid(){
		$data = $this->mdl_report_usage->getdata_report_usage();
		echo $this->mdl_report_usage->togrid($data['row_data'], $data['row_count']);
	}
	/* --------------------------------Report PDF -------------------------------------- */
  function laporan_pdf($date_1,$date_2) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_usage->report_usage_pdf($date_1,$date_2);
    	$konten = $this->load->view('report_usage/usage_report', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_usage".$date_1." To ".$date_2.".pdf");
  }

   function laporan_pdf_rangka($no_rangka) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_usage->report_usage_pdf_rangka($no_rangka);
    	$konten = $this->load->view('report_usage/usage_report_rangka', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_usage".$no_rangka.".pdf");
  }

  function laporan_pdf_polisi($no_polisi) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
      $data['data_pdf'] = $this->mdl_report_usage->report_usage_pdf_polisi($no_polisi);
      $konten = $this->load->view('report_usage/usage_report_polisi', $data, true);
      $html2pdf->writeHTML($konten, false);
    $html2pdf->Output("report_usage".$no_polisi.".pdf");
  }

  function laporan_pdf_kode($kode_barang) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_usage->report_usage_pdf_kode($kode_barang);
    	$konten = $this->load->view('report_usage/usage_report_kode', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("report_usage".$kode_barang.".pdf");
  }
  /* --------------------------------Report Excel -------------------------------------- */

  function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_usage->report_usage_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID Pros Detail','No Rangka','No Polisi','Kode Barang','Nama Barang','Qty','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_detail_pros','no_rangka','no_polisi','kode_barang','nama_barang','qty','price','total','date_create'));
    $this->excel_generator->set_width(array(20, 25, 15, 15, 20, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_usage_".$date_1." To ".$date_2);
  }

  function laporan_excel_rangka($no_rangka) {
    $query = $this->mdl_report_usage->report_usage_excel_rangka($no_rangka);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID Pros Detail','No Rangka','No Polisi','Kode Barang','Nama Barang','Qty','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_detail_pros','no_rangka','no_polisi','kode_barang','nama_barang','qty','price','total','date_create'));
    $this->excel_generator->set_width(array(20, 25, 15, 15, 20, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_usage_".$no_rangka);
  }

  function laporan_excel_polisi($no_polisi) {
    $query = $this->mdl_report_usage->report_usage_excel_polisi($no_polisi);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID Pros Detail','No Rangka','No Polisi','Kode Barang','Nama Barang','Qty','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_detail_pros','no_rangka','no_polisi','kode_barang','nama_barang','qty','price','total','date_create'));
    $this->excel_generator->set_width(array(20, 25, 15, 15, 20, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_usage_".$no_polisi);
  }

  function laporan_excel_kode($kode_barang) {
    $query = $this->mdl_report_usage->report_usage_excel_kode($kode_barang);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID Pros Detail','No Rangka','No Polisi','Kode Barang','Nama Barang','Qty','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_detail_pros','no_rangka','no_polisi','kode_barang','nama_barang','qty','price','total','date_create'));
    $this->excel_generator->set_width(array(20, 25, 15, 15, 20, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_usage_".$kode_barang);
  }

}

/* End of file laporan_usage.php */
/* Location: ./application/controllers/laporan_usage.php */