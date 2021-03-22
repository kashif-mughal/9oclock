<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('luser');
        $this->load->model('Users');
    }

    #==============User page load============#

    public function index() {
        // $content = $this->lusers->user_add_form();
        // $this->template->full_admin_html_view($content);
    }

    #=============Edit Profile======#

    public function edit_profile() {
        $CI = & get_instance();
        $this->auth->check_auth();
        $content = $CI->luser->edit_user_profile_form();
        $this->template->full_html_view($content);
    }

    #=============Update Profile========#

    public function update_profile() {
        $CI = & get_instance();
        $this->auth->check_auth();
        $this->Users->profile_update('user');
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('User/edit_profile'));
    }

    public function value_cart() {
        $CI = & get_instance();
        //$this->auth->check_auth();
        $content = $CI->luser->user_value_cart();
        $this->template->full_html_view($content);
    }

    public function submit_address(){
        $this->auth->check_auth();
        $addresses = $this->input->post('selectedAddress');
        if(empty($addresses) || count($addresses) == 0){
            $result['status'] = 0;
            $result['message'] = 'Add atleast one address';
            print_r(json_encode($result));
            exit();
        }
        $insertedIds = $this->Users->update_address($this->input->post('selectedAddress'));
        if($insertedIds){
            $result['status'] = 1;
            $result['message'] = 'Address updated successfully';
            $result['insertedIds'] = $insertedIds;
            print_r(json_encode($result));
            exit();
        }else{
            $result['status'] = 0;
            $result['message'] = 'Something went wrong';
            print_r(json_encode($result));
            exit();
        }
    }
    public function delete_address(){
        $this->auth->check_auth();
        $addressId = $this->input->post('addressId');
        if(empty($addressId)){
            $result['status'] = 0;
            $result['message'] = 'Select a proper address';
            print_r(json_encode($result));
            exit();
        }
        $success = $this->Users->soft_delete_user_address($addressId);
        if($success){
            $result['status'] = 1;
            $result['message'] = 'Address Removed successfully';
            print_r(json_encode($result));
            exit();
        }else{
            $result['status'] = 0;
            $result['message'] = 'Record not found';
            print_r(json_encode($result));
            exit();
        }
    }

    public function submit_address_info(){
        $this->auth->check_auth();
        
        $email = $this->input->post('newAddressEmail');
        $address = $this->input->post('newAddress') . ' ' . $this->input->post('newAddress2');
        if(empty($address)){
            $result['status'] = 0;
            $result['message'] = 'Add atleast one address';
            print_r(json_encode($result));
            exit();
        }
        $this->Users->profile_update();
        $addresses = Array();
        array_push($addresses, $address);
        $insertedIds = $this->Users->update_address($addresses);
        if($insertedIds){
            $result['status'] = 1;
            $result['message'] = 'Address updated successfully';
            $result['id'] = $insertedIds[0];
            $result['address'] = $address;
            print_r(json_encode($result));
            exit();
        }else{
            $result['status'] = 0;
            $result['message'] = 'Something went wrong';
            print_r(json_encode($result));
            exit();
        }
    }

    // Verify reset password link
    public function resetpassword() {
        $CI = & get_instance();
        $CI->load->model('Auths');
        $token = $_GET["token"];
        $uid = $_GET["uid"];
        if(!isset($token) && !isset($uid)) {
            $result['status'] = 0;
            $result['message'] = "Plese provide correct reset link";
            print_r(json_encode($result));
            exit();
        }
        else {
            // Check email exist 
            $userDetail = $CI->Auths->check_user_detail($uid);
            if(!$userDetail) {
                $result['status'] = 0;
                $result['message'] = "Please provide corrct user detail";
                print_r(json_encode($result));
                exit();
            }
            else {
                $userTokenString = json_encode($userDetail);
                $userTokenHash = hash('sha256', $userTokenString);

                if($userTokenHash == $token) {
                    $data['title'] = '9oClock | Buy each and everything home grocery';
                    $data['email'] = $uid;
                    $content = $this->parser->parse('users/reset_password_form', $data, true);

                    $this->template->full_html_view($content);
                }
                else {
                    $result['status'] = 0;
                    $result['message'] = "Reset Password link is not valid";
                    print_r(json_encode($result));
                    exit();
                }
            }
        }
    }

    // Update user password
    public function updatePassword() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if(!isset($email) && !isset($password)) {
            $result['status'] = 0;
            $result['message'] = "Please provide email and password";
            echo json_encode($result);
            exit();
        }
        else {
            //$insertedIds = $this->Users->update_address($this->input->post('selectedAddress'));
            $updateResult = $this->Users->updateUserPassword($email, $password);
            if($updateResult) {
                $result['status'] = 1;
                $result['message'] = "Password Updated Successfully";
                echo json_encode($result);
                exit();
            }
            else {
                $result['status'] = 0;
                $result['message'] = "Something went wrong password is not updated";
                print_r(json_encode($result));
                exit();
            }
        }

    }

}
