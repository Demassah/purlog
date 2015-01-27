<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->load->model('mdl_mahasiswa');
		//$this->load->model('mdl_dosen');
		//$this->load->model('mdl_universitas');
		$this->load->model('mdl_notifikasi', 'notif');
	}
	
	public function index(){
		//$data['universitas'] = $this->mdl_universitas->getsingledata();
		//$this->load->view('main',$data);
		$data = array(
			'notifications' => $this->notif->getAllNotifications(),
		);
		$this->load->view('main', $data);
	}
	
	public function dashboard(){
		//$data['mhsCount'] =  $this->mdl_mahasiswa->getDataCount();
		//$data['mhsActCount'] =  $this->mdl_mahasiswa->getDataCount('ma');
		//$data['dsnCount'] =  $this->mdl_dosen->getDataCount();
		
		$data['lblDiagram'] = array("2009","2010","2011","2012","2013","2014","2015");
		//$data['dataDiagram'] = $this->mdl_mahasiswa->getDataChart($data['lblDiagram']);
		//$this->load->view('dashboard',$data);
		$this->load->view('dashboard');
	}
	
}