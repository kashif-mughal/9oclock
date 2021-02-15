<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Values extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_value');
    }
    private $tableName = 'grocery_value';
    
    public function search_last_value($key, $value) {
        $this->db->select("ga.ValueId, gps.UnitName SaleUnitName, gp.SaleUnitQty, gp.ProductId, gp.ProductName, gp.tags, gp.Price, gp.SalePrice, gp.ProductImg, gb.BrandName, concat(gp.SaleUnitQty, gps.UnitName) SaleUnitQuantity, gc.CatName, gc2.CatName parentCategory, CASE WHEN gu.UnitName = NULL THEN 'Piece' ELSE gu.UnitName END AS UnitName ");
        $this->db->from($this->tableName." ga");
        $this->db->join("grocery_products gp", "gp.ProductId = ga.ProductId");
        $this->db->join("grocery_category gc", "gp.Category = gc.CategoryId", "left");
        $this->db->join("grocery_category gc2", "gc.ParentId = gc2.CategoryId", "left");
        $this->db->join("grocery_unit gu", "gu.UnitId = gp.Unit", "left");
        $this->db->join("grocery_unit gps", "gps.UnitId = gp.SaleUnit", "left");
        $this->db->join("grocery_brand gb", "gb.BrandId = gp.Brand", "left");
        $this->db->where('ga.'.$key, $value);
        $this->db->where('ga.Status', 1);
        $this->db->where('gp.Status', 1);
        $this->db->where('gc.Status', 1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function value_entry($data) {
        $this->db->insert($this->tableName, $data);
        return TRUE;
    }


}
