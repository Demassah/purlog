<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class prosedur extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}
	
	function index(){
		
	}
	
	function getProdibyFakultas($kd_fakultas){
		echo $this->mdl_prosedur->OptionProdi(array('kd_fakultas'=>$kd_fakultas));
	}
	
	function getIdFakultasByProdi($kd_prodi){
		echo $this->mdl_prosedur->getFakProdi($kd_prodi)->kd_fakultas;
	}
	
	function getKurikulumbyProdi($kd_prodi){
		echo $this->mdl_prosedur->OptionKurikulum(array('kd_prodi'=>$kd_prodi));
	}
	
	function getMahasiswa($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswa(array('kd_prodi'=>$kd_prodi));
	}
	
	function getDosenbyProdi($kd_prodi){
		if($this->session->userdata('user_level_id') == 10):
			$kd_dosen = $this->session->userdata('kd_dosen');
			echo $this->mdl_prosedur->OptionDosen(array('kd_prodi'=>$kd_prodi, 'value' => $kd_dosen));
		else:
			echo $this->mdl_prosedur->OptionDosen(array('kd_prodi'=>$kd_prodi));
		endif;
	}
	
	function getFakultasbyUniversitas($kd_pt=""){
		echo $this->mdl_prosedur->OptionFakultasByUniversitas(array('kd_pt'=>$kd_pt));
	}
	
	function getProgrambyUniversitas($kd_pt){
		echo $this->mdl_prosedur->OptionProgramByUniversitas(array('kd_pt'=>$kd_pt));
	}
	
	function getMatakuliah($kd_kurikulum=""){
		echo $this->mdl_prosedur->OptionMatakuliah(array('kd_kurikulum'=>$kd_kurikulum));
	}
	
	function getMatakuliahByThn($kd_tahun="", $kd_prodi=""){
		echo $this->mdl_prosedur->OptionMatakuliahByThn(array('kd_tahun_ajaran'=>$kd_tahun,'kd_prodi'=>$kd_prodi));
	}
	
	function getMahasiswa2($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswa2(array('kd_prodi'=>$kd_prodi));
	}
	//untuk table ta
	function getDosenbyProdiTa($kd_prodi){
		echo $this->mdl_prosedur->OptionDosenTa(array('kd_prodi'=>$kd_prodi));
	}
	
	function getDosenbyProdiByMatkul($kd_matkul="", $kd_tahun=""){
		echo $this->mdl_prosedur->OptionDosenByMatkul(array('kd_tahun_ajaran'=>$kd_tahun,'kd_matkul'=>$kd_matkul));
	}

	//untuk nilai
	function getDosenbyProdiNilai($kd_matakuliah){
		echo $this->mdl_prosedur->OptionDosenNilai(array('kd_matakuliah'=>$kd_matakuliah));
	}
	
	//untuk kelas dari dosen
	function getKelasbyDosenNilai($kd_dosen){
		echo $this->mdl_prosedur->OptionKelasNilai(array('kd_dosen'=>$kd_dosen));
	}

	//list mahasiswa yg up = diterima
	function getMahasiswabyUp($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswabyUp(array('kd_prodi'=>$kd_prodi));
	}
	//list mahasiswa yg seminar = diterima
	function getMahasiswabySeminar($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswabySeminar(array('kd_prodi'=>$kd_prodi));
	}
	
	function getGedungbyKampus($kd_kampus){
		echo $this->mdl_prosedur->OptionGedung(array('kd_kampus'=>$kd_kampus));
	}
	//list mahasiswa mutasi
	function getMutasiMahasiswa($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMutasiMahasiswa(array('kd_prodi'=>$kd_prodi));
	}
	function getMahasiswabySeminar1($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswabySeminar1(array('kd_prodi'=>$kd_prodi));
	}
	function getMahasiswaAmbilTa($kd_prodi){
		echo $this->mdl_prosedur->OptionComboMahasiswaAmbilTa(array('kd_prodi'=>$kd_prodi));
	}
	
	//provinsi
	function OptionKabup($kd_prov){
		echo $this->mdl_prosedur->OptionKabup(array('kd_prov'=>$kd_prov));
	}
	
	function getDosenWalibyProdi($kd_prodi){
		echo $this->mdl_prosedur->OptionDosenWali(array('kd_prodi'=>$kd_prodi));
	}
	
	//tambahan iqbal
	function getKurikulumbyTahunajaran($id_tahunajaran = null, $kd_prodi = null){
		if($id_tahunajaran != null) {
			$data = $this->mdl_prosedur->KurikulumTahunajaran(
				array('id_tahunajaran'=>$id_tahunajaran, 'kd_prodi'=>$kd_prodi));
			echo $data->row()->kd_kurikulum;
		} else {
			echo -1;
		}
	}
	
	//tahun ajaran by prodi
	function getTahunajaranByProdi($kd_prodi){
		echo $this->mdl_prosedur->OptionTahunAjaranProdi(array('kd_prodi'=>$kd_prodi));
	}
	
	//kurikulum by TA
	function getKurikulumByTA($id_tahunajaran){
		echo $this->mdl_prosedur->OptionKurikulumTahunajaran(array('id_tahunajaran'=>$id_tahunajaran));
	}
}

