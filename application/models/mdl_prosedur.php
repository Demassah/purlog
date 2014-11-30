<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_prosedur extends CI_Model {
    
	function __construct(){
        parent::__construct();
    }
	
	function OptionFakultas($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('ref_fakultas');
		$this->db->order_by('nama_fakultas');
		$this->db->where('status', 'A');
		
		# - otoritas
		if($this->session->userdata('kd_fakultas')!=''){
			$this->db->where('kd_fakultas', $this->session->userdata('kd_fakultas'));
		}else{
			$out = '<option value="">-- Pilih --</option>';
		}
		#End 
		
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->kd_fakultas) == trim($value)){
				$out .= '<option value="'.$r->kd_fakultas.'" selected="selected">'.$r->nama_fakultas.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_fakultas.'">'.$r->nama_fakultas.'</option>';
			}
		}
		
		return $out;
	}
	
	function OptionProdi($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$kd_fakultas = isset($d['kd_fakultas'])?$d['kd_fakultas']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_prodi');
		$this->db->order_by('nama_prodi');
		
		# - otoritas
		if($this->session->userdata('kd_fakultas')!=''){
			if($this->session->userdata('kd_prodi')!=''){
				$this->db->where('kd_fakultas', $this->session->userdata('kd_fakultas'));
				$this->db->where('kd_prodi', $this->session->userdata('kd_prodi'));
			}else{
				$this->db->where('kd_fakultas', $this->session->userdata('kd_fakultas'));
				$out = '<option value="">-- Pilih --</option>';
			}
		}else{
			$this->db->where('kd_fakultas', $kd_fakultas);
			$out = '<option value="">-- Pilih --</option>';
		}
		#End 
		
		$this->db->where('status', 'A');
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->kd_prodi) == trim($value)){
				$out .= '<option value="'.$r->kd_prodi.'" selected="selected">'.$r->nama_prodi.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_prodi.'">'.$r->nama_prodi.'</option>';
			}
		}
		
		return $out;
	}
	
	function OptionKurikulum($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$kd_prodi = isset($d['kd_prodi'])?$d['kd_prodi']:'';
		//$kd_fakultas = isset($d['kd_fakultas'])?$d['kd_fakultas']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_kurikulum');
		$this->db->order_by('nama_kurikulum');
		if($kd_prodi != ''){
			$this->db->where('kd_prodi', $kd_prodi);
		}
		$this->db->where('status', 'A');
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->kd_kurikulum) == trim($value)){
				$out .= '<option value="'.$r->kd_kurikulum.'" selected="selected">'.$r->nama_kurikulum.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_kurikulum.'">'.$r->nama_kurikulum.'</option>';
			}
		}
		
		return $out;
	}
	
	
	function OptionDosen($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$kd_prodi = isset($d['kd_prodi'])?$d['kd_prodi']:'';
		//$kd_fakultas = isset($d['kd_fakultas'])?$d['kd_fakultas']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_dosen');
		if($kd_prodi != ''){
			$this->db->where('kd_prodi', $kd_prodi);
		}
		$this->db->where('status', 'A');
		$this->db->order_by('nama_dosen');
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->kd_dosen) == trim($value)){
				$out .= '<option value="'.$r->kd_dosen.'" selected="selected">'.$r->nama_dosen.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_dosen.'">'.$r->nama_dosen.'</option>';
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
}

?>