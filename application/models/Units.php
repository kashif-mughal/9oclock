<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Units extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_unit');
    }
    private $tableName = 'grocery_unit';
    
    //unit Search Item
    public function unit_search_item($UnitId) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('UnitId', $UnitId);
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function unit_entry($data) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->where('UnitName', $data['UnitName']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('grocery_unit', $data);
            return TRUE;
        }
    }


}
