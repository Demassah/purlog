<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_purchase extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_purchase');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_purchase/index');
	}

	function grid(){
		$data = $this->mdl_report_purchase->getdata_report_purchase();
		echo $this->mdl_report_purchase->togrid($data['row_data'], $data['row_count']);
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_purchase->report_purchase_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID PR', 'ID RO','ID Detail RO', 'Kode Barang','Nama Barang','Requestor','Date Create', 'Note'));
    $this->excel_generator->set_column(array('id_pr', 'id_ro', 'id_detail_ro', 'kode_barang', 'nama_barang', 'full_name', 'date_create', 'note'));
    $this->excel_generator->set_width(array(15, 15, 15, 20, 25, 25, 20, 30));
    $this->excel_generator->exportTo2007("Report_purchase_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('L', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      	$data['data_pdf'] = $this->mdl_report_purchase->report_purchase_pdf($date_1,$date_2);
      	$konten = $this->load->view('report_purchase/purchase_report', $data, true);
     		$html2pdf->writeHTML($konten, false);
    	$html2pdf->Output("Report_purchase_".$date_1." To ".$date_2.".pdf");
  }



}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */