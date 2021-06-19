<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpayment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lsetting');
        $this->load->model('SiteSettings');   

        $this->load->library('lpayment');
        $this->load->model('Payment');
    }

    public function index() {
      $content = $this->lsetting->setting_form();

      $content = $this->lpayment->get_payment_list();
      $this->template->full_admin_html_view($content);
    }


}