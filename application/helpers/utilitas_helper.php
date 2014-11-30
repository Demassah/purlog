<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('FormatDateToMysql')){
	function FormatDateToMysql($str){
		// if(strlen($str)==10 && substr($str,4,1)=='/' && substr($str,7,1)=='/'){
			$tm = explode('/', $str);
			return $tm[2].'-'.$tm[1].'-'.$tm[0];
		// }else{
			// return '0000-00-00';
		// }
	}
}

if(!function_exists('FormatDateFromMysql')){
	function FormatDateFromMysql($str){
		if(strlen($str)>=10 && substr($str,4,1)=='-' && substr($str,7,1)=='-'){
			$y = substr($str, 0, 4);
			$m = substr($str, 5, 2);
			$d = substr($str, 8, 2);
			//$tm = explode('-', $str);
			//return $tm[2].'/'.$tm[1].'/'.$tm[0];
			return $d.'/'.$m.'/'.$y;
		}
	}
}


# get
// if ( ! function_exists('get_level'))
// {
	// function get_level()
	// {
		// $CI =& get_instance();
		// $CI->load->model('authentikasi');
		// return $CI->authentikasi->get_level();
	// }
// }

# Cek login
// if ( ! function_exists('is_login'))
// {
	// function is_login()
	// {
		// return get_instance()->session->userdata('login')?TRUE:FALSE;
	// }
// }

