<?php

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('mdl_notifikasi', 'notif');
	}

	public function add()
	{
		$post = $this->input->post();
		$data = array();
		foreach($post as $key => $dt)
		{
			$data[$key] = $dt;
		}
		$this->notif->addNotification($data);
	}

	public function listof()
	{
		$notifications = $this->notif->getAllNotifications();

		$data = array('tampilan' => '', 'jumlah' => '');

		if(!$notifications->num_rows() > 0) {

			$data['tampilan'] = "<div class='emptynotif' align='center'>Tidak ada notifikasi baru</div>";

		} else {

			$data['jumlah'] = '<span class="notif-counter pink" style="display: block">'.$notifications->num_rows().'</span>';

			foreach($notifications->result() as $notification) {
				$notification->type = intval($notification->type);
				$nottype = $notification->type === 1 ? 'alert' : '';
				$nottype = $notification->type === 2 ? 'warning' : $nottype;
		    	$data['tampilan'] .= "<a class='item ".$nottype."' href='javascript: void(0);' onclick=\"redirectTo('".$notification->url."')\">".$notification->context."</a>";
		    }

		}

		echo json_encode($data);
	}
}
