<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_stock extends CI_Model {

    var $tbl = 'tr_stock';

    /**
     * Get current stock
     * @param  string/int $field    Field name or id_stock
     * @param  int $id              $field id
     * @return int/false            Integer or false if no data found
     */
    public function getStock($field, $id = null)
    {
        if($id == null)
        {
            $id = $field;
            $field = 'id_stock';
        }

        $this->db->where($field, $id);
        $this->db->where ('qty !=', '0');
        return $this->db->get($this->tbl);
    }

    /**
     * Update stock
     * @param  [type] $idStock      id_stock
     * @param  [type] $newQty       new Qty to be assigned
     * @return Object/false         Stock Object or false if update unsuccessful
     */
    public function updateStock($idStock, $newQty)
    {
        $this->db->set('qty', $newQty);
        $this->db->where('id_stock', $idStock);
        if($this->db->update($this->tbl)) {
            return $this->getStock($idStock);
        }
        return false;
    }

    function getdata($plimit=true){
        # get parameter from easy grid
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
        $limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_stock';  
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
        $offset = ($page-1)*$limit;

        #get filter
        $kode_barang = isset($_POST['kode_barang']) ? strval($_POST['kode_barang']) : '';
        
        # create query
        $this->db->flush_cache();
        $this->db->start_cache();
        $this->db->select('a.id_stock, a.kode_barang, a.qty, a.price, a.id_lokasi, a.date_create, a.status, b.nama_barang');
        $this->db->from('tr_stock a');
        $this->db->join('ref_barang b', 'b.kode_barang = a.kode_barang');
        
        #Filter
        if($kode_barang != ''){
            $this->db->where('a.kode_barang', $kode_barang);
        }

        $this->db->where('a.status','1');
        $this->db->order_by($sort, $order);
        $this->db->stop_cache();
        
        # get count
        $tmp['row_count'] = $this->db->get()->num_rows();
        
        # get data
        if($plimit == true){
            $this->db->limit($limit, $offset);
        }
        $tmp['row_data'] = $this->db->get();
        return $tmp;
    }

    function togrid($data, $count){
        $response->total = $count;
        $response->rows = array();
        if($count>0){
            $i=0;
            foreach($data->result_array() as $row){
                foreach($row as $key => $value){
                    $response->rows[$i][$key]=$value;
                }
                $i++;
            }
        }
        return json_encode($response);
    }

}
