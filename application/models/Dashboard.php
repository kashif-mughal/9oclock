<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_dashboard');
    }
    private $tableName = 'grocery_dashboard';
    public function get_dashboard_stats() {
        $q1 = $this->db->query('SELECT count(1) ActiveUsers FROM user_login where status = 1');
        $q2 = $this->db->query('SELECT count(1) CompleteOrders from grocery_order WHERE Status = 1 and OrderStep = 4');
        $q3 = $this->db->query('SELECT count(1) PendingOrders from grocery_order WHERE Status = 1 and OrderStep <> 4 AND OrderStep <> 7');
        $q4 = $this->db->query('SELECT SUM(OrderValue) SaleAmount from grocery_order WHERE Status = 1 and OrderStep = 4 and DeliveryDate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()');
        $q5 = $this->db->query('SELECT count(1) InActiveUsers FROM user_login WHERE status <> 1');
        $q6 = $this->db->query('SELECT (SELECT count(1) from grocery_products WHERE Status <> 1) InActive, (SELECT count(1) FROM grocery_products where Status = 1) Active, (SELECT count(1) FROM grocery_products) Total');
        $q7 = $this->db->query('SELECT count(1) TotalCategories FROM grocery_category where status = 1');
        $q8 = $this->db->query('SELECT SUM(OrderValue) value, MONTH(DeliveryDate) year from grocery_order WHERE DeliveryDate BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW() GROUP BY MONTH(DeliveryDate)');
        $q9 = $this->db->query('SELECT count(1) TotalBrands FROM grocery_brand where status = 1');
        $q10 = $this->db->query('SELECT count(1) Featured FROM grocery_products where status = 1 AND IsFeatured = 1');

        return array(
            'ActiveUsers' => $q1->result_array()[0]['ActiveUsers'],
            'CompleteOrders' => $q2->result_array()[0]['CompleteOrders'],
            'PendingOrders' => $q3->result_array()[0]['PendingOrders'],
            'SaleAmount' => $q4->result_array()[0]['SaleAmount'],
            'InActiveUsers' => $q5->result_array()[0]['InActiveUsers'],
            'TotalProducts' => $q6->result_array()[0]['Total'],
            'ActiveProducts' => $q6->result_array()[0]['Active'],
            'InActiveProducts' => $q6->result_array()[0]['InActive'],
            'TotalCategories' => $q7->result_array()[0]['TotalCategories'],
            'SaleByMonth' => json_encode($q8->result_object()),
            'TotalBrands' => $q9->result_array()[0]['TotalBrands'],
            'Featured' => $q10->result_array()[0]['Featured']
        );
    }

}
