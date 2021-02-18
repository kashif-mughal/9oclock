<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Model {

    public function __construct() {
        parent::__construct('banner_images');
    }
    private $tableName = 'banner_images';

    public function get_banners() {
       $this->db->select('*');
       $this->db->from($this->tableName);
       $this->db->where('status', '1');
       $this->db->order_by('image_order', 'ASC');
       $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function delete_image($image_id) {
        $this->db->where('id', $image_id);
        $this->db->delete($this->tableName);
        return true;
     }

    public function insert_image($data) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('status', '1');
        $this->db->where('image_path', $data['image_path']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert($this->tableName, $data);
            return TRUE;
        }
    }

    public function update_image_orders($data) {
        foreach ($data as $key => $value) {
            $this->db->set('image_order', $value->image_order, FALSE);
            $this->db->where('id', $value->image_id);
            $this->db->update($this->tableName);
        }
        return true;
    }

    public function get_last_image_order() {

        $this->db->select_max('image_order');
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 1;
    }

    public function get_image($image_path) {
        $result = $this->db->like('image_path',$image_path)->get($this->tableName);
        if ($result->num_rows() > 0) {
            return 1;
        }
        return 0;
    }

    public function update_status($image_id, $status) {
        $this->db->set('status', $status, FALSE);
        $this->db->where('id', $image_id);
        $this->db->update($this->tableName);
    }

}