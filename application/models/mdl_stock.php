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

}
