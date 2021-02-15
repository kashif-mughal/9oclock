<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Creport extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lreport');
        $this->load->library('session');
        $this->load->model('Reports');
    }

    public function index() {
    	$content = $this->lreport->daily_report();
        $this->template->full_admin_html_view($content);
    }

    public function generate_report() {
    	$type = $_POST['Report_Type'];
    	$start = $_POST['start_date'];
    	$end = $_POST['end_date'];

    	$content = $this->lreport->daily_report2($type, $start, $end);    	
    	echo json_encode($content);
    }

    public function profit_margin_form() {
        $content = $this->lreport->profit_margin_form();
        $this->template->full_admin_html_view($content);
    }

    public function profit_margin() {
        $type = $_POST['Report_Type'];
        $start = $_POST['start_date'];
        $end = $_POST['end_date'];

        $content = $this->lreport->profit_margin_report($type, $start, $end);      
        echo json_encode($content);
    }

}