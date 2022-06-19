<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('lpage');
    }

    public function index() {
        //default page
        $content = $this->lpage->t_and_c();
        $this->template->full_html_view($content);
    }

    public function vision() {
        //default page
        $content = $this->lpage->vision();
        $this->template->full_html_view($content);
    }

    public function brandstore() {
        //default page
        $content = $this->lpage->brandstore();
        $this->template->full_html_view($content);
    }

    public function privacy() {
        //default page
        $content = $this->lpage->privacy();
        $this->template->full_html_view($content);
    }

    public function faq() {
        //default page
        $content = $this->lpage->faq();
        $this->template->full_html_view($content);
    }
	
	public function cancellationrefundandreturn() {
        //default page
        $content = $this->lpage->cancellationrefundandreturn();
        $this->template->full_html_view($content);
    }
	
	public function contactus() {
        //default page
        $content = $this->lpage->contactus();
        $this->template->full_html_view($content);
    }
	
	public function returnandrefund() {
        //default page
        $content = $this->lpage->returnandrefund();
        $this->template->full_html_view($content);
    }

    public function categories() {
        //default page
        $content = $this->lpage->categories();
        $this->template->full_html_view($content);
    }

    public function contactus() {
        //default page
        $content = $this->lpage->contactus();
        $this->template->full_html_view($content);
    }
}
