<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vendor_selected extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_vendor_selected');
	}
	// -------------------------------------------------------Index Grid------------------------------------------------------------- //
	function index(){
		$this->load->view('vendor_selected/index');
	}

	function grid(){
		$data = $this->mdl_vendor_selected->getdata();
		echo $this->mdl_vendor_selected->togrid($data['row_data'], $data['row_count']);
	}

	// ---------------------------------------------------Done Vendor -------------------------------------------------------------- //
   function Done($kode,$id_qrs)
  {
  	$result = $this->mdl_vendor_selected->cek_pr_qr($kode,$id_qrs);
  	if($result >= 1){
  		$result = $this->mdl_vendor_selected->done($kode,$id_qrs);
	  	if($result)
	  	{
	  		echo json_encode(array('success' => true));
	  	}else{
	  		echo json_encode(array('msg'=> 'No Vendor Selected'));	
	  	}
	  }else{
	  	echo json_encode(array('msg'=> 'No Vendor Selected'));	
	  }
  }
  // ---------------------------------------------------Select Vendor ------------------------------------------------------------ //
	function select_vendor($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
		$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_vendor_selected->list_pr($id_pr,$id_qrs);

		$this->load->view('vendor_selected/select_vendor', $data, FALSE);
	}

	function Selected($kode,$id_pr,$id_qrs) {
    $result = $this->mdl_vendor_selected->selected($kode,$id_pr,$id_qrs);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim atau harga berisi Nol'));
    }
  }

  function after_select($id_pr,$id_qrs)
	{
		$data['id_pr'] = $id_pr;
  	$data['id_qrs'] = $id_qrs;
		$data['list'] = $this->mdl_vendor_selected->list_pr($id_pr,$id_qrs);

		$this->load->view('vendor_selected/load', $data, FALSE);
	}

}

/* End of file vencor_selected.php */
/* Location: ./application/controllers/vencor_selected.php */