<?php

/**
 * 
 * @author oedin peureuz <h2r_oedin@yahoo.com>
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sample extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sample_quotation');
    }
    
    public function index()
    {
        $data = array();
        $data['dataset'] = $this->Sample_quotation->get_quotation();
        $this->load->view('quotation_request_selected/list', $data);
    }
        
}

/* End of file bispar.php */
/* Location: ./application/controllers/sample.php */
