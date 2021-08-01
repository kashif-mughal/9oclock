<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auths extends CI_Model {
    public function __construct() {
        parent::__construct('Auth');
    }

    // ======================================================================================
    // =============================== GET FUNCTIONS ========================================
    // ======================================================================================

    // Get user from user_login table by email and password
    public function user_login($username, $password) {
        // $this->db->where('username', $email);
     //    $this->db->where('password', md5($password));
     //    $this->db->where('status', 1);
     //    $query = $this->db->get('user_login');

     //    return $query;

        $CI = & get_instance();
        $CI->load->model('Users');
        $check_user_login = $CI->Users->check_valid_user($username, $password);

        if($check_user_login) {
            return $this->auth->login($username, $password);
        }
        else {
            return false;
        }

    }
    // Login user by phone_number
     public function user_login_phone($phone_number) {
        $CI = & get_instance();
        $CI->load->model('Users');
        $check_user_login = $CI->Users->check_valid_user_phone($phone_number);

        if($check_user_login) {
            return $this->auth->login_phone($phone_number);
        }
        else {
            return false;
        }
    }

    // Login user by Email Address
    public function user_login_email($email_address, $password, $isRegister = false) {
        $CI = & get_instance();
        $CI->load->library('auth');
        $check_user_login = $CI->auth->login_email($email_address, $password, $isRegister);

        if($check_user_login) {
            return $check_user_login;
        }
        return false;
    }

    // Login user by Email Address
    public function user_login_email_otp($email_address) {
        $CI = & get_instance();
        $CI->load->model('Users');
        $check_user_login = $CI->Users->check_valid_user_email_otp($email_address);

        if($check_user_login) {
            return $check_user_login;
        }
        return false;
    }

    // Get user from user_login table by user id
    public function get_user_by_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 1);
        $query = $this->db->get('users');

        return $query;
    }

    public function get_user_detail($user_id) {
        $this->db->select('a.*,b.*');
        $this->db->from('user_login a');
        $this->db->join('users b', 'b.user_id = a.user_id');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_user_detail_by_phone($phone_number) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('phone', $phone_number);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_user_detail_by_email($email_address) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email_address);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_otp_by_phone_number($phone_number) {
        $this->db->where('phone_number', $phone_number);
        $this->db->order_by('otp_id', 'DESC');
        $query = $this->db->get('grocery_otp');

        return $query;
    }

    public function get_otp_by_email_address($email_address) {
        $this->db->where('email_address', $email_address);
        $this->db->order_by('otp_id', 'DESC');
        $query = $this->db->get('grocery_otp');

        return $query;
    }

    // Get OTP Data by User Id
    public function get_otp_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('grocery_otp');

        return $query;
    }

    public function get_user_by_email($email) {
        $this->db->where('username', $email);
        $query = $this->db->get('users');

        return $query;
    }

    // ======================================================================================
    // =============================== GET FUNCTIONS ========================================
    // ======================================================================================

    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

    // ======================================================================================
    // =============================== UPDATE FUNCTIONS =====================================
    // ======================================================================================

    public function update_user_login($user_id, $email, $password) {
        $this->db->where('user_id', $user_id);
        $this->db->set('username',$email);
        $this->db->set('password',md5($password));
        $this->db->update('user_login');
        return TRUE;
    }

    public function update_user($user_id, $first_name, $last_name, $email, $city, $country, $address, $address_details) {
        $this->db->where('user_id', $user_id);
        $this->db->set('first_name',$first_name);
        $this->db->set('last_name',$last_name);
        $this->db->set('email', $email);
        $this->db->set('city', $city);
        $this->db->set('country', $country);
        $this->db->set('address', $address);
        $this->db->set('address_details', $address_details);
        $this->db->update('users');
        return TRUE;
    }

    public function update_otp_code($fourRandomDigit, $formatDate, $phone_number) {
        $otp_data = array(
            'code' => $fourRandomDigit,
            'expiry_date' => $formatDate
        );
        $this->db->where('phone_number', $phone_number);
        $this->db->update('grocery_otp', $otp_data);
    }

    public function update_otp_verified($user_id) {
        $data = array(
            'verified' => 1
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('grocery_otp', $data);

        return TRUE;
    }

    public function update_otp_verified_phone($phone_number) {
        // Current Date
        $dateTime = new DateTime();
        $currDate = $dateTime->format('Y-m-d H:i:s');
        $data = array(
            'verified' => 1,
            'verified_on' => $currDate
        );
        $this->db->where('phone_number', $phone_number);
        $this->db->update('grocery_otp', $data);
        return TRUE;
    }

    public function update_otp_verified_email($email_address) {
        // Current Date
        $dateTime = new DateTime();
        $currDate = $dateTime->format('Y-m-d H:i:s');
        $data = array(
            'verified' => 1,
            'verified_on' => $currDate
        );
        $this->db->where('email_address', $email_address);
        $this->db->update('grocery_otp', $data);
        return TRUE;
    }

    public function phone_registered($phone_number) {
        $this->db->where('phone_number', $phone_number);
        $db_phone = $this->db->get('grocery_otp');

        return $db_phone;
    }

    // ======================================================================================
    // =============================== UPDATE FUNCTIONS =====================================
    // ======================================================================================

    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

    // ================================================================================
    // ======================= INSERT DATA ============================================
    // ================================================================================

    public function insert_user_login($user_id) {
        $user_login_data = array(
            'user_id' => $user_id,
            'user_type' => 1,
            'status' => 1
        );
        $r = $this->db->insert('user_login', $user_login_data);
        return TRUE;
    }

    public function insert_user_login_email($user_id, $email, $password) {
        $user_login_data = array(
            'user_id' => $user_id,
            'user_type' => 1,
            'status' => 1,
            'username' => $email,
            'password' => md5($password)
        );
        $r = $this->db->insert('user_login', $user_login_data);
        return TRUE;
    }

    public function insert_user_email($user_id, $first_name, $last_name, $email, $phone, $address, $zip_code, $town, $city) {
        $user_data = array(
            'user_id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => str_replace("-", "", $phone),
            'email' => $email,
            'address' => $address,
            'status' => 1,
            'AddressId' => 0,
            'address_details' => ''
        );
        $this->db->insert('users', $user_data);

        $user_address = array(
            'Address' => $address,
            'zip_code' => $zip_code,
            'town' => $town,
            'city' => $city,
            'UserId' => $user_id,
            'Status' => 1
        );
        $this->db->insert('grocery_user_address', $user_address);
    }

    public function insert_user($user_id, $phone_number) {
        $user_data = array(
            'user_id' => $user_id,
            'phone' => $phone_number,
            'status' => 1
        );
        $this->db->insert('users', $user_data);
    }

    // public function insert_user_email($user_id, $email_address) {
    //     $user_data = array(
    //         'user_id' => $user_id,
    //         'phone' => $email_address,
    //         'status' => 1
    //     );
    //     $this->db->insert('users', $user_data);
    // }

    public function insert_otp_data($phone_number, $fourRandomDigit, $formatDate) {
        $otp_data = array(
            'phone_number' => $phone_number,
            'code' => $fourRandomDigit,
            'expiry_date' => $formatDate,
            'verified' => 0
        );
        $this->db->insert('grocery_otp', $otp_data);
        $message = "Your OTP Code is ". $fourRandomDigit;
        // print_r($phone_number);die;
        $messageStatus = $this->sendmessage($phone_number, $message);
        return TRUE;

    }


    public function insert_otp_data_email($to_email, $fourRandomDigit, $formatDate) {
        // $otp_data = array(
        //     'phone_number' => $phone_number,
        //     'code' => $fourRandomDigit,
        //     'expiry_date' => $formatDate,
        //     'verified' => 0
        // );
        // $this->db->insert('grocery_otp', $otp_data);
        // $message = "Your OTP Code is ". $fourRandomDigit;
        // // print_r($phone_number);die;
        // $messageStatus = $this->sendmessage($phone_number, $message);
        // return TRUE;


        // By Email Address
        $otp_data = array(
            'email_address' => $to_email,
            'code' => $fourRandomDigit,
            'expiry_date' => $formatDate,
            'verified' => 0
        );

        $this->db->insert('grocery_otp', $otp_data);
        $message = "Your OTP is " . $fourRandomDigit;
        //$messageStatus = $this->sendemail($to_email, $message);
        return $message;

    }

    public function is_email_exist($email_address) {
        $this->db->where('username', $email_address);
        $db_email = $this->db->get('user_login');

        if($db_email->num_rows() > 0) {
            return $db_email->result_array();
        }
        return false;
    }

    public function is_otp_verified($email_address) {
        $this->db->where('email_address', $email_address);
        $db_email = $this->db->get('grocery_otp');

        if($db_email->num_rows() > 0) {
            return $db_email->result_array();
        }
        return false;
    }

    public function check_user_detail($email_address) {
        $this->db->where('email', $email_address);
        $db_email = $this->db->get('users');

        if($db_email->num_rows() > 0) {
            return $db_email->result_array();
        }
        return false;
    }

    // ================================================================================
    // ======================= INSERT DATA ============================================
    // ================================================================================

    // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

    // ================================================================================
    // ======================= PRIVATE FUNCTIONS ======================================
    // ================================================================================
    // ****** GET COUNTRY *******
    public function get_country() {
        $country_Query = $this->db->query("SELECT * FROM grocery_places WHERE level = 0");
        if($country_Query->num_rows() > 0) {
           return $country_Query->result_array();
        }
        return False;
    }
    // ****** GET CITY ******
    public function get_city() {
        $city_Query = $this->db->query("SELECT * FROM grocery_places WHERE level = 1");
        if($city_Query->num_rows() > 0) {
            return $city_Query->result_array();
        }
        return False;
    }
    // ****** SEND SMS *******
    public function sendmessage($to_phone_number, $message) {
        // JSON response Example ======================================
        // $data['phone'] = $to_phone_number;
        // $data['message'] = $to_message; //need to assign event here
        // $response['responsedata'] = $data;

        // echo json_encode($response);
        // JSON response Example Ends ======================================

        if($to_phone_number && $message) {
            $From = "923018582392"; ///Your Username
            $password = "Master@1"; ///Your Password
            $To = $to_phone_number; ///Recepient Mobile Number
            $sender = "9o'Clock";
            // $code = $otp_code;

            // sending sms
            // $message = "Your OTP Code is ". $code;
            $post = "sender=".urlencode($sender)."&mobile=".urlencode($To)."&message=".urlencode($message)."";
            $url = "https://sendpk.com/api/sms.php?username=$From&password=$password";
            $ch = curl_init();
            $timeout = 30; // set to zero for no timeout
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

            $result['response'] = curl_exec($ch);
            $result['status'] = 'Success';
            /*Print Responce*/
            return json_encode($result);
        }
        else {
            $result['status'] = 'Failed';
            return json_encode($result);
        }
    }

    // ================================================================================
    // ======================= PRIVATE FUNCTIONS ======================================
    // ================================================================================



    //=================================================================================
    //===================== SEND EMAIL WITH OTP =======================================
    //=================================================================================

    public function sendemail($to_email, $otp_code) {
        // $this->load->library('email');
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'ssl://smtp.gmail.com';
        // $config['smtp_port'] = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user'] = 'mumtaz.alam.home@gmail.com';
        // $config['smtp_pass'] = 'Foosball@1';
        // $config['charset'] = 'utf-8';
        // $config['newline'] = '\r\n';
        // $config['mailtype'] = 'text';
        // $config['validation'] = TRUE;

        // $this->email->initialize($config);


        // $this->email->from('mumtaz.alam.home@gmail.com', '9oClock Admin');
        // $this->email->to($to_email);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');

        // $this->email->subject('9oClock - User Email Verification');
        // $this->email->message('Hi User, </br></br>This is your 4 digit OTP to verify your acccount, Please enter in the application to register yourself.</br></br>OTP Code: ' . $otp_code);


        $from = "admin@9oclockshop.co.uk";
        $subject = "9oClock - User Email Verification";
        $message = "Hi User, </br></br>This is your 4 digit OTP to verify your acccount, Please enter in the application to register yourself.</br></br>OTP Code: " . $otp_code;
        $headers = "From : " . $from;

        mail($to_email, $subject, $message, $headers);


        // print_r($this->email->send());die;
        //return $this->email->send();
    }

    public function sendemailgeneral($to_email, $body) {
        $from = "admin@9oclockshop.co.uk";
        $subject = "9oClock - User Email Verification";
        $message = $body;

        mail($to_email, $subject, $message, $headers);


        // print_r($this->email->send());die;
        //return $this->email->send();
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
        $futureDate = $currentDate+(400);
        $formatDate = date("Y-m-d H:i:s", $futureDate);
        // print_r($currentDate . "||");
        // print_r($formatDate);die;

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
}
