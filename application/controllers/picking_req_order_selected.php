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

    // function darksideofthemoon()
    // {
    //     // $data = $this->mdl_picking->getProsDetailIds(array(31, 32))->result();

    //     $data = 'a:2:{i:0;a:22:{s:14:"id_detail_pros";s:2:"32";s:12:"id_detail_ro";s:1:"1";s:5:"id_ro";s:1:"1";s:6:"id_sro";s:1:"0";s:8:"id_stock";s:1:"2";s:11:"kode_barang";s:3:"003";s:3:"qty";s:2:"12";s:9:"id_lokasi";s:5:"A0201";s:6:"status";s:1:"1";s:7:"user_id";s:1:"1";s:7:"purpose";s:7:"REQUEST";s:7:"cat_req";s:5:"ASSET";s:10:"ext_doc_no";s:5:"12345";s:3:"ETD";s:10:"2014-12-15";s:11:"date_create";s:19:"2014-12-15 00:00:00";s:4:"note";s:6:"dfsdsf";s:13:"status_delete";s:1:"0";s:2:"id";s:1:"4";s:11:"id_kategori";s:1:"2";s:15:"id_sub_kategori";s:1:"2";s:11:"nama_barang";s:3:"CPU";s:5:"price";s:4:"1000";}i:1;a:22:{s:14:"id_detail_pros";s:2:"31";s:12:"id_detail_ro";s:1:"2";s:5:"id_ro";s:1:"1";s:6:"id_sro";s:1:"0";s:8:"id_stock";s:1:"5";s:11:"kode_barang";s:3:"005";s:3:"qty";s:2:"25";s:9:"id_lokasi";s:5:"A0101";s:6:"status";s:1:"1";s:7:"user_id";s:1:"1";s:7:"purpose";s:7:"REQUEST";s:7:"cat_req";s:5:"ASSET";s:10:"ext_doc_no";s:5:"12345";s:3:"ETD";s:10:"2014-12-15";s:11:"date_create";s:19:"2014-12-15 00:00:00";s:4:"note";s:6:"dsfdsf";s:13:"status_delete";s:1:"0";s:2:"id";s:1:"6";s:11:"id_kategori";s:1:"2";s:15:"id_sub_kategori";s:1:"2";s:11:"nama_barang";s:8:"Keyboard";s:5:"price";s:3:"500";}}';
    //     $data = unserialize($data);
    //     print_r($data);
    // }

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

    /* ------------------------ Pending --------------------------------------------- */
       
}
