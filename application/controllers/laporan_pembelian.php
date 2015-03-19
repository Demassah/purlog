<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_pembelian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_buy');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_buy/index');
	}

	function grid(){
		$data = $this->mdl_report_buy->getdata_report_buy();
		echo $this->mdl_report_buy->togrid($data['row_data'], $data['row_count']);
	}
  /* --------------------------------Report PDF -------------------------------------- */
  function laporan_pdf($date_1,$date_2) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_buy->report_buy_pdf($date_1,$date_2);
    	$konten = $this->load->view('report_buy/buy_report', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_buy".$date_1." To ".$date_2.".pdf");
  }

  function laporan_pdf_supp($supplier) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_buy->report_buy_pdf_supp($supplier);
    	$konten = $this->load->view('report_buy/buy_report_supp', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_buy".$supplier.".pdf");
  }

  function laporan_pdf_kode($kode_barang) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_buy->report_buy_pdf_kode($kode_barang);
    	$konten = $this->load->view('report_buy/buy_report_kode', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_buy".$kode_barang.".pdf");
  }
  /* --------------------------------Report Excel -------------------------------------- */

  function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_buy->report_buy_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Price','Total','Date Create',));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','price','total','date_create',));
    $this->excel_generator->set_width(array(20, 12, 20, 15, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_buy_".$date_1." To ".$date_2);
  }

  function laporan_excel_supp($supplier) {
    $query = $this->mdl_report_buy->report_buy_excel_supp($supplier);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Price','Total','Date Create',));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','price','total','date_create',));
    $this->excel_generator->set_width(array(20, 12, 20, 15, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_buy_".$supplier);
  }

  function laporan_excel_kode($kode_barang) {
    $query = $this->mdl_report_buy->report_buy_excel_kode($kode_barang);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Price','Total','Date Create',));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','price','total','date_create',));
    $this->excel_generator->set_width(array(20, 12, 20, 15, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_buy_".$kode_barang);
  }




}

/* End of file laporan_pembelian.php */
/* Location: ./application/controllers/laporan_pembelian.php */