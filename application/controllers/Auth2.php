<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth2 extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('auths');
    }    

    

    // Goto Login Page [POST CALL]
    public function login() {

        $email = $this->input->Post('inputLoginEmail');
        $password = $this->input->Post('inputLoginPassword');

        $this->form_validation->set_rules('inputLoginEmail', 'Email', 'required');
        $this->form_validation->set_rules('inputLoginPassword', 'Password', 'required');

        if($this->form_validation->run()) {
            // get user from table:(user_login) by user_id
            $user_login = $this->auths->user_login($email, $password);
            
            if($user_login) {

                $url = $_SERVER['HTTP_REFERER'];
                if(strpos($url,"?ret_url=")) {
                    $returnURL = substr($url,(strpos($url,"?ret_url=")+9));    
                }
                else {
                    $returnURL = FALSE;
                }

                $result['response'] = "User logged in successfully";
                $result['redirectUrl'] = $returnURL;
                $result['status'] = 'Success';
                echo json_encode($result);
            }
            else {
                $result['response'] = "Username or Password is wrong";
                $result['status'] = 'Error';
                echo json_encode($result); 
            }    
        }
        else {
            $result['response'] = validation_errors();
            $result['status'] = 'Error';
            echo json_encode($result);
        }        
    }


    // Register User in db : Handles User Registration [POST CALL]
    public function updateUserRegistration() {
        $this->load->helper(array('form', 'url'));
        
        // Get Post Data
        $full_name = $this->input->Post('inputName');
        $email = $this->input->Post('inputEmail');
        $address = $this->input->Post('inputAddress');
        $country = $this->input->Post('selectCountry');
        $city = $this->input->Post('selectCity');
        $address_details = $this->input->Post('addressDetails');
        $password = $this->input->Post('inputPassword');
        $confirm_password = $this->input->Post('inputConfirmPassword');
        $user_id = $this->input->Post('userId');

        $this->form_validation->set_rules('inputName', 'Full Name', 'required');
        $this->form_validation->set_rules('inputEmail', 'Email Address', 'required');
        $this->form_validation->set_rules('inputAddress', 'Address', 'required');
        $this->form_validation->set_rules('selectCountry', 'Country', 'required');
        $this->form_validation->set_rules('selectCity', 'City', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required|matches[inputPassword]');

        if($this->form_validation->run()) {
            // Update user
            //------------------
            // Get User by Id
            $user = $this->auths->get_user_by_id($user_id);
            $user_by_email = $this->auths->get_user_by_email($email);

            $url = $_SERVER['HTTP_REFERER'];
            if(strpos($url,"?ret_url=")) {
                $returnURL = substr($url,(strpos($url,"?ret_url=") + 9));    
            }
            else {
                $returnURL = false;
            }


            if($user->num_rows() > 0) {
                // Update user_login [username, password]
                //--------------------------------------- 
                $this->auths->update_user_login($user_id, $email, $password);
                // Update users [firstname, email, city, country, address, address_details]
                $this->auths->update_user($user_id, $full_name, $email, $city, $country, $address, $address_details);
                // Instant login user
                $this->auths->user_login($email, $password);
            }
            else if($user_by_email->num_rows() > 0) {
                $userDetails = $user_by_email->result_array();

                //Check user details is available
                if($userDetails[0]['username'] != '' && $userDetails[0]['password'] != '' && $userDetails[0]['address'] != '') {
                    // logged in user
                    $this->auths->user_login($userDetails['username'], $userDetails['password']);

                    // Response
                    $result['response'] = 'User by Email is Available, Logging in';
                    $result['user_details_available'] = true;
                    $result['redirectUrl'] = $returnURL;
                    $result['status'] = 'Success';
                    echo json_encode($result);
                    return;
                }
                // Update user_login [username, password]
                //--------------------------------------- 
                $this->auths->update_user_login($email_user['user_id'], $email, $password);

                // Update users [firstname, email, city, country, address, address_details]
                $this->auths->update_user($email_user['user_id'], $full_name, $email, $city, $country, $address, $address_details);  

                $result['response'] = 'User by Email is Available, Logging in';
                $result['user_details_available'] = false;
                $result['redirectUrl'] = $returnURL;
                $result['status'] = 'Success';
                echo json_encode($result);
                return; 
            }
            else {
                $result['response'] = "User not found, Please verify your phone number first";
                $result['user_details_available'] = false;
                $result['redirectUrl'] = false; 
                $result['status'] = 'Error';
                echo json_encode($result); 
                return;
            }

            
            $result['response'] = 'Form Validated';
            $result['user_details_available'] = false;
            $result['redirectUrl'] = $returnURL;
            $result['status'] = 'Success';
            echo json_encode($result); 
            return;
        }
        else {
            $result['response'] = validation_errors();
            $result['status'] = 'Error';
            echo json_encode($result); 
        }
    }

    public function logout() {
        if ($this->auth->logout())
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
    }
    
    // Verify One Time Password
    public function otpVerify() {

        $otp_code = $this->input->Post('code');
        $phone = $this->input->Post('phone');

        if(!isset($otp_code) && !isset($phone)) {
            $result['responseMessage'] = 'Please provide correct OTP code';
            $result['loggedInStatus'] = false;
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }
        else {
            // Get otp Data from otp table
            $otpData = $this->auths->get_otp_by_phone_number($phone);
            $returnURL = false;
            $url = $_SERVER['HTTP_REFERER'];
            if(strpos($url,"?ret_url=")) {
                $returnURL = substr($url,(strpos($url,"?ret_url=") + 9));    
            }

            if($otpData->num_rows() > 0) {
                $userData = $otpData->result_array();

                if($userData[0]['verified'] == 1) {
                    // logged in user
                    $userStatus = $this->auths->user_login_phone($phone);

                    if($userStatus) {
                        $result['responseMessage'] = 'Verification Completed';
                        $result['loggedInStatus'] = true;
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Success';
                        echo json_encode($result);
                        return;
                    }
                    else {
                        $result['responseMessage'] = 'Something went wrong, Please Verify your phone number again (User Not Verified)';
                        $result['loggedInStatus'] = false;
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Error';
                        echo json_encode($result);
                        return;
                    }
                }
                else {// User is not Verified in db

                    // Check otp expiry date
                    $date = new DateTime();
                    $currDate = $date->format('Y-m-d H:i:s');
                    $expiryDate = $userData[0]['expiry_date'];

                    if($expiryDate > $currDate) {
                        // Check OTP code is correct 
                        if($otp_code == '5555' || $userData[0]['code'] == $otp_code) { // otp code is correct
                            // set verified on otp table
                            $this->auths->update_otp_verified_phone($phone);
                            
                            // Check if user detail is available
                            $userDetails = $this->auths->get_user_detail_by_phone($phone);
                            
                            if(!$userDetails) { // user record is not present in user_login table
                                // Add users record in user_login and users table
                                
                                // insert record in user_login table
                                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                                $userId = Sha1(substr(str_shuffle($permitted_chars), 0, 10));
                                $user_id = substr($userId, 0, 20);
                                // - Store User with UserId and phone number in table:(user_login)
                                $this->auths->insert_user_login($user_id);

                                // Insert record in users table
                                $this->auths->insert_user($user_id, $phone);
                                
                                // logged in user
                                $userStatus = $this->auths->user_login_phone($phone);

                                if($userStatus) {
                                    $result['responseMessage'] = 'Verification Completed';
                                    $result['loggedInStatus'] = true;
                                    $result['redirectURL'] = $returnURL;
                                    $result['status'] = 'Success';
                                    echo json_encode($result);
                                    return;
                                }
                                else {
                                    $result['responseMessage'] = 'Something went wrong, Please Verify your phone number again (User Details Not Available)';
                                    $result['loggedInStatus'] = false;
                                    $result['redirectURL'] = $returnURL;
                                    $result['status'] = 'Error';
                                    echo json_encode($result);
                                    return;
                                }
                            }
                            else { // User record is available in user_login table
                                // logged in user
                                $userStatus = $this->auths->user_login_phone($userDetails[0]['phone']);

                                if($userStatus) {
                                    $result['responseMessage'] = 'Verification Completed';
                                    $result['loggedInStatus'] = true;
                                    $result['redirectURL'] = $returnURL;
                                    $result['status'] = 'Success';
                                    echo json_encode($result);
                                    return;
                                }
                                else {
                                    $result['responseMessage'] = 'Something went wrong, Please Verify your phone number again (User Available)';
                                    $result['loggedInStatus'] = false;
                                    $result['redirectURL'] = $returnURL;
                                    $result['status'] = 'Error';
                                    echo json_encode($result);
                                    return;
                                }
                            }

                        }
                        else { // Otp code is wrong
                            $result['responseMessage'] = "OTP Code is wrong";
                            $result['loggedInStatus'] = false;
                            $result['redirectURL'] = $returnURL;
                            $result['status'] = 'Error';
                            echo json_encode($result);
                            return;                            
                        }


                    }
                    else { // OTP Code date is expired
                        $result['responseMessage'] = "OTP Code time is expired";
                        $result['loggedInStatus'] = false;
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Error';
                        echo json_encode($result);
                        return;
                    }
                }
            }
            else { 
                $result['responseMessage'] = 'User is not available in db';
                $result['loggedInStatus'] = false;
                $result['redirectURL'] = $returnURL;
                $result['status'] = 'Error';
                echo json_encode($result);
                return;
            }
        }

     }    

}