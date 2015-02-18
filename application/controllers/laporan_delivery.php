<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_delivery extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_delivery');
	//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_delivery/index');
	}

	function grid(){
		$data = $this->mdl_report_delivery->getdata_report_delivery();
		echo $this->mdl_report_delivery->togrid($data['row_data'], $data['row_count']);
	}

	function laporan_excel($date_1,$date_2) {
    $query = $this->mdl_report_delivery->report_delivery_excel($date_1,$date_2);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID DO', 'Courir','Date Create', 'ID SRO','ID RO', 'Requestor', 'Departemen'));
    $this->excel_generator->set_column(array('id_do', 'name_courir', 'date_create', 'id_sro','id_ro','full_name','departement_name'));
    $this->excel_generator->set_width(array(15, 20, 20, 15, 15, 20, 20));
    $this->excel_generator->exportTo2007("Report_delivery_".$date_1." To ".$date_2);
  }

  function laporan_pdf($date_1,$date_2) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('P', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      	$data['data_pdf'] = $this->mdl_report_delivery->report_delivery_pdf($date_1,$date_2);
      	$konten = $this->load->view('report_delivery/delivery_report', $data, true);
     		$html2pdf->writeHTML($konten, false);
    	$html2pdf->Output("Report_delivery_".$date_1." To ".$date_2.".pdf");
  }



}

/* End of file laporan_inbound.php */
/* Location: ./application/controllers/laporan_inbound.php */