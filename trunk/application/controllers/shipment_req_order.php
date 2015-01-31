<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shipment_req_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_shipment_req_order');
		//$this->load->helper('tgl_indonesia');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		$this->load->view('shipment_req_order/index');
	}

	function grid()
	{
		$data = $this->mdl_shipment_req_order->getdata();
		echo $this->mdl_shipment_req_order->togrid($data['row_data'], $data['row_count']);	
	}

	function done($kode) {
		$result = $this->mdl_shipment_req_order->cek_id_sro($kode);
		if($result>=1){
	    $result = $this->mdl_shipment_req_order->done($kode);
	    if ($result) {
	        echo json_encode(array('success' => true));
	    } else {
	        echo json_encode(array('msg' => 'Data gagal dikirim'));
	    }
	  }else{
	  	echo json_encode(array('msg'=> 'Detail masih kosong'));
	  }
  }	
  
	function add()
	{
		$data['id_ro']='';
		$data['user_id']='';
		$data['date_create']='';
		$data['list']=$this->mdl_shipment_req_order->get_ro();
		$this->load->view('shipment_req_order/form_add', $data);
	}

	function save($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_ro[]", 'Requestor', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				//var_dump($data);
				$result = $this->mdl_shipment_req_order->Insert($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	function delete($kode) {
    $result = $this->mdl_shipment_req_order->delete($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dihapus'));
    }
  }	
	
	// detail function

	function detail($id_ro,$id_sro)
	{
		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$data['list']= $this->mdl_shipment_req_order->getdatadetail($id_ro,$id_sro);
		$this->load->view('shipment_req_order/detail', $data, FALSE);
	}

	function after($id_ro,$id_sro)
	{

		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$list= $this->mdl_shipment_req_order->getdatadetail($id_ro,$id_sro);
		echo'
			<table class="tbl" id="dg">		
				<thead>
					<tr>
						<th width="20"></th>
						<th width="120">ID Detail RO</th>
						<th width="120">ID RO</th>
						<th width="120">ID barang</th>
						<th width="120">Item Name</th>
						<th width="80">Qty</th>
						<th width="100">Lokasi</th>				
					</tr>
				</thead>
				<tbody>'; 
							foreach ($list as $l) {
								echo "<tr>";
								echo "<td><input type='checkbox' name='id_detail_pros[]'  value=".$l->id_detail_pros."></td>";
								echo "<td>".$l->id_detail_ro."</td>";
								echo "<td>".$l->id_ro."</td>";
								echo "<td>".$l->kode_barang."</td>";
								echo "<td>".$l->nama_barang."</td>";
								echo "<td>".$l->qty."</td>";
								echo "<td>".$l->id_lokasi."</td>";
								echo "</tr>";
							}
				echo'
					
				</tbody>
			</table>';
	}

	function add_detail($id_ro,$id_sro)
	{
		$data['id_ro']=$id_ro;
		$data['id_sro']=$id_sro;
		$data['list']=$this->mdl_shipment_req_order->getdataadddetail($id_ro,$id_sro);
		$this->load->view('shipment_req_order/add_detail', $data, FALSE);
	}

	function save_add_detail($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_detail_pros[]", 'ID Pros Detail', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_shipment_req_order->Insert_detail($data);
			}else { // edit
				$result=$this->mdl_shipment_req_order->Cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	 /* ------------------------ Report --------------------------------------------- */

  function laporan_pdf($id_sro,$id_ro) {
      $this->load->library('HTML2PDF');
      $html2pdf = new HTML2PDF('P', 'A4', 'fr');
      $html2pdf->setDefaultFont('Arial');
      $data['data_pdf'] = $this->mdl_shipment_req_order->report($id_sro,$id_ro);

      $konten = $this->load->view('shipment_req_order/sro_report', $data, true);

      $html2pdf->writeHTML($konten, false);

      $html2pdf->Output("sro_".date('d-m-y')."_".$id_sro.".pdf");
  }

  // autocomplete
  function selectsro()
  {
  	$data = $this->input->post('term');
  	$query = $this->mdl_shipment_req_order->searchSro($data);
  	header('Content-type:application/json');
  	echo json_encode($query);
  }


	
}