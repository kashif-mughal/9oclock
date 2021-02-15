<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_order');
    }

    // Global Variables
    private $tableName = 'grocery_order_detail';

    public function daily_report() {

    	// Daily Report by Product
    	$query = $this->db->query("Select god.ItemId, gp.ProductName, god.ItemQuantity*god.SoldPrice As total_price From grocery_order_detail god 
									join grocery_products gp on god.ItemId = gp.ProductId
									Where DATE(god.CreatedOn) = '2020-08-05' Group By ItemId");

		if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function profit_margin_form() {

        // Daily Report by Product
        $query = $this->db->query("Select god.ItemId, gp.ProductName, god.ItemQuantity*god.SoldPrice As total_price From grocery_order_detail god 
                                    join grocery_products gp on god.ItemId = gp.ProductId
                                    Where DATE(god.CreatedOn) = '2020-08-05' Group By ItemId");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function daily_report2($type, $start, $end) {

    	// Daily Report by Orders
    	if($type == 'Orders') {
    		$query = $this->db->query("Select OrderId, u.phone, u.email,u.address, CustomerId, OrderValue From grocery_order join users u on u.user_id = grocery_order.CustomerId Where grocery_order.Status = 1 AND u.Status = 1 AND DATE(CreatedOn) BETWEEN '". $start . "' AND '" . $end . "'");
    	}
    	else { // By Products
    		$query = $this->db->query("Select god.ItemId, gp.ProductName, god.ItemQuantity*god.SoldPrice As total_price From grocery_order_detail god join grocery_products gp on god.ItemId = gp.ProductId Where god.Status = 1 AND gp.Status = 1 AND DATE(god.CreatedOn) BETWEEN '". $start . "' AND '" . $end . "' Group By god.ItemId");
    	}
    	// Response
		if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function profit_margin_report($type, $start, $end) {

        // Daily Report by Orders
        if($type == 'Orders') {
            $query = $this->db->query("Select OrderId, u.phone, u.email, CustomerId, OrderValue From grocery_order join users u on u.user_id = grocery_order.CustomerId Where grocery_order.Status = 1 AND u.Status = 1 AND DATE(CreatedOn) BETWEEN '". $start . "' AND '" . $end . "'");
        }
        else { // By Products
            $query = $this->db->query("select god.ItemId, gp.ProductName, gp.OriginalPrice, god.SoldPrice, SUM(god.ItemQuantity) as total_sold_quantity, sum(god.ItemQuantity*gp.OriginalPrice) as total_purchase_amount, sum(god.ItemQuantity*god.SoldPrice) as total_sale_amount from grocery_order_detail god JOIN grocery_products gp 
                on gp.ProductId = god.ItemId where god.Status = 1 and gp.Status = 1 AND DATE(god.CreatedOn) BETWEEN '". $start . "' AND '" . $end . "' Group By god.ItemId");
        }
        // Response
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


}