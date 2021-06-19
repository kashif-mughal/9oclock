<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_bank_trans_log');
    }
    private $tableName = 'grocery_bank_trans_log';

    //order Search Item
    public function payment_list() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function save_bank_trans_log($data) {
        $this->db->insert($this->tableName, $data);
        $this->db->insert_id();
    }

    public function update_order_trans_status($data) {
        $status = $data['StatusCode']; $status++;
        $this->db->set('PaymentStatus', $status, FALSE);
        $this->db->where('OrderId', $data['OrderId']);
        $this->db->update('grocery_order');
        return true;
    }

}