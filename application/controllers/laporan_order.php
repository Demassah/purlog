<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_order');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_order/index');
	}

	function grid(){
		$data = $this->mdl_report_order->getdata_report_order();
		echo $this->mdl_report_order->togrid($data['row_data'], $data['row_count']);
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_order->report_order_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID RO', 'Ext Doc No','Date Create', 'Requestor','Detail RO','Kode Barang','Nama Barang','Qty'));
    $this->excel_generator->set_column(array('id_ro', 'ext_doc_no', 'date_create', 'full_name','id_detail_ro','kode_barang','nama_barang','qty'));
    $this->excel_generator->set_width(array(15, 20, 20, 20, 15, 15, 25, 10, 20));
    $this->excel_generator->exportTo2007("Report_order_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('P', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      	$data['data_pdf'] = $this->mdl_report_order->report_order_pdf($date_1,$date_2);
      	$konten = $this->load->view('report_order/order_report', $data, true);
     		$html2pdf->writeHTML($konten, false);
    	$html2pdf->Output("Report_order_".$date_1." To ".$date_2.".pdf");
  }



}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */