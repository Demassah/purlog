<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_courir extends CI_Model {

	public function v_courir()
	{
		$this->db->select('id_courir,name_courir,status');
		$this->db->where('status', 1);
		$this->db->order_by('name_courir', 'desc');
		$query = $this->db->get('ref_courir');
		return $query->result();
	}

}

/* End of file mdl_courir.php */
/* Location: ./application/models/mdl_courir.php */