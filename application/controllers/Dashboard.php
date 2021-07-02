<?php
require_once 'vendor/autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\ServiceBus\Models\BrokeredMessage;
use WindowsAzure\ServiceBus\Models\ReceiveMessageOptions;


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
        
        // $query = $this->db->query("SELECT gp.*, gu2.UnitName SaleUnitName, CASE WHEN gp.Unit > 0 THEN gu.UnitName ELSE 'KG' END AS UnitName 
        // from grocery_products gp join grocery_category gc on gp.Category = gc.CategoryId 
        // left join grocery_unit gu on gp.Unit = gu.UnitId 
        // left join grocery_unit gu2 on gp.SaleUnit = gu2.UnitId
        // where IsFeatured = 1 and gc.Status = 1 and gp.Status = 1 order by ModifiedOn DESC Limit 20");
        // $product_list;
        // if ($query->num_rows() > 0) {
        //     $product_list =  $query->result_array();
        // }

        $product_list = $CI->Products->get_featured_and_products();

        //$catArray = $CI->lcategory->get_category_hierarchy();
        $catArray = $CI->lcategory->get_category_hierarchy_in();
        //echo '<pre>'; print_r($product_list);die;
        foreach($catArray as $key => $value) {
            $products = $CI->Categories->getCatPrducts($value->catId, null, 0, 8);
            if($products)
                $products = $products['products'];
            $value->products = $products;
        }
        $banner = $CI->Banner->get_banners();

        //print_r($banner[0]['image_path']);die;

        $data = array(
            'title' => '9o\'Clock | Buy all your grocery here',
            'CatList' => $catArray,
            'ProdList' => $product_list,
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

    public function logout_email() {
        if ($this->auth->logout_email())
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
        $data['title'] = '9o\'Clock | Buy each and everything home grocery';
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
        // $data['title'] = '9o\'Clock | Buy each and everything home grocery';
        // $data['countries'] = $CI->Auths->get_country();
        // $data['cities'] = $CI->Auths->get_city();
        // $content = $this->parser->parse('users/registration', $data, true);
        // $this->template->full_html_view($content);
    }

    public function user_authentication_email() {
        if(isset($_SERVER["HTTP_REFERER"])){
            redirect(base_url("Dashboard/user_login_email?ret_url=".urlencode($_SERVER["HTTP_REFERER"])));
        }
        else
            redirect(base_url("Dashboard/user_login_email"));
        // $CI = & get_instance();
        // $CI->load->model('Auths');
        // $data['title'] = '9o\'Clock | Buy each and everything home grocery';
        // $data['countries'] = $CI->Auths->get_country();
        // $data['cities'] = $CI->Auths->get_city();
        // $content = $this->parser->parse('users/registration', $data, true);
        // $this->template->full_html_view($content);
    }

    public function user_login_email() {
        $data['title'] = '9oClock | Buy each and everything home grocery';
        $data['countries'] = $this->Auths->get_country();
        $data['cities'] = $this->Auths->get_city();
        $content = $this->parser->parse('users/registration_email', $data, true);
        
        $this->template->full_html_view($content);
    }

    //:::::: Reset Password by Email Address :::::::::
    public function user_password_reset() {
        $data['title'] = '9oClock | Buy each and everything home grocery';
        $content = $this->parser->parse('users/password_reset_email', $data, true);

        $this->template->full_html_view($content);
    }

    public function reset_password_email() {
        $CI = & get_instance();
        $CI->load->model('Auths');
        $email_address = $this->input->Post('email');
        if(!isset($email_address)) {
            $result['response'] = 'Email address is not valid';
            $result['status'] = 'error';
            echo json_encode($result);
            return;
        }

        // Check email exist 
        $isEmailExist = $CI->Auths->is_email_exist($email_address);
        if(!$isEmailExist) {
            $result['response'] = 'Please provide valid email address';
            $result['status'] = 'error';
            echo json_encode($result);
            return;
        }
        else { // Email exist
            // if exist then check is Active or not
            if($isEmailExist[0]['status'] == 0) {
                $result['response'] = 'User is inactive, Please contact support';
                $result['status'] = 'error';
                echo json_encode($result);
                return;
            }
            else {
                // send reset password link to it's provided email address.
                // Generate Link for this user for password reset

                // step 1: Get complete data from user table using email address
                $userDetail = $CI->Auths->check_user_detail($email_address);
                if(!$userDetail) {
                    $result['response'] = 'Please provided complete user detail';
                    $result['status'] = 'error';
                    echo json_encode($result);
                    return;
                }
                else {
                    $userTokenString = json_encode($userDetail);
                    $userTokenHash = hash('sha256', $userTokenString);

                    $userResetLink = base_url().'user/resetpassword?token='.$userTokenHash.'&uid='.$email_address;

                    // send above link to user email address.
                    $message = "Please click on the below link to reset your password</br>".
                        "<p><a href='.$userResetLink.'>".$userResetLink."</a></p>";
                    //$CI->Auths->sendemail($to_email, $message);

                    $result['response'] = '<p class="resetEmailUserText">Dear User</p></br><p class="resetEmailText">We have sent you a reset password link on your email address</p>';
                    $result['status'] = 'success';
                    $result['resetlink'] = $userResetLink;
                    echo json_encode($result);
                    return;
                }
            }
        }
    }

    // Reset Password by Email Address [END]

    public function email_exist() {
        $CI = & get_instance();
        $CI->load->model('Auths');
        $email_address = $this->input->Post('email');

        if(!isset($email_address)) {
            $result['response'] = 'Email address is not valid';
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }
        // Check email in user_login table
        $isEmailExist = $CI->Auths->is_email_exist($email_address);
        if($isEmailExist) {
            // check is otp is verified
            $isOTPVerified = $CI->Auths->is_otp_verified($email_address);
            if($isOTPVerified) {
                if($isOTPVerified[0]["verified"] == "1") {
                    // Check user detail
                    $userDetail = $CI->Auths->check_user_detail($email_address);

                    if($userDetail) {
                        $result['response'] = "User is already available";
                        $result['status'] = 'userAvailable'; // send to Login Page
                        echo json_encode($result);
                        return;
                    }

                    $result['response'] = "User is available but not fully registered.";
                    $result['status'] = 'userNotRegister'; // send to Register Page
                    echo json_encode($result);
                    return;
                }
            }
        }
        $otp_response = $this->send_registeration_email($email_address);
        if($otp_response->success) {
            $result['response'] = $otp_response->responseMessage;
            $result['status'] = 'OTPsend';
            echo json_encode($result); // stay on the same page
            return;
        }
        $result['response'] = "Please try again.";
        $result['status'] = 'Stay';
        echo json_encode($result); // stay on the same page
        return;

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

    // Email Verify
    public function send_registeration_email($email_address) {
        $CI = & get_instance();
        $CI->load->model('Auths');

        if(!isset($email_address)) {
            $result['response'] = 'Email address is not valid';
            $result['status'] = 'Error';
            return $result;
        }

        // step 1: add an entry in otp table
        $fourRandomDigit = mt_rand(1000,9999);
        $dateTime = new DateTime();
        $date = $dateTime->format('Y-m-d H:i:s');
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(40);
        $formatDate = date("Y-m-d H:i:s", $futureDate);

        $result = $CI->Auths->insert_otp_data_email($email_address, $fourRandomDigit, $formatDate);
        if($result) {
            $returnobj = (object)[
                'success' => TRUE,
                'responseMessage' => 'We have sent you a 4-digit code on you phone, Please Verify'
            ];
            return $returnobj;
        } 
        else {
            $returnobj = (object)[
                'success' => FALSE,
                'responseMessage' => 'Something went wrong, Please resend code'
            ];
            return $returnobj;
        }
    }







    // Welcome Screen
    public function welcome() {
        // echo 'Welcome Screen';
        if($this->auth->is_logged()) {
            $data['title'] = '9o\'Clock | Buy each and everything home grocery';
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
