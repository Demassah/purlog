<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class picking_req_order_selected extends CI_Controller {
       
        function __construct(){
                parent::__construct();
        $this->load->model('mdl_picking');
                $this->load->model('mdl_stock');
                // $this->output->enable_profiler(TRUE);
        }
       
        function index(){
                $this->load->view('picking_req_order_selected/picking');
        }
       
        function grid(){
                $data = $this->mdl_picking->getdata();
                echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
        }

        function doneData($kode) {
			$result = $this->mdl_picking->done($kode);
			if ($result) {
				echo json_encode(array('success' => true));
			} else {
				echo json_encode(array('msg' => 'Data gagal dikirim'));
			}
		}

/* ------------------------ Index --------------------------------------------- */

        function detail($id){
                $data['id_ro'] = $id;
                $this->load->view('picking_req_order_selected/detail_picking', $data);
        }

        function grid_detail($id){
                $data = $this->mdl_picking->getdata_detail($id);
                echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
        }

        function alocateData($kode) {
        $result = $this->mdl_picking->alocate($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Stock Barang Kosong'));
        }
    }

    function alocateAll($kode) {
        $result = $this->mdl_picking->alocateAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => ' Terdapat Stock Barang yang Kosong'));
        }
    }

/* ------------------------ Detail --------------------------------------------- */

        function available($id){
                $data['id_ro'] = $id;
                $this->load->view('picking_req_order_selected/available', $data);
        }

        function grid_available($id){
                $data = $this->mdl_picking->getdata_available($id);
                echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
        }

        function realocateData($kode) {
        $result = $this->mdl_picking->realocateData($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal direlokasi'));
        }
    }

    function realocateAll($kode) {
        $result = $this->mdl_picking->realocateAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal direlokasi'));
        }
    }

   function lockSRO($kode) {
        $result = $this->mdl_picking->lockSRO($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dikunci'));
        }
    }

/* ------------------------ Available (picking) --------------------------------------------- */


        function lock($id){
                $data['id_ro'] = $id;
                $this->load->view('picking_req_order_selected/lock', $data);
        }

        function lockAll($kode) {
        $result = $this->mdl_picking->lockAll($kode);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Data gagal dikunci'));
        }
    }

        function grid_lock($id){
                $data = $this->mdl_picking->getdata_lock($id);
                echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
        }

    function grid_input(){
        $data = $this->mdl_picking->getdata_input();
        echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
    }


    function save(){
        # get post data
        $ids = array();
        foreach($_POST as $key => $value){
            $data[$key] = $value;
        }

        foreach($data['data_stock']['rows'] as $dt){
            $ids[] = $dt['id_detail_pros'];
        }

        if(sizeof($ids) > 0) {
            $prevData = $this->mdl_picking->getProsDetailIds($ids)->result();
        }

        # init
        $status = "";
        $data['pesan_error'] = 'Data gagal di realokasi';
       
        $error = false;
        $result = false;

        foreach($data['data_stock']['rows'] as $new) {
            $prev = $this->mdl_picking->getProsDetail($new['id_detail_pros'])->row();
            if($prev->qty < $new['qty'] || $new['qty'] < 0) {
                $error = true;
            }
        }
        if(!$error) {
            $result = $this->mdl_picking->update_stock($data);
        }
       
        if($result){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>$data['pesan_error']));
        }
    }

/* ------------------------ Lock --------------------------------------------- */

        function pending($id){
                $data['id_ro'] = $id;
                $this->load->view('picking_req_order_selected/pending', $data);
        }

        function grid_pending($id){
                $data = $this->mdl_picking->getdata_pending($id);
                echo $this->mdl_picking->togrid($data['row_data'], $data['row_count']);
        }

        function purchase(){
                $this->load->view('purchase_request/purchase_request');
        }

    /* ------------------------ Lain lain --------------------------------------------- */

        function laporan_pdf() {
            $this->load->library('HTML2PDF');
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            
            //filter
            //get filter
            //$fil['kd_prodi'] = $kd_prodi;
            
            //$data['nama'] = '';
            //$data['namaUniv'] = 'STMIK BANDUNG';
            //$data['alamatUniv'] = 'Jl.Phh.Mustofa No. 39. Grand Surapati Core (SUCORE) Blok M No.19, Telp.022 - 7207777';
            //$data['kotaUniv'] = 'Bandung, Jawa Barat';
            
            // ambil data dari tabel
            $data['data_pdf'] = $this->mdl_picking->get_pdf();
            
            /* if (count($da['row'])==0){
            echo "Data Tidak Tersedia";
            return;
            } */
            
            $konten = $this->load->view('picking_req_order_selected/picklist_laporan', $data, true);
            
            $html2pdf->writeHTML($konten, false);
            
            $html2pdf->Output('picklist.pdf');
        }

}
