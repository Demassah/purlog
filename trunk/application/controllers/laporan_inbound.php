<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_inbound extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_inbound/index');
	}

	function grid(){
		$data = $this->mdl_report->getdata_report_inbound();
		echo $this->mdl_report->togrid($data['row_data'], $data['row_count']);
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report->report_in_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID In','Ext Rec No','Type','Date Create','Requestor','Detail In','Kode Barang','Nama Barang','Qty','Lokasi'));
    $this->excel_generator->set_column(array('id_in','ext_rec_no','type','date_create','full_name','id_detail_in','kode_barang','nama_barang','qty','lokasi'));
    $this->excel_generator->set_width(array(10, 15, 5, 25, 20, 12, 15, 20, 15, 15));
    $this->excel_generator->exportTo2007("Report_in_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('L', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');

      	$data['data_pdf'] = $this->mdl_report->report_in_pdf($date_1,$date_2);

      $konten = $this->load->view('report_inbound/in_report', $data, true);

      $html2pdf->writeHTML($konten, false);

      $html2pdf->Output("Report_in_".$date_1." To ".$date_2.".pdf");
  }



}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */