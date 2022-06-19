<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Model {

    public function __construct() {
        parent::__construct('users');
    }
    private $tableName = 'users';
    // private $tableName = 'users';
    function check_valid_user($username, $password) {
        // $password = md5("gef" . $password);
        $this->db->where(array('username' => $username, 'password' => md5($password), 'status' => 1));
        $query = $this->db->get('user_login');
        $result = $query->result_array();
        if (count($result) == 1) {
            $user_id = $result[0]['user_id'];

            $this->db->select('a.*,b.*');
            $this->db->from('user_login a');
            $this->db->join('users b', 'b.user_id = a.user_id');
            $this->db->join('grocery_user_address ua', 'ua.UserId = a.user_id');
            $this->db->where('a.user_id', $user_id);
            $query = $this->db->get();
            return $query->result_array();
        }
        return false;
    }

    // Validate user using phone number
    function check_valid_user_phone($phone_number) {
        $dateTime = new DateTime();
        $currDate = $dateTime->format('Y-m-d H:i:s');

        $this->db->select('a.*,b.*');
        $this->db->from('grocery_otp a');
        $this->db->join('users b', 'b.phone = a.phone_number');
        $this->db->where('a.phone_number', $phone_number);
        $this->db->where('a.verified', 1);
        $this->db->where('a.expiry_date > ', $currDate);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;        
    }

    // validate user using email address 
    function check_valid_user_email($email_address, $password, $isRegister = false) {
        // $dateTime = new DateTime();
        // $currDate = $dateTime->format('Y-m-d H:i:s');

        $this->db->select('a.*,b.*,ua.*');
        $this->db->from('grocery_otp a');
        $this->db->join('users b', 'b.email = a.email_address');
        $this->db->join('user_login c', 'c.username = a.email_address');
        $this->db->join('grocery_user_address ua', 'ua.UserId = c.user_id');
        $this->db->where('a.email_address', $email_address);
        $this->db->where('c.password', md5($password));
        $this->db->where('c.status', 1);
        if($isRegister == false) {
            $this->db->where('a.verified', 1);
        }
        $this->db->order_by('c.uid', 'desc');
        $this->db->limit(1);
        // $this->db->where('a.expiry_date > ', $currDate);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    function check_valid_user_email_otp($email_address) {
        $dateTime = new DateTime();
        $currDate = $dateTime->format('Y-m-d H:i:s');

        $this->db->select('a.*,b.*,ua.*');
        $this->db->from('grocery_otp a');
        $this->db->join('users b', 'b.email = a.email_address');
        $this->db->join('user_login c', 'c.username = a.email_address');
        $this->db->join('grocery_user_address ua', 'ua.UserId = c.user_id');
        $this->db->where('a.email_address', $email_address);
        // $this->db->where('c.password', md5($password));
        $this->db->where('c.status', 1);
        // $this->db->where('a.verified', 1);
        // $this->db->where('a.expiry_date > ', $currDate);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function check_user_login_email($email_address) {
        $this->db->where('username', $email_address);
        $this->db->where('status', 1);
        $this->db->from('user_login');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }



    /*
     * *User registration
     */

    public function user_registration() {
        $birth_day = $this->input->post('birth_day');
        $birth_month = $this->input->post('birth_month');
        $birth_year = $this->input->post('birth_year');
        $dbo = $birth_year . '-' . $birth_month . '-' . $birth_day;

        $data1 = array(
            'user_id' => null,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'gender' => $this->input->post('user_sex'),
            'date_of_birth' => $dbo,
            'status' => 1
        );
        $this->db->insert('users', $data1);
        $insert_id = $this->db->insert_id();
        //Inset user Login table 

        $password = $this->input->post('password');
        $password = md5("ctgs" . $password);

        $data = array(
            'user_id' => 1, //$insert_id ,
            'username' => $this->input->post('username'),
            'password' => $password,
            'user_type' => 2,
            'security_code' => '',
            'status' => 0
        );
        $this->db->insert('user_login', $data);
    }

    public function profile_edit_data() {
        // print_r($this->session);die;
        $user_id = $this->session->userdata('user_id');
        $this->db->select('a.*,b.username');
        $this->db->from('users a');
        $this->db->join('user_login b', 'b.user_id = a.user_id');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $users = $query->result_array();
            $users[0]["Address"] = null;
            $this->db->select('AddressId, Address, zip_code, town, city');
            $this->db->from('grocery_user_address');
            $this->db->where('UserId', $user_id);
            $this->db->where('Status', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $users[0]["Address"] = $query->result_array()[0];
            }
            return $users;
        }else{
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('user_id', $user_id);
            $query2 = $this->db->get();
            if ($query2->num_rows() > 0) {
                return $query->result_array();
            }
            else
                return false;
        }
        return false;
    }

    //Update Profile
    public function profile_update($area = null) {
        $this->load->library('upload');

        if (($_FILES['logo']['name'])) {
            $files = $_FILES;
            $config = array();
            $config['upload_path'] = 'assets/dist/img/profile_picture/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = '1000000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
                $sdata['error_message'] = $this->upload->display_errors();
                $this->session->set_userdata($sdata);
                if(is_null($area))
                    redirect('Admin_dashboard/edit_profile');
                else if($area == 'user')
                    redirect('User/edit_profile');
            } else {
                $view = $this->upload->data();
                $logo = base_url($config['upload_path'] . $view['file_name']);
            }
        }

        $old_logo = $this->input->post('old_logo');

        $user_id = $this->session->userdata('user_id');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $user_name = $this->input->post('user_name');
        $email = $this->input->post('user_email');
        $new_logo = (!empty($logo) ? $logo : $old_logo);

        return $this->db->query("UPDATE `users` AS `a`,`user_login` AS `b` SET `a`.`first_name` = '$first_name', `a`.`email` = '$email', `a`.`last_name` = '$last_name', `b`.`username` = '$user_name',`a`.`logo` = '$new_logo' WHERE `a`.`user_id` = '$user_id' AND `a`.`user_id` = `b`.`user_id`");
    }

    //Change Password
	public function change_password($email, $old_password, $new_password) {
		$newpassword = md5($new_password);
		$password = md5($old_password);
		$this->db->where('username', $email);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$this->db->where(array('username' => $email, 'password' => $password, 'status' => 1));
		$query = $this->db->get('user_login');
		$result = $query->result_array();
		
		if (count($result) === 1) {
			$this->db->set('password', $newpassword);
			$this->db->where('password', $password);
			$this->db->where('username', $email);
			$this->db->where('status', 1);
			$this->db->update('user_login');

			return true;
		}
		return false;
	}

    public function get_user_address($userId = null){
        if(is_null($userId)){
            $userId = $this->session->userdata('user_id');
        }
        $this->db->select("ua.*");
        $this->db->from($this->tableName." u");
        $this->db->join("grocery_user_address ua", "u.user_id = ua.UserId");
        $this->db->where("u.user_id", $userId);
        $this->db->where("u.Status", 1);
        $this->db->where("ua.Status", 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function update_address($addresses){
        $userId = $this->session->userdata('user_id');
        $insertedAddresses = Array();
        for ($i=0; $i < count($addresses); $i++) { 
            $data = array(
                'Address' => $addresses[$i],
                'UserId' => $userId,
                'Status' => 1
            );
            $this->db->insert("grocery_user_address", $data);
            
            array_push($insertedAddresses, $this->db->insert_id());
        }
        return $insertedAddresses;
    }

    public function soft_delete_user_address($addressId){
        $userId = $this->session->userdata('user_id');
        $this->db->select("1");
        $this->db->from("grocery_user_address");
        $this->db->where("UserId", $userId);
        $this->db->where("AddressId", $addressId);
        $this->db->where("Status", 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array(
                'Status' => 0,
            );
            $this->db->where("AddressId", $addressId);
            $this->db->update("grocery_user_address", $data);
            return true;
        }
        return false;
    }

    public function updateUserPassword($email, $password) {
        // $this->db->where('user_id', $user_id);
        $this->db->where('username',$email);
        $this->db->set('password',md5($password));
        $this->db->update('user_login');
        return TRUE;    
    }
}
