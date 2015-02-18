<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_shipment extends CI_Controller {
	public function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->model('mdl_report_shipment');
		//$this->output->enable_profiler(TRUE);
		}
	function index()
	{
		$this->load->view('report_shipment/index');
	}

	function grid()
	{
		$data = $this->mdl_report_shipment->getdata();
		echo $this->mdl_report_shipment->togrid($data['row_data'], $data['row_count']);	
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_shipment->report_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID SRO','ID RO','Requestor','ID Detail RO','ID Detail Pros','Kode Barang','Nama Barang','Qty','Stock','Lokasi','Date Create'));
    $this->excel_generator->set_column(array('id_sro','id_ro','full_name','id_detail_ro','id_detail_pros','kode_barang','nama_barang','qty','id_stock','id_lokasi','date_create'));
    $this->excel_generator->set_width(array(10, 15, 15, 15, 15, 12, 20, 15, 15, 25, 20));
    $this->excel_generator->exportTo2007("Report_Sro_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('L', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      	$data['data_pdf'] = $this->mdl_report_shipment->report_pdf($date_1,$date_2);
      	$konten = $this->load->view('report_shipment/sro_report', $data, true);
     		$html2pdf->writeHTML($konten, false);
    	$html2pdf->Output("Report_sro_".$date_1." To ".$date_2.".pdf");
  }

}

/* End of file laporan_shipment.php */
/* Location: ./application/controllers/laporan_shipment.php */