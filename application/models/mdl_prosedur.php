<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_prosedur extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }

  function OptionDepartement($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('ref_departement');
		$this->db->order_by('departement_name');
		//$this->db->where('status', 'A');
		
		# - otoritas
		if($this->session->userdata('departement_id')!=''){
			$this->db->where('departement_id', $this->session->userdata('departement_id'));
		}else{
			$out = '<option value="">-- Pilih --</option>';
		}
		#End 
		
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->departement_id) == trim($value)){
				$out .= '<option value="'.$r->departement_id.'" selected="selected">'.$r->departement_name.'</option>';
			}else{
				$out .= '<option value="'.$r->departement_id.'">'.$r->departement_name.'</option>';
			}
		}
		
		return $out;
	}

	function OptionKategori($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('ref_kategori');
		$this->db->order_by('nama_kategori');
		//$this->db->where('status', 'A');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_kategori) == trim($value)){
				$out .= '<option value="'.$r->id_kategori.'" selected="selected">'.$r->nama_kategori.'</option>';
			}else{
				$out .= '<option value="'.$r->id_kategori.'">'.$r->nama_kategori.'</option>';
			}
		}
		
		return $out;
	}

	function OptionSubKategori($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$id_kategori = isset($d['id_kategori'])?$d['id_kategori']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_sub_kategori');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->order_by('nama_sub_kategori');
		
		//$this->db->where('status', 'A');
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->id_sub_kategori) == trim($value)){
				$out .= '<option value="'.$r->id_sub_kategori.'" selected="selected">'.$r->nama_sub_kategori.'</option>';
			}else{
				$out .= '<option value="'.$r->id_sub_kategori.'">'.$r->nama_sub_kategori.'</option>';
			}
		}
		
		return $out;
	}
	
	function OptionOtoritas($d=""){
		$value = isset($d['value'])?$d['value']:'';
		
		$this->db->flush_cache();
		$this->db->from('sys_user_level');
		
		$this->db->order_by('level');
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->user_level_id) == trim($value)){
				$out .= '<option value="'.$r->user_level_id.'" selected="selected">'.$r->level_name.'</option>';
			}else{
				$out .= '<option value="'.$r->user_level_id.'">'.$r->level_name.'</option>';
			}
		}
		
		return $out;
	}

	function OptionMenuParent($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('sys_menu');
		$this->db->order_by('menu_name');
		$this->db->where('url', '#');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->menu_id) == trim($value)){
				$out .= '<option value="'.$r->menu_id.'" selected="selected">'.$r->menu_name.'</option>';
			}else{
				$out .= '<option value="'.$r->menu_id.'">'.$r->menu_name.'</option>';
			}
		}
		
		return $out;
	}

}

?>