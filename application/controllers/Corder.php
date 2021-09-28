<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Corder extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('lorder');
        $this->load->model('Orders');
    }

    //Default loading for order system.
    public function index() {
        //print_r("expression");die;
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        //$content = $this->lorder->view_orders();
        //print_r($_SERVER['QUERY_STRING']);
        $paginationConfig = $this->Orders->get_pagination_config('Corder/index');
        $this->pagination->initialize($paginationConfig);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        $content = $this->lorder->view_orders($links, $paginationConfig["per_page"], $page, "order/orders","Manage Orders");


        $this->template->full_admin_html_view($content);
    }

    //Checkout formm
    public function checkout() {
        $this->auth->check_auth();
        if(empty($_SERVER["HTTP_REFERER"]) || !strpos($_SERVER["HTTP_REFERER"], "/checkout_form"))
            redirect(base_url());
        
        $addressId = $this->input->post("ad");
        $deliveryTime = $this->input->post("dt");
        $addressText = $this->input->post("dtt");
        if(!is_numeric($addressId) || empty($deliveryTime) || empty($addressText))
            redirect(base_url("Corder/checkout_form"));
        
        $parts = explode("__" , $deliveryTime);
        $dt = date('Y-m-d', strtotime($parts[0]));
        $t1 = date('h:i a', strtotime($parts[0]));
        $t2 = date('h:i a', strtotime($parts[1]));
        $this->session->set_userdata(
            array(
                'addressId' => $addressId,
                'addressText' => $addressText,
                'deliveryTime' => $deliveryTime,
                'userDeliveryTime' =>  $t1 . " - " . $t2,
                'userDeliveryDate' => $dt,
                'paymentMode' => 'Debit/Credit Card'
            ));

        if(empty($this->input->post('order'))){
            $this->session->set_userdata(array('error_message' => 'Missing Order Detail'));
            redirect(base_url('Corder/checkout_form'));
        }
        $result = $this->lorder->place_order();
        
        if (is_numeric($result)) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            $this->session->set_userdata("orderId", $result);
            $content = $this->lorder->checkout_form($result);
            $this->template->full_html_view($content);
        } else {
            $this->session->set_userdata(array('error_message' => $result));
            redirect(base_url('Corder/checkout_form'));
        }







        // $content = $this->lorder->checkout_form();
        // $this->template->full_html_view($content);
    }

    //Proceed to checkout
    public function proceed_to_checkout(){
        $retString = "?ret_url=".base_url('Corder/checkout');
        $this->auth->check_auth(base_url('Dashboard/user_authentication'.$retString));
        $this->session->set_userdata(array('deliveryTime' => $this->input->post('delivery_date')));
        $this->session->set_userdata(array('deliveryTimeFrom' => $this->input->post('delivery_date_from')));
        $this->session->set_userdata(array('deliveryTimeTo' => $this->input->post('delivery_date_to')));
        if(empty($this->input->post('order'))){
            $this->session->set_userdata(array('error_message' => 'Missing Order Detail'));
            echo 'Corder/checkout';
        }
		$current_baskit = json_decode($this->input->post('order'));
        $result = $this->lorder->place_order();
        if (is_numeric($result)) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            //$content = $this->lorder->proceed_to_checkout($result);
            //$this->template->full_html_view($content);

            $username = $this->session->userdata("user_name");
            $to_email = $this->session->userdata("email");
            $order_id = $this->session->userdata("order_id");
            $OV = $this->session->userdata('OV');
            $delivery_charges = $this->session->userdata('deliveryCharges');
            $delivery_price = $this->session->userdata('discountedPrice');
            $total_amount = (($OV + $delivery_charges) - $delivery_price);
            $from = "admin@9oclockshop.co.uk";
            $subject = "9oClock - Order placed";
			
			
			$year = date('Y');
		  $purchased_items = '';
	   	  foreach ($current_baskit as $key => $eachProd) {
            $final_item_price = ($eachProd->price * $eachProd->quantity);
		    $purchased_items .= '<tr><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;" align="left" width="75%">'. $eachProd->pName .'</td><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;" align="left" width="25%">£'. $final_item_price .'</td></tr>';
	       }			
			
			//---------------------------------------------------------------
	   
	   $message = '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td style="background-color: #eeeeee;" align="center" bgcolor="#eeeeee"><table style="max-width: 600px; height: 600px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"><tbody><tr style="height: 535px;"><td style="padding: 35px 35px 20px; background-color: #ffffff; height: 535px;" align="center" bgcolor="#ffffff"><table style="max-width: 600px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;" align="center"><img style="display: block; border: 0px;" src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" /><br /><h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">Thank You For Your Order!</h2></td></tr><tr><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;" align="center"><p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">Below is the detail of purchased items with grand total</p></td></tr><tr><td style="padding-top: 20px;" align="left"><table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;" align="left" bgcolor="#eeeeee" width="75%">Order Id #</td><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;" align="left" bgcolor="#eeeeee" width="25%">' . $order_id . '</td>'. $purchased_items .'</tbody></table></td></tr><tr><td style="padding-top: 20px;" align="left"><table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;" align="left" width="75%">GRAND TOTAL</td><td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;" align="left" width="25%">£' . $total_amount . '</td></tr></tbody></table></td></tr></tbody></table></td></tbody></table></td></tr></tbody></table><br/><br/><h3>Shipping Address:</h3>'.$_SESSION["address"].'<br/>'.$_SESSION["town"].'<br/>'.$_SESSION["city"].'<br/>'.$_SESSION["zip_code"].'<br/><br/><p style="align=center;">Contact@9oclockshop.co.uk</p><p style="align=center;">9oClock Shop ® '. $year .'</p>';
	   
	   //---------------------------------------------------------------			
			
            $headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: ' . '<' . $from .'>' . "\r\n";


            mail($to_email, $subject, $message, $headers);
            echo 'PaymentIntegration/index';
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Exists'));
            echo 'Corder/checkout';
        }
    }
    //User order form
    public function my_order() {
        $this->auth->check_auth();
        $content = $this->lorder->order_list();
        $this->template->full_html_view($content);
    }
    //order Update Form
    public function order_detail_form($orderId = null) {
        if(empty($orderId)){
            $this->output->set_header("Location: " . base_url() . 'dashboard', TRUE, 302);
            return;
        }
        $this->auth->check_auth();
        $customerId = $this->Orders->get_order_customer($orderId);
        if(!$this->auth->authenticated_user_or_admin($customerId)){
            $this->session->set_userdata(array('error_message' => 'Not Found'));
            $this->output->set_header("Location: " . base_url("Corder/track_order_form"), TRUE, 302);
            return;
        }
        $content = $this->lorder->order_edit_data($orderId);
        $this->template->full_html_view($content);
    }

    public function admin_order_detail_form($orderId = null) {
        if(empty($orderId))
            $this->output->set_header("Location: " . base_url() . 'dashboard', TRUE, 302);
        $this->auth->check_admin_auth();
        $customerId = $this->Orders->get_order_customer($orderId);
        if(!$this->auth->authenticated_user_or_admin($customerId)){
            $this->session->set_userdata(array('error_message' => 'Not Found'));
            $this->output->set_header("Location: " . base_url("Corder"), TRUE, 302);
        }
        $content = $this->lorder->admin_order_edit_data($orderId);
        $this->template->full_admin_html_view($content);
    }

    // order delete
    public function order_delete() {
        $this->auth->check_auth();
        $orderId = $_POST['OrderId'];
        $this->Orders->soft_delete_by_key('OrderId', $orderId);
        return true;
    }

    public function track_order_form(){
        $this->auth->check_auth();
        $content = $this->lorder->track_order_form();
        $this->template->full_html_view($content);
    }
    public function order_traking(){
        $orderId = $this->input->post('OrderId');
        if(empty($orderId))
            $orderId = null;
        redirect(base_url('Corder/order_detail_form/'.$orderId));
    }
    public function checkout_form(){
        $this->auth->check_auth();
        $content = $this->lorder->checkout_detail_form();
        $this->template->full_html_view($content);
    }
     public function cart_page(){
        // $this->auth->check_auth();
        $content = $this->lorder->cart_page();
        $this->template->full_html_view($content);
    }
    public function update_traking(){
        if(!$this->session->userdata('sid_web') || !$this->session->userdata('user_type') == 1 || empty($this->input->post('orderId')) || empty($this->input->post('OrderStep'))){
            $data['status'] = 0;
            $data['message'] = 'You are not authorized';
            print_r(json_encode($data));
            exit();
        }
        $updateResult = $this->Orders->update_order_status($this->input->post('orderId'), $this->input->post('OrderStep'));
        if(!is_string($updateResult) && $updateResult){
            $data['status'] = 1;
            $data['message'] = 'Order Tracking Updated';
            print_r(json_encode($data));
            exit();   
        }
        else if(is_string($updateResult)){
            $data['status'] = 0;
            $data['message'] = $updateResult;
            print_r(json_encode($data));
            exit();
        }
    }

    public function place_order() {

    }

}
