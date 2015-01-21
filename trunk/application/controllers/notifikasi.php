<?php

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_notifikasi', 'notif');
	}

	public function redirect($id)
	{
		$notif = $this->notif->getNotification($id);
		redirect($notif->url);
	}
}
