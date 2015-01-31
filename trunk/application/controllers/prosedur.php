<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class prosedur extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		
	}

	function getSubKategoribyKategori($id_kategori){
		echo $this->mdl_prosedur->OptionSubKategori(array('id_kategori'=>$id_kategori));
	}

	function getBarangbySubkat($id_sub_kategori){
		echo $this->mdl_prosedur->OptionBarang(array('id_sub_kategori'=>$id_sub_kategori));
	}

	
}

