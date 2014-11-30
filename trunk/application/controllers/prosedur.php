<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class prosedur extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		
	}

	function getSubKategoribyKategori($id_kategori){
		echo $this->mdl_prosedur->OptionSubKategori(array('id_kategori'=>$id_kategori));
	}
	
}

