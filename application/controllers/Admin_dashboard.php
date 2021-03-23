<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->current_menu = 'home';
        //$this->load->database();
    }
    public function test(){
        $CI = & get_instance();
        $CI->load->library('lpage');
        $data = $CI->lpage->dashboard();
        // echo '<pre>';
        // print_r($data);die;
        $this->load->view('test', $data);
    }
    public function index() {
        $this->auth->check_admin_auth();
        //redirect(base_url("Corder"));
        //return;
         $CI = & get_instance();
         if (!$this->auth->is_logged()) {
             $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
         }
         $data = array(
             'title' => display('dashboard')
         );
         $content = $CI->parser->parse('include/admin_home', $data, true);
         $this->template->full_admin_html_view($content);
    }

    public function login() {
        if ($this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard', TRUE, 302);
        }
        $data['title'] = display('admin_login_area');
        $content = $this->parser->parse('user/admin_login_form', $data, true);
        $this->template->full_admin_html_view($content);
    }

    #==============Valid user check=======#

    public function do_login() {
        $error = '';
        $this->load->model('Web_settings');
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();

        if ($setting_detail[0]['captcha'] == 0 && $setting_detail[0]['secret_key'] != null && $setting_detail[0]['site_key'] != null) {

            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata(array('error_message' => display('please_enter_valid_captcha')));
                $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
                    $error = display('wrong_username_or_password');
                }
                if ($error != '') {
                    $this->session->set_userdata(array('error_message' => $error));
                    $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
                } else {
                    $this->output->set_header("Location: " . base_url(), TRUE, 302);
                }
            }
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
                $error = display('wrong_username_or_password');
            }
            if ($error != '') {
                $this->session->set_userdata(array('error_message' => $error));
                $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            } else {
                $this->output->set_header("Location: " . base_url(), TRUE, 302);
            }
        }
    }

    //Valid captcha check
    function validate_captcha() {
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $setting_detail[0]['secret_key'] . ".&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    #===============Logout=======#

    public function logout() {
        if ($this->auth->logout())
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
    }

    #=============Edit Profile======#

    public function edit_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('luser');
        $content = $CI->luser->edit_profile_form();
        $this->template->full_admin_html_view($content);
    }

    #=============Update Profile========#

    public function update_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Users');
        $this->Users->profile_update();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Admin_dashboard/edit_profile'));
    }

    #=============Change Password=========# 

    public function change_password_form() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $content = $CI->parser->parse('user/change_password', array('title' => display('change_password')), true);
        $this->template->full_admin_html_view($content);
    }

    #============Change Password===========#

    public function change_password() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Users');

        $error = '';
        $email = $this->input->post('email');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('password');
        $repassword = $this->input->post('repassword');

        if ($email == '' || $old_password == '' || $new_password == '') {
            $error = display('blank_field_does_not_accept');
        } else if ($email != $this->session->userdata('user_email')) {
            $error = display('you_put_wrong_email_address');
        } else if (strlen($new_password) < 6) {
            $error = display('new_password_at_least_six_character');
        } else if ($new_password != $repassword) {
            $error = display('password_and_repassword_does_not_match');
        } else if ($CI->Users->change_password($email, $old_password, $new_password) === FALSE) {
            $error = display('you_are_not_authorised_person');
        }

        if ($error != '') {
            $this->session->set_userdata(array('error_message' => $error));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        } else {
            $this->session->set_userdata(array('message' => display('successfully_changed_password')));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        }
    }
}
