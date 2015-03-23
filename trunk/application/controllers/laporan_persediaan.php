<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_persediaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_report_inventory');
		//$this->output->enable_profiler(TRUE);
	}

	/* --------------------------------list -------------------------------------- */
	function index(){
		$this->load->view('report_inventory/index');
	}

	function grid(){
		$data = $this->mdl_report_inventory->getdata_report_inventory();
		echo $this->mdl_report_inventory->togrid($data['row_data'], $data['row_count']);
	}
	/* --------------------------------Report Excel -------------------------------------- */

function laporan_excel_kode($date_1) {
    $query = $this->mdl_report_inventory->report_inventory_excel_kode($date_1);
    $this->excel_generator->set_query($query);
    $this->excel_generator->set_header(array('ID Stock','Kode Barang','Nama Barang','Qty Stock','Price'));
    $this->excel_generator->set_column(array('id_stock','kode_barang','nama_barang','stock','price'));
    $this->excel_generator->set_width(array(20, 25, 25, 25, 25, 25));
    $this->excel_generator->exportTo2007("Report_inventory_".$date_1);
  }
}

/* End of file laporan_persediaan.php */
/* Location: ./application/controllers/laporan_persediaan.php */