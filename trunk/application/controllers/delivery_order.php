<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delivery_order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_delivery_order');
		//$this->load->model('mdl_courir');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('delivery_order/index');
	}
	
	function grid(){
		$data = $this->mdl_delivery_order->getdata();
		echo $this->mdl_delivery_order->togrid($data['row_data'], $data['row_count']);
	}

	function doneData($kode) {
    $result = $this->mdl_delivery_order->cek_sro($kode);
    if ($result>0) {
    		$result = $this->mdl_delivery_order->done($kode);
    		if($result){
						echo json_encode(array('success' => true));
			    } else {
			        echo json_encode(array('msg' => 'Data gagal dikirim'));
			    }
			  }else{
			  	echo json_encode(array('msg'=> 'Detail masih kosong'));
			  }
        
  }	

  function add(){
		$this->data['id_user'] = $this->session->userdata('user_id');
		$this->data['date'] = date('Y-m-d H:i:s ');
		$this->data['status']=1;
		//$this->data['list'] = $this->mdl_courir->v_courir();
		$this->load->view('delivery_order/form',$this->data);
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
		$this->form_validation->set_rules("id_user", 'Requestor', 'trim|required|xss_clean');
		$this->form_validation->set_rules("id_courir", 'Courir', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
				$result = $this->mdl_delivery_order->InsertOnDb($data);
			}else { // edit
				$result=$this->mdl_delivery_order->UpdateOnDb($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}

	function delete($kode) {
    $result = $this->mdl_delivery_order->delete($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dihapus'));
    }
  }	

	// Detail Function

	function detail($id_do){
		$data['id_do']=$id_do;
		$data['item'] = $this->mdl_delivery_order->getdatadetail($id_do);
		$this->load->view('delivery_order/detail_delivery',$data);
	}

	//Cetak DO
	
	 function laporan_pdf($id_do) {
    $this->load->library('HTML2PDF');
    $html2pdf = new HTML2PDF('L', 'A5', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $data['data_pdf'] = $this->mdl_delivery_order->report($id_do);

    $konten = $this->load->view('delivery_order/do_report', $data, true);

    $html2pdf->writeHTML($konten, false);

    $html2pdf->Output("do_".date('d-m-y')."_".$id_do.".pdf");
  }

	// detail sro
	function detail_ro($id_sro='')
	{
		$data['list']=$this->mdl_delivery_order->detail_ro($id_sro);
		$this->load->view('delivery_order/detail_ro', $data, FALSE);
	}

	// funtion Add SRO
	function add_detail($id_do)
	{
		$data['id_do']=$id_do;
		$data['list']=$this->mdl_delivery_order->getdataadddetail();
		$this->load->view('delivery_order/add_detail', $data);
	}

	function save_add($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_sro[]", 'ID SRO', 'trim|required|xss_clean');

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_delivery_order->Insert_detail($data);
			}else { // edit
				$result=$this->mdl_delivery_order->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	function after($id_do)
	{

		$data['id_do']=$id_do;
		$list= $this->mdl_delivery_order->getdatadetail($id_do);
		echo'
			<table class="tbl" title="List Delivery Order">       
    <thead>
      <tr>
        <th width="20"></th>
        <th width="20">ID SRO</th>
        <th width="20">ID RO</th>
        <th width="20">ID DO</th>
        <th width="140">Create</th>
        <th width="100">Requestor</th>
        <th width="30">Aksi</th>        
      </tr>
    </thead>
    <tbody>';
        foreach ($list as $l) {
       		echo"
          <tr>
          <td align='center'><input type='checkbox' name='id_sro[]'  value='".$l->id_sro."'>
          <input type='hidden' name='id_do'  value='$id_do'></td>
          <td>".$l->id_sro."</td>
          <td>".$l->id_ro."</td>
          <td>$id_do</td>
          <td>".$l->date_create."</td>
          <td>".$l->full_name."</td>";
    echo '<td><a href="javascript:void(0)"  onclick="Detail_ro(id_ro);" plain="false">Detail</a></td>';
    echo "
          </tr> ";
         }
        echo"
    </tbody>
  </table>";
  
	}
	//autocomplete
	function selectId()
	{
		$data = $this->input->post('term');
		$query = $this->mdl_delivery_order->search($data);
		header ('Content-type:application/json');
		echo json_encode($query);
	}


	
	
}