<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cvalue extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lvalue');
        $this->load->model('Values');
    }

    //Default loading for value system.
    public function index() {
        $content = $this->lvalue->value_add_form();
        $this->template->full_admin_html_view($content);
    }

    public function product_select(){
        $CI = & get_instance();
        $CI->load->model('Products');
        $q = $this->input->get('search');
        if(empty($q))
            return null;
        $products = $CI->Products->search($q, "grocery_value");

        if(!$products || count($products) == 0)
            return null;
        $productsToSend = Array();

        for ($i=0; $i < count($products); $i++) { 
            $productObject = (object) [
                    'id' => $products[$i]->ProductId,
                    'text' => "<div>".$products[$i]->ProductName."</div>",
                    'html' => "<div><img style='width:50px;border-radius:200px;' src='".base_url($products[$i]->ProductImg)."'><span style='margin: 0px 20px;'>".$products[$i]->ProductName."</span><span> In ".$products[$i]->CatName."</span><button class='btn btn-success' style='float:right;margin-top:10px;' onclick='triggerAdd(this);'>Add</button></div>",
                    'title' => $products[$i]->ProductName,
                    'jsonObj' => json_encode($products[$i])
                    ];
            array_push($productsToSend, $productObject);
        }
        echo json_encode($productsToSend);
        return;
    }

    //Manage value form
    public function manage_value() {
        $content = $this->lvalue->value_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert value and upload
    public function insert_value() {
        $productIds = $this->input->post('productId');
        $finalResult = true;
        for ($i=0; $i < count($productIds); $i++) { 
            $data = array(
                'ProductId' => $productIds[$i],
                'CreatedOn' => date_format(new DateTime(), 'Y-m-d'),
                'Status' => 1
            );

            $result = $this->Values->value_entry($data);
            if($finalResult)
                $finalResult = $result;
        }
        

        if ($finalResult == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-value'])) {
                redirect(base_url('Cvalue/manage_value'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Cvalue'));
        }
    }

    //value Update Form
    public function value_update_form($valueId) {
        $content = $this->lvalue->value_edit_data($valueId);
        $this->template->full_admin_html_view($content);
    }

    // value Update
    public function value_update() {
        $valueId = $this->input->post('ValueId');
        $data = array(
            'ValueName' => $this->input->post('ValueName')
        );
        $this->Values->update($data, 'ValueId', $valueId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cvalue/manage_value'));
    }

    // value delete
    public function value_delete() {
        $valueId = $_POST['ValueId'];
        $this->Values->soft_delete_by_key('ValueId', $valueId);
        return true;
    }

}
