<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Autocomplete extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Products');
        }
        public function index(){
            $this->load->view('header');
        }
        public function userdata(){
            $postData = $this->input->post();
            $data = $this->Products->getUsers($postData);
            echo json_encode($data);
        }
    }
?>