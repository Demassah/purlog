<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_penerimaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_accept');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_accept/index');
	}

	function grid(){
		$data = $this->mdl_report_accept->getdata_report_accept();
		echo $this->mdl_report_accept->togrid($data['row_data'], $data['row_count']);
	}
  /* --------------------------------Report PDF -------------------------------------- */
  function laporan_pdf($date_1,$date_2) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_accept->report_accept_pdf($date_1,$date_2);
    	$konten = $this->load->view('report_accept/accept_report', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_accept".$date_1." To ".$date_2.".pdf");
  }

  function laporan_pdf_supp($supplier) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_accept->report_accept_pdf_supp($supplier);
    	$konten = $this->load->view('report_accept/accept_report_supp', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_accept".$supplier.".pdf");
  }

  function laporan_pdf_kode($kode_barang) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    	$data['data_pdf'] = $this->mdl_report_accept->report_accept_pdf_kode($kode_barang);
    	$konten = $this->load->view('report_accept/accept_report_kode', $data, true);
   		$html2pdf->writeHTML($konten, false);
  	$html2pdf->Output("Report_accept".$kode_barang.".pdf");
  }
  /* --------------------------------Report Excel -------------------------------------- */
  function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_accept->report_accept_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Dipesan','Diterima','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','dipesan','diterima','price','total','date_create'));
    $this->excel_generator->set_width(array(12, 20, 15, 20, 12, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_accept_".$date_1." To ".$date_2);
  }

  function laporan_excel_supp($supplier) {
    $query = $this->mdl_report_accept->report_accept_excel_supp($supplier);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Dipesan','Diterima','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','dipesan','diterima','price','total','date_create'));
    $this->excel_generator->set_width(array(12, 20, 15, 20, 12, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_accept_".$supplier);
  }

  function laporan_excel_kode($kode_barang) {
    $query = $this->mdl_report_accept->report_accept_excel_kode($kode_barang);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PO','Supplier','Kode Barang','Nama Barang','Dipesan','Diterima','Price','Total','Date Create'));
    $this->excel_generator->set_column(array('id_po','name_vendor','kode_barang','nama_barang','dipesan','diterima','price','total','date_create'));
    $this->excel_generator->set_width(array(12, 20, 15, 20, 12, 12, 20, 20, 20));
    $this->excel_generator->exportTo2007("Report_accept_".$kode_barang);
  }

}

/* End of file laporan_penerimaan.php */
/* Location: ./application/controllers/laporan_penerimaan.php */