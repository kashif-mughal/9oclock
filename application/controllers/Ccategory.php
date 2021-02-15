<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ccategory extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('lcategory');
        $this->load->model('Categories');
    }

    //Default loading for Category system.
    public function index() {
        $this->auth->check_admin_auth();
        $content = $this->lcategory->category_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage category form
    public function manage_category() {
        $this->auth->check_admin_auth();
        $content = $this->lcategory->category_list();
        $this->template->full_admin_html_view($content);
        
    }
    //Insert category and upload
    public function insert_category() {

        if ($_FILES['image']['name']) {

            //Chapter chapter add start

            $config['upload_path'] = './assets/img/category/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Ccategory'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/category/" . $image['file_name'];

            }

        }
        $data = array(
            'CatName' => $this->input->post('CatName'),
            'Alias' => $this->input->post('Alias'),
            'ParentId' => $this->input->post('ParentId'),
            'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'Status' => 1,
            'Img' =>(!empty($image_url) ? $image_url : 'assets/img/product.png'),
            'sort' => ($this->Categories->get_last_sort_number()) + 1
        );

        $result = $this->Categories->category_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Ccategory/manage_category'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Ccategory'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Ccategory'));

        }
    }

    //Category Update Form
    public function category_update_form($category_id) {
        $content = $this->lcategory->category_edit_data($category_id);
        $this->template->full_admin_html_view($content);
    }

    // Category Update
    public function category_update() {
        if ($_FILES['image']['name']) {

            $config['upload_path'] = './assets/img/category/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Ccategory'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/category/" . $image['file_name'];
            }
        }
        $CategoryId = $this->input->post('CategoryId');
        $data = array(
            'CatName' => $this->input->post('CatName'),
            'Alias' => $this->input->post('Alias'),
            'ParentId' => $this->input->post('ParentId'),
            'sort' => $this->input->post('sort')
        );
        if($_FILES['image']['name'])
            $data['Img'] = (!empty($image_url) ? $image_url : 'assets/img/category.jpg');
        $this->Categories->update($data, 'CategoryId', $CategoryId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Ccategory/manage_category'));
    }

    // Category delete
    public function category_delete() {
        $category_id = $_POST['CategoryId'];
        $this->Categories->soft_delete_by_key("CategoryId", $category_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

    public function update_category_order(){
        $catData = json_decode($this->input->post("catData"));
        if(empty($catData)){
            echo false;
            return;
        }
        if($this->Categories->update_category_sort_order($catData) == true){
            echo true;
            return;
        }
        else{
            echo false;
            return;
        }
    }
    public function child_cats(){
        $catId = $this->input->get("catId");
        print_r(json_encode($this->Categories->get_child_categories($catId)));
        return;
    }
}
