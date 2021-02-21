<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->current_menu = 'home';
        $this->load->model('Auths');
    }

    public function index() {
        $CI = & get_instance();
        $CI->load->library('lcategory');
        $CI->load->library('lassistant');
        $CI->load->model('Products');
        $CI->load->model('Units');
        $CI->load->model('Brands');
        $CI->load->model('Banner');
        
        
        $query = $this->db->query("SELECT gp.*, gu2.UnitName SaleUnitName, CASE WHEN gp.Unit > 0 THEN gu.UnitName ELSE 'KG' END AS UnitName 
        from grocery_products gp join grocery_category gc on gp.Category = gc.CategoryId 
        left join grocery_unit gu on gp.Unit = gu.UnitId 
        left join grocery_unit gu2 on gp.SaleUnit = gu2.UnitId
        where IsFeatured = 1 and gc.Status = 1 and gp.Status = 1 order by ModifiedOn DESC Limit 20");
        $product_list;
        if ($query->num_rows() > 0) {
            $product_list =  $query->result_array();
        }
        $assistant = $CI->lassistant->last_assistant();
        // echo '<pre>'; print_r($assistant);die;
        
        //$catArray = $CI->lcategory->get_category_hierarchy();
        $catArray = $CI->lcategory->get_category_hierarchy_in();
        //echo '<pre>'; print_r($catArray);die;
        foreach($catArray as $key => $value) {
            $products = $CI->Categories->getCatPrducts($value->catId, null, 0, 8);
            if($products)
                $products = $products['products'];
            $value->products = $products;
        }
        $banner = $CI->Banner->get_banners();

        //print_r($banner[0]['image_path']);die;

        $data = array(
            'title' => 'Sauda Express | Buy all your grocery here',
            'CatList' => $catArray,
            'ProdList' => $product_list,
            'Assistant' => json_encode($assistant),
            'BannerImages' => $banner,
            'Page' => 'Home'
        );
        $content = $CI->parser->parse('include/home', $data, true);
        $this->template->full_html_view($content);
    }

    // public function login() {
    //     if ($this->auth->is_logged()) {
    //         $this->output->set_header("Location: " . base_url() . 'Dashboard', TRUE, 302);
    //     }
    //     $data['title'] = 'login_area';
    //     $content = $this->parser->parse('user/login_form', $data, true);
    //     $this->template->full_html_view($content);
    // }

    #==============Valid user check=======#

    // public function do_login() {
    //     $error = '';
    //     $this->load->model('Web_settings');
    //     $setting_detail = $this->Web_settings->retrieve_setting_editdata();
    //     if ($setting_detail[0]['captcha'] == 0 && $setting_detail[0]['secret_key'] != null && $setting_detail[0]['site_key'] != null) {

    //         $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
    //         $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');

    //         if ($this->form_validation->run() == FALSE) {
    //             $this->session->set_userdata(array('error_message' => display('please_enter_valid_captcha')));
    //             $this->output->set_header("Location: " . base_url() . 'Dashboard/login', TRUE, 302);
    //         } else {
    //             $username = $this->input->post('username');
    //             $password = $this->input->post('password');
    //             if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
    //                 $error = display('wrong_username_or_password');
    //             }
    //             if ($error != '') {
    //                 $this->session->set_userdata(array('error_message' => $error));
    //                 $this->output->set_header("Location: " . base_url() . 'Dashboard/login', TRUE, 302);
    //             } else {
    //                 $this->output->set_header("Location: " . base_url(), TRUE, 302);
    //             }
    //         }
    //     } else {
    //         $username = $this->input->post('username');
    //         $password = $this->input->post('password');
    //         if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
    //             $error = display('wrong_username_or_password');
    //         }
    //         if ($error != '') {
    //             $this->session->set_userdata(array('error_message' => $error));
    //             $this->output->set_header("Location: " . base_url() . 'Dashboard/login', TRUE, 302);
    //         } else {
    //             $this->output->set_header("Location: " . base_url(), TRUE, 302);
    //         }
    //     }
    // }

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
            $this->output->set_header("Location: " . base_url(), TRUE, 302);
    }

    #=============Edit Profile======#

    public function edit_profile() {
        $CI = & get_instance();
        $this->auth->check_auth();
        $CI->load->library('luser');
        $content = $CI->luser->edit_profile_form();
        $this->template->full_html_view($content);
    }

    #=============Update Profile========#

    public function update_profile() {
        $CI = & get_instance();
        $this->auth->check_auth();
        $CI->load->model('Users');
        $this->Users->profile_update();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Dashboard/edit_profile'));
    }

    #=============Change Password=========# 

    public function change_password_form() {
        $CI = & get_instance();
        $this->auth->check_auth();
        $content = $CI->parser->parse('user/change_password', array('title' => display('change_password')), true);
        $this->template->full_html_view($content);
    }

    #============Change Password===========#f

    public function change_password() {
        $CI = & get_instance();
        $this->auth->check_auth();
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
            $this->output->set_header("Location: " . base_url() . 'Dashboard/change_password_form', TRUE, 302);
        } else {
            $this->session->set_userdata(array('message' => display('successfully_changed_password')));
            $this->output->set_header("Location: " . base_url() . 'Dashboard/change_password_form', TRUE, 302);
        }
    }

    #============User Authentication=======#

    public function user_login(){
        $data['title'] = 'Sauda Express | Buy each and everything home grocery';
        $data['countries'] = $this->Auths->get_country();
        $data['cities'] = $this->Auths->get_city();
        $content = $this->parser->parse('users/registration', $data, true);
        $this->template->full_html_view($content);
    }
    public function user_authentication() {
        if(isset($_SERVER["HTTP_REFERER"])){
            redirect(base_url("Dashboard/user_login?ret_url=".urlencode($_SERVER["HTTP_REFERER"])));
        }
        else
            redirect(base_url("Dashboard/user_login"));
        // $CI = & get_instance();
        // $CI->load->model('Auths');
        // $data['title'] = 'Sauda Express | Buy each and everything home grocery';
        // $data['countries'] = $CI->Auths->get_country();
        // $data['cities'] = $CI->Auths->get_city();
        // $content = $this->parser->parse('users/registration', $data, true);
        // $this->template->full_html_view($content);
    }
   
    
    // Verify Phone Number
    public function phoneVerify() {
        
        $CI = & get_instance();
        $CI->load->model('Auths');
        $phone_number = $this->input->Post('phone');

        if(!isset($phone_number)) {
            $result['response'] = 'Phone number is not valid';
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }

        // step 1: add an entry in otp table
        $fourRandomDigit = mt_rand(1000,9999);
        $dateTime = new DateTime();
        $date = $dateTime->format('Y-m-d H:i:s');
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(40);
        $formatDate = date("Y-m-d H:i:s", $futureDate);

        $result = $CI->Auths->insert_otp_data($phone_number, $fourRandomDigit, $formatDate);
        if($result == 1) {
            $returnobj = (object)[
                'success' => TRUE,
                'responseMessage' => 'We have sent you a 4-digit code on you phone, Please Verify'
            ];
            echo json_encode($returnobj);
            return;
        } 
        else {
            $returnobj = (object)[
                'success' => FALSE,
                'responseMessage' => 'Something went wrong, Please resend code'
            ];
            echo json_encode($returnobj);
            return;
        }
    
    }

    // Welcome Screen
    public function welcome() {
        // echo 'Welcome Screen';
        if($this->auth->is_logged()) {
            $data['title'] = 'Sauda Express | Buy each and everything home grocery';
            // $data['countries'] = $CI->Auths->get_country();
            // $data['cities'] = $CI->Auths->get_city();
            $content = $this->parser->parse('users/welcome', $data, true);
            $this->template->full_html_view($content);
        }
        else {
            $this->output->set_header("Location: " . base_url() . 'dashboard/user_authentication', TRUE, 302);
        }
    }
}
