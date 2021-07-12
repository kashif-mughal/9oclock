<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Csettings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lsetting');
        $this->load->model('SiteSettings');
        
    }

    //Default loading for brand system.
    public function index() {
        
        $content = $this->lsetting->setting_form();
        $this->template->full_admin_html_view($content);
    }
    public function update_site_settings(){
        $data = Array();
        $delivery_charges = $this->input->post('delivery_charges');
        $footer_text = $this->input->post('footer_text');
        $promotion_text = $this->input->post('promotion_text');
        
        //$home_page_cat = $this->input->post('home_page_cat');
        
        
        if(!empty($delivery_charges))
            $data["delivery_charges"] = $delivery_charges;
        if(!empty($footer_text))
            $data["footer_text"] = trim($footer_text);
        if(!empty($promotion_text))
            $data["promotion_text"] = trim($promotion_text);
        /*if(!empty($home_page_cat))
            $h_cat= Array("0");
            foreach($home_page_cat as $home_page_ca){
                $h_cat[] = $home_page_ca;
            }
            $data["home_page_cat"] = json_encode($h_cat);*/

        $result = $this->SiteSettings->update($data, "setting_id", 1);

        if($result == true)
            $this->session->set_userdata(array('message' => 'Successfully Updated'));
        else
            $this->session->set_userdata(array('error_message' => "Something went wrong"));

        redirect(base_url('Csettings'));
    }
    
    public function update_site_settings_categories(){
        $home_page_cat = ($_POST['item']);
        //var_dump($home_page_cat);exit();
        $data = Array();
        /*
        $delivery_charges = $this->input->post('delivery_charges');
        $footer_text = $this->input->post('footer_text');
        $home_page_cat = $this->input->post('home_page_cat');
        
        
        if(!empty($delivery_charges))
            $data["delivery_charges"] = $delivery_charges;
        if(!empty($footer_text))
            $data["footer_text"] = trim($footer_text);*/
        if(!empty($home_page_cat))
            $h_cat= Array("0");
            foreach($home_page_cat as $home_page_ca){
                $h_cat[] = $home_page_ca;
            }
            $data["home_page_cat"] = json_encode($h_cat);

        $result = $this->SiteSettings->update($data, "setting_id", 1);

        if($result == true)
            $this->session->set_userdata(array('message' => 'Successfully Updated'));
        else
            $this->session->set_userdata(array('error_message' => "Something went wrong"));

        //redirect(base_url('Csettings'));
    }
}
