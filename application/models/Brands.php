<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brands extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_brand');
    }
    private $tableName = 'grocery_brand';
    
    //brand Search Item
    public function brand_search_item($BrandId) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('BrandId', $BrandId);
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function brand_entry($data) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->where('BrandName', $data['BrandName']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('grocery_brand', $data);
            return TRUE;
        }
    }

    // Get Top Brands
    public function top_brands() {
        $query = $this->db->query('SELECT b.BrandId, b.BrandName, COUNT(p.ProductId) As Total_Products FROM grocery_brand b 
            left JOIN grocery_products p ON b.BrandId = p.Brand WHERE b.Status = 1 GROUP BY b.BrandName 
            ORDER BY Total_Products DESC LIMIT 20');
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return false;
        }
    }


}
