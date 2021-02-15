<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cassistant extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lassistant');
        $this->load->model('Assistants');
    }

    //Default loading for assistant system.
    public function index() {
        $content = $this->lassistant->assistant_add_form();
        $this->template->full_admin_html_view($content);
    }

    public function product_select(){
        $CI = & get_instance();
        $CI->load->model('Products');
        $q = $this->input->get('search');
        if(empty($q))
            return null;
        $products = $CI->Products->search($q, "grocery_assistant");
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

    //Manage assistant form
    public function manage_assistant() {
        $content = $this->lassistant->assistant_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert assistant and upload
    public function insert_assistant() {
        $productIds = $this->input->post('productId');
        $finalResult = true;
        for ($i=0; $i < count($productIds); $i++) { 
            $data = array(
                'ProductId' => $productIds[$i],
                'CreatedOn' => date_format(new DateTime(), 'Y-m-d'),
                'Status' => 1
            );

            $result = $this->Assistants->assistant_entry($data);
            if($finalResult)
                $finalResult = $result;
        }
        

        if ($finalResult == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-assistant'])) {
                redirect(base_url('Cassistant/manage_assistant'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Cassistant'));
        }
    }

    //assistant Update Form
    public function assistant_update_form($assistantId) {
        $content = $this->lassistant->assistant_edit_data($assistantId);
        $this->template->full_admin_html_view($content);
    }

    // assistant Update
    public function assistant_update() {
        $assistantId = $this->input->post('AssistantId');
        $data = array(
            'AssistantName' => $this->input->post('AssistantName')
        );
        $this->Assistants->update($data, 'AssistantId', $assistantId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cassistant/manage_assistant'));
    }

    // assistant delete
    public function assistant_delete() {
        $assistantId = $_POST['AssistantId'];
        $this->Assistants->soft_delete_by_key('AssistantId', $assistantId);
        return true;
    }

}
