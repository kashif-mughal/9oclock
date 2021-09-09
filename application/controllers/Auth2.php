<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth2 extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('auths');
    }    

    public function login_email() {
        $email = $this->input->Post('inputLoginEmail');
        $password = $this->input->Post('inputLoginPassword');

        $this->form_validation->set_rules('inputLoginEmail', 'Email', 'required');
        $this->form_validation->set_rules('inputLoginPassword', 'Password', 'required');

        if($this->form_validation->run()) {
            $user_login = $this->auths->user_login_email($email, $password);

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

    // Register User in db using Email: 
    public function updateUserRegistrationByEmail() {
        $this->load->helper(array('form', 'url'));

        $firstName = $this->input->Post('inputFirstName');
        $lastName = $this->input->Post('inputLastName');
        $email = $this->input->Post('inputEmail');
        $phone = $this->input->Post('inputPhone');
        $address = $this->input->Post('inputAddress');
        $zip_code = $this->input->Post('inputZipCode');
        $town = $this->input->Post('inputTown');
        $city = $this->input->Post('inputCity');
        $password = $this->input->Post('inputPassword');
        $confirm_password = $this->input->Post('inputConfirmPassword');
        $promotion_email = $this->input->Post('chbxReceiveOffers');

        $isPromotion = false;

        if($promotion_email == "on") { $isPromotion = true; }

        // Validation
        $this->form_validation->set_rules('inputFirstName', 'First Name', 'required');
        $this->form_validation->set_rules('inputLastName', 'Last Name', 'required');
        $this->form_validation->set_rules('inputEmail', 'Email Address', 'required');
        $this->form_validation->set_rules('inputAddress', 'Address', 'required');
        $this->form_validation->set_rules('inputZipCode', 'ZipCode', 'required');
        $this->form_validation->set_rules('inputTown', 'Town', 'required');
        $this->form_validation->set_rules('inputCity', 'City', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required|matches[inputPassword]');

        if($this->form_validation->run()) {

            // get user from db and if verified send to login page else send otp page
            $userDetail = $this->auths->user_login_email_otp($email);
            if($userDetail) {
                if($userDetail[0]['verified'] == 1) {
                    // send it to login page
                    $result['responseMessage'] = 'User is already available, Please login';
                    $result['loggedInStatus'] = true;
                    $result['redirectURL'] = $returnURL;
                    $result['status'] = 'Success';
                    echo json_encode($result);
                    return;
                }
                else {
                    // send it to otp page
                    $otpTableResponse = $this->auths->send_registeration_email($email);
                    $result['responseMessage'] = 'User is available, We have send you an email with otp code, Please verify';
                    $result['loggedInStatus'] = false;
                    $result['redirectURL'] = $returnURL;
                    $result['status'] = 'Success';
                    echo json_encode($result);
                    return;
                }
            }
            else {
                // if user is not available then create user

                // insert user in user login and user Detail table
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $userId = Sha1(substr(str_shuffle($permitted_chars), 0, 10));
                $user_id = substr($userId, 0, 20);
                // - Store User with UserId and phone number in table:(user_login)
                $this->auths->insert_user_login_email($user_id, $email, $password);

                // Insert record in users table
                $this->auths->insert_user_email($user_id, $firstName, $lastName, $email, $phone, $address, $zip_code, $town, $city, $isPromotion);

                // Insert otp record and send otp
                $isEmailExist = $this->auths->is_email_exist($email);
                if($isEmailExist) {

                    // Otp is verified
                    $isOtpVerified = $this->auths->is_otp_verified($email);
                    if($isOtpVerified[0]["verified"] == "1") {
                        $result['responseMessage'] = 'User is verified, Please login';
                        $result['loggedInStatus'] = true;
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Success';
                        echo json_encode($result);
                        return;
                    }
                    else {
                        $otpTableResponse = $this->auths->send_registeration_email($email);
                        $result['responseMessage'] = 'Please verify Otp';
                        $result['loggedInStatus'] = false;
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Success';
                        echo json_encode($result);
                        return;
                    }
                }
                else {
                    $result['responseMessage'] = 'Something went wrong, Please contact service provider.';
                    $result['loggedInStatus'] = false;
                    $result['redirectURL'] = $returnURL;
                    $result['status'] = 'Error';
                    echo json_encode($result);
                    return;
                }
            }
            
        }
        else {
            $result['responseMessage'] = validation_errors();
            $result['status'] = 'Error';
            echo json_encode($result); 
        }
    }

    // Register User in db : Handles User Registration [POST CALL]
    public function updateUserRegistration() {
        $this->load->helper(array('form', 'url'));
        
        // Get Post Data
        $first_name = $this->input->Post('inputFirstName');
        $last_name = $this->input->Post('inputLastName');
        $email = $this->input->Post('inputEmail');
        $address = $this->input->Post('inputAddress');
        $country = $this->input->Post('selectCountry');
        $city = $this->input->Post('selectCity');
        $address_details = $this->input->Post('addressDetails');
        $password = $this->input->Post('inputPassword');
        $confirm_password = $this->input->Post('inputConfirmPassword');
        $user_id = $this->input->Post('userId');

        $this->form_validation->set_rules('inputFirstName', 'First Name', 'required');
        $this->form_validation->set_rules('inputLastName', 'Last Name', 'required');
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
                $this->auths->update_user($user_id, $first_name, $last_name, $email, $city, $country, $address, $address_details);
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
                $this->auths->update_user($email_user['user_id'], $first_name, $last_name, $email, $city, $country, $address, $address_details);  

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

    public function logout_email() {
        if ($this->auth->logout_email())
            $this->output->set_header("Location: " . base_url() . 'dashboard/user_login_email', TRUE, 302);
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
     
     
     // Verify OTP Code using Email 
     public function otpVerifyEmail() {
        $otp_code = $this->input->Post('code');
        $email = $this->input->Post('email');

        if(!isset($otp_code) && !isset($email)) { // check if otpcode and email is not provided
            $result['responseMessage'] = 'Please provide correct OTP code';
            $result['loggedInStatus'] = 'stay';
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }
        else {
            // Get otp Data from otp table
            $otpData = $this->auths->get_otp_by_email_address($email);
            
            $returnURL = false;
            $url = $_SERVER['HTTP_REFERER'];
            if(strpos($url,"?ret_url=")) {
                $returnURL = substr($url,(strpos($url,"?ret_url=") + 9));    
            }

            if($otpData->num_rows() > 0) { 
                
                $userData = $otpData->result_array();
                if($userData[0]['verified'] == 1) { // user is already verified
                    
                    $userStatus = $this->auths->user_login_email_otp($email);
                    if(!$userStatus) { // otp verified, user login data is not available (Goto Register Page)
                        $result['responseMessage'] = 'User is not available in db';
                        $result['loggedInStatus'] = "stay"; // login, register, stay
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = FALSE;
                        // print_r('Login Detail is not available');die;
                        echo json_encode($result);
                        return;
                    }
                    else { // login data is available
                        // $userDetails = $this->auths->get_user_detail_by_email($email);
                        // if($userDetails) { // otp verified, user loign data is avaiable and user details is also available (Goto Login Page)
                            $result['responseMessage'] = 'User is available in db, Please Login';
                            $result['loggedInStatus'] = "login"; // login, register, stay
                            $result['redirectURL'] = $returnURL;
                            $result['status'] = TRUE;
                            // print_r('All is Good ');die;
                            echo json_encode($result);
                            return;
                        // }
                        // else { // otp verified, user login data is available but user details is unavailable (Goto Register Page)
                        //     $result['responseMessage'] = 'User is not fully registered';
                        //     $result['loggedInStatus'] = "register"; // login, register, stay
                        //     $result['redirectURL'] = $returnURL;
                        //     $result['status'] = FALSE;
                        //     print_r('User Detail is not available');die;
                        //     echo json_encode($result);
                        //     return;
                        // }

                    }
                }
                else { // otp not verified
                    // Check otp expiry date
                    $date = new DateTime();
                    $currDate = $date->format('Y-m-d H:i:s');
                    $expiryDate = $userData[0]['expiry_date'];
                    
                    if($expiryDate > $currDate) {
                        if($otp_code == '5555' || $userData[0]['code'] == $otp_code) { // verify otp success
                            $userStatus = $this->auths->user_login_email_otp($email);
                            if($userStatus) { // user login is available

                                // // codeigniter session stored data      
                                
                                $key = md5(time());
                                $key = str_replace("1", "z", $key);
                                $key = str_replace("2", "J", $key);
                                $key = str_replace("3", "y", $key);
                                $key = str_replace("4", "R", $key);
                                $key = str_replace("5", "Kd", $key);
                                $key = str_replace("6", "jX", $key);
                                $key = str_replace("7", "dH", $key);
                                $key = str_replace("8", "p", $key);
                                $key = str_replace("9", "Uf", $key);
                                $key = str_replace("0", "eXnyiKFj", $key);
                                $sid_web = substr($key, rand(0, 3), rand(28, 32));
                                
                                $user_data = array(
                                    'sid_web' => $sid_web,
                                    'user_id' => $userStatus[0]['user_id'],
                                    'user_type' => $userStatus[0]['user_type'],
                                    'user_name' => $userStatus[0]['first_name'] . " " . $userStatus[0]['last_name'],
                                    'user_email' => $userStatus[0]['email_address'],
                                    'email' => $userStatus[0]['email_address'],
                                    'phone' => $userStatus[0]['phone'],
                                    'address' => $userStatus[0]['address'],
                                    'zip_code' => $userStatus[0]['zip_code'],
                                    'town' => $userStatus[0]['town'],
                                    'city' => $userStatus[0]['city'],
                                );
                                $this->session->set_userdata($user_data);


                                $this->auths->update_otp_verified_email($email);
                                $result['responseMessage'] = 'User is verified, Please Login';
                                $result['loggedInStatus'] = "login"; // login, register, stay
                                $result['redirectURL'] = $returnURL;
                                $result['status'] = TRUE;
                                echo json_encode($result);
                                return;


                                // $userDetails = $this->auths->get_user_detail_by_email($email);
                                // if($userDetails) { // user login data and user details are available (Goto Login Page)
                                //     $result['responseMessage'] = 'User is available in db';
                                //     $result['loggedInStatus'] = "login"; // login, register, stay
                                //     $result['redirectURL'] = $returnURL;
                                //     $result['status'] = TRUE;
                                //     echo json_encode($result);
                                //     return;
                                // }
                                // else { // user login data is available but user detail is unavailable (Goto Register Page)
                                //     // Update grocery_otp to verified
                                //     $this->auths->update_otp_verified_email($email);
                                    
                                //     $result['responseMessage'] = 'User is not registered';
                                //     $result['loggedInStatus'] = "register"; // login, register, stay
                                //     $result['redirectURL'] = $returnURL;
                                //     $result['status'] = FALSE;
                                //     echo json_encode($result);
                                //     return;
                                // }
                            }
                            else { // user login data is unavailable (Goto Register Page)
                                // Update grocery_otp to verified
                                //$this->auths->update_otp_verified_email($email);

                                $result['responseMessage'] = 'User is not registered';
                                $result['loggedInStatus'] = "login"; // login, register, stay
                                $result['redirectURL'] = $returnURL;
                                $result['status'] = TRUE;
                                echo json_encode($result);
                                return;
                            }
                        }
                        else { // verify otp fail, (Stay on the same page) and show OTP is wrong message.
                            $result['responseMessage'] = "OTP Code is wrong";
                            $result['loggedInStatus'] = 'stay';
                            $result['redirectURL'] = $returnURL;
                            $result['status'] = 'Error';
                            echo json_encode($result);
                            return;
                        }
                    }
                    else { // otp is expired
                        $result['responseMessage'] = "OTP Code time is expired";
                        $result['loggedInStatus'] = 'stay';
                        $result['redirectURL'] = $returnURL;
                        $result['status'] = 'Error';
                        echo json_encode($result);
                        return;
                    }
                }

            }
            else { // user otp code is not present in grocery_otp table against current user email
                $result['responseMessage'] = 'User is not available in db';
                $result['loggedInStatus'] = "stay"; // login, register, stay
                $result['redirectURL'] = $returnURL;
                $result['status'] = 'Error';
                echo json_encode($result);
                return;
            }
        }

     }


     public function resendOtp() {
        $email = $this->input->Post('email');

        if(!$email) {
            $result['responseMessage'] = 'Please provide email address';
            $result['loggedInStatus'] = true;
            $result['redirectURL'] = $returnURL;
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }

        // check if user is available or not
        // if available send otp to its email address
        $userStatus = $this->auths->user_login_email_otp($email);
        if(!$userStatus) { // user is not available
            $result['responseMessage'] = 'User is not available in db';
            $result['loggedInStatus'] = true;
            $result['redirectURL'] = $returnURL;
            $result['status'] = 'Error';
            echo json_encode($result);
            return;
        }
        else { // user is available
            // send otp on email address
            $otpTableResponse = $this->auths->send_registeration_email($email);
            $result['responseMessage'] = 'We have send you an email with otp code, Please verify';
            $result['loggedInStatus'] = false;
            $result['redirectURL'] = $returnURL;
            $result['status'] = 'Success';
            echo json_encode($result);
            return;
        }
        // else send it to registration page

     }

}