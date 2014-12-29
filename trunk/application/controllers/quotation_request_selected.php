<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quotation_request_selected extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_quotation_request_selected');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		$this->load->view('quotation_request_selected/index');
	}

	function grid(){
		$data = $this->mdl_quotation_request_selected->getdata();
		echo $this->mdl_quotation_request_selected->togrid($data['row_data'], $data['row_count']);
	}

	function add_qrs($id_pr)
	{
		$data['id_pr'] = $id_pr;
		$data['list'] = $this->mdl_quotation_request_selected->list_pr($id_pr);

		$this->load->view('quotation_request_selected/add_qrs', $data, FALSE);
	}

	function update($id)
	{
		$data = $this->input->post('harga');
		$this->mdl_quotation_request_selected->update($id,$data);
		$this->load->view('quotation_request_selected/add_qrs', $data, FALSE);
	}

	function Selected($kode,$id_pr) {
    $result = $this->mdl_quotation_request_selected->selected($kode,$id_pr);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }	

  function Delete($kode) {
    $result = $this->mdl_quotation_request_selected->Delete($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }


  function Done($kode) {
    $result = $this->mdl_quotation_request_selected->done($kode);
    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => 'Data gagal dikirim'));
    }
  }

  function Add_vendor($id_pr)
  {
  	$data['id_pr'] = $id_pr;
  	$data['list'] = $this->mdl_quotation_request_selected->list_vendor();
  	$this->load->view('quotation_request_selected/form', $data);
  }

  function save_vendor($aksi){
		# init
		$status = "";
		$result = false;
		$data['pesan_error'] = '';
		
		# get post data
		foreach($_POST as $key => $value){
			$data[$key] = $value;
		}
		
		# rules validasi form
		$this->form_validation->set_rules("id_vendor", 'ID vendor', 'trim|required|xss_clean');
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');

		$data['pesan_error'] = '';
		if ($this->form_validation->run() == FALSE){
			$data["pesan_error"] .= trim(validation_errors(' ',' '))==''?'':validation_errors(' ',' ');
		}else{
			if($aksi=="add"){ // add
			//print_r($data);
			$result = $this->mdl_quotation_request_selected->Insert_vendor($data);
			}else { // edit
				$result=$this->mdl_quotation_request_selected->cancel($data);
			}
		}
		
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg' => 'Data gagal dikirim'));
		}
	}

	function after($id_pr)
	{
		$data['id_pr'] = $id_pr;
		$list= $this->mdl_quotation_request_selected->list_pr($id_pr);

		$supplier_id = '';
		$supplier_set = array();
		$top_set = array();
		$barang_set = array();
		$harga_set = array();
		$detail_qr = array();
		$index =0;
		$qr_set = array();

		echo '<br> <h2 align="center"> Compare Vendor List </h2> <br>';

		foreach ($list as $data) {

	    if ($data['id_vendor'] != $supplier_id) {
        array_push($supplier_set, $data['name_vendor']);
        array_push($top_set, $data['top']);
        array_push($qr_set,$data['id_qr']);
        array_push($detail_qr,$data['id_detail_qr']);
        //echo "<br>".$data['id_detail_qr'];
        $supplier_id = $data['id_vendor'];

        $index = 0;
			}

	    $harga_set[$data['nama_barang']][] = array($data['price'],$data['id_detail_qr']);
	    $barang_set[$index] = array("barang_nama" => $data['nama_barang'], "harga" => $harga_set[$data['nama_barang']]);
	    $index++;
		}

		$quotation = array("supplier_nama" => $supplier_set, "top" => $top_set, "data" => $barang_set, "Selected" => $qr_set);

		$header = TRUE;
		$counter = 0;
		$_crossfield = array('Vendor', 'TOP');
		$_colname = array(0 => "supplier_nama", 1 => "top");

		echo '<table class="tbl">';

		foreach ($_crossfield as $rows) {

		    echo '<tr>';
		    if (!$header) {
		        echo '<td>'.$rows.'</td>';
		        foreach ($quotation[$_colname[$counter]] as $cols) {
		            echo '<td>'.$cols.'</td>';
		        }
		    } else {
		        echo '<th>'.$rows.'</th>';
		        foreach ($quotation[$_colname[$counter]] as $cols) {
		            echo '<th>'.$cols.'</th>';
		        }
		    }

		    $header = FALSE;
		    $counter++;
		    echo '</tr>';
		}

		$data_counter = 0;

		foreach ($quotation['data'] as $details) {
		    echo '<tr>';
		    echo '<td>'.$quotation['data'][$data_counter]['barang_nama'].'</td>';

		    $harga_counter = 0;
		    foreach ($quotation['data'][$data_counter]['harga'] as $harga) {
		        echo '<td><div id="'.$quotation['data'][$data_counter]['harga'][$harga_counter][1].'" class="qrs">';
		          echo "<span id='harga_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."' class='text'>".$quotation['data'][$data_counter]['harga'][$harga_counter][0]."</span>";
		          echo "<input type='text' name='harga' value='".$quotation['data'][$data_counter]['harga'][$harga_counter][0]."' class='editbox' id='harga_input_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."'/>";
		        echo"</div></td>";
		        $harga_counter++;
		    }
		    echo '</tr>';
		    $data_counter++;
		}
		echo "<tr><td></td>";
		foreach ($quotation['Selected'] as $l) {
		  echo "<td><a href='#''  onclick='Selected(".$l.");'  plain='false'>Select</a>
		  <a href='#''  onclick='Delete(".$l.");'  plain='false'>Delete</a></td>";
		}
		echo "</tr>";

		echo '</table>';
	}

}

/* End of file quotation_request_selected.php */
/* Location: ./application/controllers/quotation_request_selected.php */