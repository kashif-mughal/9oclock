<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cbrand extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('auth');
        $this->load->library('lbrand');
        $this->load->model('Brands');
    }

    //Default loading for brand system.
    public function index() {
        $content = $this->lbrand->brand_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage brand form
    public function manage_brand() {
        $content = $this->lbrand->brand_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert brand and upload
    public function insert_brand() {

        if ($_FILES['image']['name']) {

            //Chapter chapter add start

            $config['upload_path'] = './assets/img/brand/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cbrand'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/brand/" . $image['file_name'];

            }

        }

        $data = array(
            'BrandName' => $this->input->post('BrandName'),
            'Alias' => $this->input->post('Alias'),
            'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'Status' => 1,
            'Img' =>(!empty($image_url) ? $image_url : 'assets/img/brand.jpg')
        );

        $result = $this->Brands->brand_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Cbrand/manage_brand'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Cbrand'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Cbrand'));
        }
    }

    //brand Update Form
    public function brand_update_form($BrandId) {
        $content = $this->lbrand->brand_edit_data($BrandId);
        $this->template->full_admin_html_view($content);
    }

    // brand Update
    public function brand_update() {
        if ($_FILES['image']['name']) {

            $config['upload_path'] = './assets/img/brand/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cbrand'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/brand/" . $image['file_name'];
            }
        }
        $BrandId = $this->input->post('BrandId');
        $data = array(
            'BrandName' => $this->input->post('BrandName'),
            'Alias' => $this->input->post('Alias')
        );
        if($_FILES['image']['name'])
            $data['Img'] = (!empty($image_url) ? $image_url : 'assets/img/brand.jpg');

        $this->Brands->update($data, 'BrandId', $BrandId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cbrand/manage_brand'));
    }

    // brand delete
    public function brand_delete() {
        $BrandId = $_POST['BrandId'];
        $this->Brands->soft_delete_by_key('BrandId', $BrandId);
        return true;
    }

}
