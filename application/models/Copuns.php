<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Copuns extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_copun');
    }
    private $tableName = 'grocery_copun';
    
    //Count customer
    public function copun_entry($data) {
        $this->db->insert('grocery_copun', $data);
        return TRUE;
    }

    //Get Specific copun
    public function get_copun($copun){
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('CopunName', $copun);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
}
