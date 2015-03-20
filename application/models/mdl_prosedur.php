<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_prosedur extends CI_Model {
    
	function __construct(){
        parent::__construct();
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

 	function OptionDepartement($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('ref_departement');
		$this->db->order_by('departement_name');
		//$this->db->where('status', 'A');
		
		# - otoritas
		if($this->session->userdata('departement_id')!='0'){
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

	function OptionDepartement_NoSession($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '<option value="">-- Pilih --</option>';
		
		$this->db->flush_cache();
		$this->db->from('ref_departement');
		$this->db->order_by('departement_name');
		//$this->db->where('status', 'A');

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

	function OptionUserID($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('sys_user');
		$this->db->order_by('full_name');
		//$this->db->where('status', 'A');
		
		# - otoritas
		if($this->session->userdata('user_id')!=''){
			$this->db->where('user_id', $this->session->userdata('user_id'));
		}else{
			$out = '<option value="">- Pilih -</option>';
		}
		#End 
		
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->user_id) == trim($value)){
				$out .= '<option value="'.$r->user_id.'" selected="selected">'.$r->full_name.'</option>';
			}else{
				$out .= '<option value="'.$r->user_id.'">'.$r->full_name.'</option>';
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

	function OptionKategori($d=""){
		$value = isset($d['value'])?$d['value']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_kategori');
		$this->db->order_by('nama_kategori');
		//$this->db->where('status', 'A');
				
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
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

	function OptionBarang($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$id_sub_kategori = isset($d['id_sub_kategori'])?$d['id_sub_kategori']:'';
		
		$this->db->flush_cache();
		$this->db->select('*, ref_satuan.nama_satuan');
		$this->db->from('ref_barang');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = ref_barang.id_satuan');
		$this->db->where('id_sub_kategori', $id_sub_kategori);
		$this->db->order_by('kode_barang');

		//$this->db->where('status', 'A');
		$res = $this->db->get();
		
		$out = '';
		foreach($res->result() as $r){
			if(trim($r->kode_barang) == trim($value)){
				$out .= '<option value="'.$r->kode_barang.'" selected="selected">'.$r->kode_barang.' - '.$r->nama_barang.' - '.$r->nama_satuan.'</option>';
			}else{
				$out .= '<option value="'.$r->kode_barang.'">'.$r->kode_barang.' - '.$r->nama_barang.' - '.$r->nama_satuan.'</option>';
			}
		}
		
		return $out;
	}

	function OptionRO($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_ro');
		$this->db->order_by('id_ro');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_ro) == trim($value)){
				$out .= '<option value="'.$r->id_ro.'" selected="selected">'.$r->id_ro.' </option>';
			}else{
				$out .= '<option value="'.$r->id_ro.'">'.$r->id_ro.'</option>';
			}
		}
		
		return $out;
	}

	function OptionRO_Purchase($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_pr_detail');
		$this->db->where('id_pr','0');
		$this->db->group_by('id_ro');
		$this->db->order_by('id_ro');
				
		$res = $this->db->get();
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->id_ro) == trim($value)){
				$out .= '<option value="'.$r->id_ro.'" selected="selected">'.$r->id_ro.' </option>';
			}else{
				$out .= '<option value="'.$r->id_ro.'">'.$r->id_ro.'</option>';
			}
		}
		
		return $out;
	}

	function OptionRO_DetailPR($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_pr_detail');
		$this->db->where('id_pr','0');
		$this->db->where('status','1');
		$this->db->group_by('id_ro');
		$this->db->order_by('id_ro');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_ro) == trim($value)){
				$out .= '<option value="'.$r->id_ro.'" selected="selected">'.$r->id_ro.' </option>';
			}else{
				$out .= '<option value="'.$r->id_ro.'">'.$r->id_ro.'</option>';
			}
		}
		
		return $out;
	}

	

	function OptionCourir($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '<option value="">-- Pilih --</option>';
		
		$this->db->flush_cache();
		$this->db->from('ref_courir');
		$this->db->order_by('name_courir');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_courir) == trim($value)){
				$out .= '<option value="'.$r->id_courir.'" selected="selected">'.$r->name_courir.'</option>';
			}else{
				$out .= '<option value="'.$r->id_courir.'">'.$r->name_courir.'</option>';
			}
		}
		
		return $out;
	}

	function OptionVendor($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('ref_vendor');
		$this->db->order_by('name_vendor');
				
		$res = $this->db->get();
		
		foreach($res->result() as $l){
			if(trim($l->id_vendor) == trim($value)){
				$out .= '<option value="'.$l->id_vendor.'" selected="selected">'.$l->name_vendor.'</option>';
			}else{
				$out .= '<option value="'.$l->id_vendor.'">'.$l->name_vendor.'</option>';
			}
		}
		
		return $out;
	}

	function OptionPurchaseOrder($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_qrs');
		$this->db->where('status', 2);
		$this->db->where('id_po', Null);
		$this->db->order_by('id_qrs');
				
		$res = $this->db->get();
		
		foreach($res->result() as $l){
			if(trim($l->id_pr) == trim($value)){
				$out .= '<option value="'.$l->id_qrs.'" selected="selected"> ID PR :'.$l->id_pr.' ID QRS :'.$l->id_qrs.'</option>';
			}else{
				$out .= '<option value="'.$l->id_qrs.'"> ID PR :'.$l->id_pr.' ID QRS :'.$l->id_qrs.'</option>';
			}
		}
		
		return $out;
	}

	function OptionSRO_DR($d=""){
            $value = isset($d['value'])?$d['value']:'';
            $out = '';
           
            $this->db->flush_cache();
            $this->db->select('a.id_sro,a.status_receive,b.id_do,c.status');
            $this->db->from('tr_pros_detail a');
            $this->db->join('tr_sro b', 'b.id_sro = a.id_sro', 'left');
            $this->db->join('tr_do c', 'c.id_do = b.id_do', 'left');
            $this->db->where('a.id_sro !=','0');
            $this->db->where('a.status_receive','0');
            $this->db->where('c.status ', 2 );
            $this->db->group_by('a.id_sro');
            $this->db->order_by('a.id_sro');
                           
            $res = $this->db->get();
           
            foreach($res->result() as $r){
                    if(trim($r->id_sro) == trim($value)){
                            $out .= '<option value="'.$r->id_sro.'" selected="selected">'.$r->id_sro.' </option>';
                    }else{
                            $out .= '<option value="'.$r->id_sro.'">'.$r->id_sro.'</option>';
                    }
            }
           
            return $out;
    }


	function OptionSRO_add_DetailDR($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_receive');
		$this->db->group_by('id_sro');
		$this->db->order_by('id_sro');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_sro) == trim($value)){
				$out .= '<option value="'.$r->id_sro.'" selected="selected">'.$r->id_sro.' </option>';
			}else{
				$out .= '<option value="'.$r->id_sro.'">'.$r->id_sro.'</option>';
			}
		}
		
		return $out;
	}


	function Option_add_receive($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_return_detail');
		$this->db->where('id_return', '0');
		$this->db->group_by('id_receive');
		$this->db->order_by('id_receive');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_receive) == trim($value)){
				$out .= '<option value="'.$r->id_receive.'" selected="selected">'.$r->id_receive.' </option>';
			}else{
				$out .= '<option value="'.$r->id_receive.'">'.$r->id_receive.'</option>';
			}
		}
		
		return $out;
	}

	function OptionReceive_DetailReturn($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '';
		
		$this->db->flush_cache();
		$this->db->from('tr_return_detail');
		$this->db->where('id_return','0');
		$this->db->where('status','1');
		$this->db->group_by('id_receive');
		$this->db->order_by('id_receive');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_receive) == trim($value)){
				$out .= '<option value="'.$r->id_receive.'" selected="selected">'.$r->id_receive.' </option>';
			}else{
				$out .= '<option value="'.$r->id_receive.'">'.$r->id_receive.'</option>';
			}
		}
		
		return $out;
	}

	

	function OptionStock($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '<option value="">-- Pilih --</option>';
		
		$this->db->flush_cache();
		$this->db->from('tr_stock');

		$this->db->order_by('id_stock');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_stock) == trim($value)){
				$out .= '<option value="'.$r->id_stock.'" selected="selected">'.$r->id_stock.' </option>';
			}else{
				$out .= '<option value="'.$r->id_stock.'">'.$r->id_stock.'</option>';
			}
		}
		
		return $out;
	}

	function OptionLokasi($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '<option value="">-- Pilih --</option>';
		
		$this->db->flush_cache();
		$this->db->from('ref_lokasi');

		$this->db->order_by('id_lokasi');
		$this->db->group_by('id_lokasi');
				
		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->id_lokasi) == trim($value)){
				$out .= '<option value="'.$r->id_lokasi.'" selected="selected">'.$r->id_lokasi.' </option>';
			}else{
				$out .= '<option value="'.$r->id_lokasi.'">'.$r->id_lokasi.'</option>';
			}
		}
		
		return $out;
	}

	function OptionBarangs($d=""){
		$value = isset($d['value'])?$d['value']:'';
		$out = '<option value="">-- Pilih --</option>';
		
		$this->db->flush_cache();
		$this->db->from('ref_barang');
		$this->db->order_by('kode_barang');
		//$this->db->where('status', 'A');

		$res = $this->db->get();
		
		foreach($res->result() as $r){
			if(trim($r->kode_barang) == trim($value)){
				$out .= '<option value="'.$r->kode_barang.'" selected="selected">'.$r->kode_barang.' - '.$r->nama_barang.'</option>';
			}else{
				$out .= '<option value="'.$r->kode_barang.'">'.$r->kode_barang.' - '.$r->nama_barang.'</option>';
			}
		}
		
		return $out;
	}

	function OptionSatuan($d=""){
		$value = isset($d['value'])?$d['value']:'';
		
		$this->db->flush_cache();
		$this->db->from('ref_satuan');
		$this->db->order_by('nama_satuan');
		//$this->db->where('status', 'A');
				
		$res = $this->db->get();
		
		$out = '<option value="">-- Pilih --</option>';
		foreach($res->result() as $r){
			if(trim($r->id_satuan) == trim($value)){
				$out .= '<option value="'.$r->id_satuan.'" selected="selected">'.$r->nama_satuan.'</option>';
			}else{
				$out .= '<option value="'.$r->id_satuan.'">'.$r->nama_satuan.'</option>';
			}
		}
		
		return $out;
	}

	function OptionQrs($d="")
	{
		$value = isset($d['value'])?$d['value']:'';

		$this->db->flush_cache();
		$this->db->from('v_qrs_detail');
		$this->db->where('sisa !=', 0);
		$this->db->order_by('id_pr', 'asc');
		$this->db->group_by('id_pr');

		$res = $this->db->get();

		$out = '<option value="">-- Pilih --</option>';
		foreach ($res->result() as $r) {
			if(trim($r->id_pr)==trim($value)){
				$out .= '<option value="'.$r->id_pr.'" selected="selected">'.$r->id_pr.'</option>';
			}else{
				$out .= '<option value="'.$r->id_pr.'">'.$r->id_pr.'</option>';
			}
		}
		return $out;
	}

}

?>