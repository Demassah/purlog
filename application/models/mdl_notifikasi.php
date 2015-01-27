<?php

class mdl_notifikasi extends CI_Model {

	protected $table = 'tr_notifikasi';

	public function getAllNotifications()
	{
		$this->db->order_by('tanggal', 'desc');
		return $this->get();
	}

	public function addNotification($data = array())
	{
		foreach($data as $key => $val) {
			$this->db->set($key, $val);
		}

		$this->db->insert($this->table);
	}

	public function removeNotification($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
	}

	public function getNotification($id)
	{
		$this->db->where('id', $id);
		return $this->get();
	}

	private function get()
	{
		return $this->db->get($this->table);
	}
}
