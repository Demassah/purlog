<?php

/**
 * 
 * @author oedin peureuz <h2r_oedin@yahoo.com>
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample_quotation extends CI_Model {
    var $db_sample; 


    public function __construct()
    {
        parent::__construct();
        $this->db_sample = $this->load->database('sample', TRUE);
    }
    
    public function get_quotation()
    {
        $data = array();
        
        $this->db_sample->select('GROUP_CONCAT(qtn.quote_id) quote_id, GROUP_CONCAT(qtn.top) top, 
            GROUP_CONCAT(qtn.price) price, brg.barang_nama, GROUP_CONCAT(spl.supplier_nama) supplier_nama', FALSE);
        $this->db_sample->from('cpgt_quotation qtn');
        $this->db_sample->join('cpgt_barang brg', 'brg.barang_id = qtn.barang_id');
        $this->db_sample->join('cpgt_supplier spl', 'spl.supplier_id = qtn.supplier_id');
        $this->db_sample->where('brg.barang_id = 1');
        $this->db_sample->group_by('brg.barang_id');
        
        $q = $this->db_sample->get();
                
        if($q->num_rows() > 0){
            foreach($q->result_array() as $row){
                $data[] = $row;
            }
        }
        
        $q->free_result();
        return $data;
    }
}

/* End of file bispar_user.php */
/* Location: ./application/models/sample_quotation.php */
