<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lorder {

    public function index(){}

    //Sub order Add
    public function checkout_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Checkout'
        );
        return $CI->parser->parse('order/checkout', $data, true);
    }
    public function checkout_detail_form() {
        $CI = & get_instance();
        $CI->load->model('Users');
        $CI->load->model('SiteSettings');
        $userAddress = $CI->Users->get_user_address();
        // print_r($userAddress);die;
        $data = array(
            'title' => 'Checkout',
            'userAddress' => $userAddress,
            'deliveryCharges' => $CI->SiteSettings->customSelect("delivery_charges")[0]["delivery_charges"]
        );
        return $CI->parser->parse('order/checkout_form', $data, true);
    }
     public function cart_page() {
        $CI = & get_instance();
        $CI->load->model('Users');
        $CI->load->model('SiteSettings');
        $userAddress = $CI->Users->get_user_address();
            // print_r($userAddress);die;
        $data = array(
            'title' => 'Cart Page',
            'userAddress' => $userAddress,
            // 'deliveryCharges' => $CI->SiteSettings->customSelect("delivery_charges")[0]["delivery_charges"]
        );
        return $CI->parser->parse('order/cart_page', $data, true);
    }
    public function proceed_to_checkout($orderId) {
        $CI = & get_instance();
        $orderData = json_decode($_POST['order']);
        $OV = 0;
        foreach ($orderData as $key => $eachProd) {
            $OV += $eachProd->quantity * $eachProd->price;
            $eachProd->price = number_format($eachProd->price, 2);
            $eachProd->total = number_format($eachProd->price * $eachProd->quantity, 2);
        }
        $data = array(
            'title' => 'Proceed to checkout',
            'orderDetail' => $orderData,
            'userData' => $CI->session->userdata(),
            'orderId' => $orderId,
            'OV' => $OV
        );

        $this->session->set_userdata(array('OV' => $OV));

        //return $data;
        //return $CI->parser->parse('order/proceed_to_checkout', $data, true);
    }
    
    public function place_order(){
        
        $CI = & get_instance();
        $CI->load->model('Orders');
        $CI->load->model('SiteSettings');
        date_default_timezone_set('Europe/London');
        $addressId = $CI->session->userdata("addressId");
        //$deliveryTime = $CI->session->userdata("deliveryTime");
        $addressText = $CI->session->userdata("addressText");
        
        if(!is_numeric($addressId) || empty($addressText))
            redirect(base_url("Corder/checkout_form"));

        $parts = explode("__" , $deliveryTime);
        $deliveryDate = date('Y-m-d', strtotime($parts[0]));
        $dtFrom = date('Y-m-d H:i a', strtotime($parts[0]));
        $dtUpto = date('Y-m-d H:i a', strtotime($parts[1]));

        $orderDetail = json_decode($_POST['order']);
        $OV = 0;
        foreach ($orderDetail as $key => $eachProd) {
            $OV += $eachProd->quantity * $eachProd->price;
        }
        $currentDate = date('Y-m-d');
        $deliveryCharges = $deliveryDate == $currentDate ? $CI->SiteSettings->customSelect("delivery_charges")[0]["delivery_charges"] : 0;

        $copunDiscount = 0;

        $copunId = $CI->session->userdata("copunId");
        $copunDiscount = $this->apply_copun($OV);
        $data = array(
            'CustomerId' => $CI->session->userdata('user_id'),
            'OrderValue' => $OV,
            'Hash' => sha1($_POST['order']),
            'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'DeliveryDate' => $deliveryDate,
            'DeliveryFrom' => $dtFrom,
            'DeliveryUpto' => $dtUpto,
            'DeliveryAddress' => $addressId,
            'deliveryCharges' => $deliveryCharges,
            'Status' => 1,
        );
        if(!empty($copunId) && $copunDiscount != 0){
            $data['CopunId'] = $copunId;
            $data['CopunDiscount'] = $copunDiscount;
        }

        $orderId = $CI->Orders->place_order($data);
        if(is_numeric($orderId)){
            if($this->place_order_details($orderDetail, $orderId, $CI->Orders)){
                $CI->session->set_userdata("order_id", $orderId);
                $CI->session->set_userdata("OV", $OV);
                $CI->session->set_userdata("deliveryCharges", $deliveryCharges);
                $CI->session->set_userdata("discountedPrice", $copunDiscount);
                $this->sendsms((($OV + $deliveryCharges) - $copunDiscount),$orderId);
                return $orderId;
            }else{
                return 'Something went wrong!!';
            }
        }
        else{
            return 'Already Inserted';
        }
    }

    private function sendsms($grantAmount, $orderId) {
        // Get Details against 
        
        $CI = & get_instance();
        $userPhone = $CI->session->userdata('phone');
        $CI->load->model('Web_settings');
        $AdminData = $CI->Web_settings->retrieve_setting_editdata();
        $adminPhone = $AdminData[0]->AdminPhone;

        // Your have successfully placed an order on 9o'Clock.\n
        // Tracking ID: ____\n
        // Amount: ___

        $userMessage = "Your have successfully placed an order on 9o'Clock.\nTracking ID:".$orderId."\nAmount:".$grantAmount;
        $adminMessage = "New order has been placed on 9o'Clock.\nTracking ID:".$orderId."\nAmount:".$grantAmount;

        $CI = & get_instance();
        $CI->load->model('Auths');
        // Send SMS to User
        $CI->Auths->sendmessage($userPhone,$userMessage);
        // Send SMS to Admin
        $CI->Auths->sendmessage($adminPhone,$adminMessage);
    }

    private function apply_copun($OV){
        $CI = & get_instance();
        $CI->load->model('Copuns');
        $copun = $CI->session->userdata("copunName");
        if(empty($copun))
        {
            return 0;
        }else{
            $copun_detail = $CI->Copuns->get_copun($copun);
            if(!$copun_detail){
                return 0;
            }else{
                $copun = $copun_detail[0];
                if($copun['Infinite'] == 0){
                    if($copun['StartFrom'] == '0000-00-00 00:00:00 ' || $copun['EndOn'] == '0000-00-00 00:00:00 '){
                        return 0;
                    }
                    date_default_timezone_set("Asia/Karachi");
                    $start = new DateTime($copun['StartFrom']);
                    $end = new DateTime($copun['EndOn']);
                    $currentDt = new DateTime();
                    if(!($start < $currentDt && $end > $currentDt)){
                        return 0;
                    }
                }
                $minpurchase = empty($copun["MinPurchase"]) ? -1 : $copun["MinPurchase"];
                $this->set_and_reset_copun_in_session($copun, $minpurchase, 0);
                
                if(!($minpurchase != -1 && $V > $minpurchase))
                    return 0;
                if($copun["DiscountType"] == "Amount"){
                    return floatval($copun["DiscountValue"]);
                }else{
                     return (floatval($OV) / 100) * floatval($copun["DiscountValue"]);
                }
            }
        }
    }

    private function set_and_reset_copun_in_session($copun, $minpurchase, $set){
        $CI = & get_instance();
        if($set == 1){
            $CI->session->set_userdata(array('copunId' => $copun['CopunId']));
            $CI->session->set_userdata(array('copunName' => $copun['CopunName']));
            $CI->session->set_userdata(array('copunDiscountType' => $copun['DiscountType']));
            $CI->session->set_userdata(array('copunDiscountValue' => $copun['DiscountValue']));
            $CI->session->set_userdata(array('copunMinPurchase' => $minpurchase));
        }else{
            $CI->session->unset_userdata('copunId');
            $CI->session->unset_userdata('copunName');
            $CI->session->unset_userdata('copunDiscountType');
            $CI->session->unset_userdata('copunDiscountValue');
            $CI->session->unset_userdata('copunMinPurchase');
        }
    }

    private function place_order_details($orderDetail, $orderId, $ordersObj){
        foreach ($orderDetail as $key => $eachProd) {
            $OV += $eachProd->quantity * $eachProd->price;
            $data = array(
                'OrderId' => $orderId,
                'ItemId' => $eachProd->id,
                'ItemQuantity' => $eachProd->quantity,
                'SoldPrice' => $eachProd->price,
                'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                'Status' => 1,
            );
            $ordersObj->place_order_details($data);
        }
        return true;
    }

    public function order_list(){
        $CI = & get_instance();
        $CI->load->model('Orders');
        $orderData = $CI->Orders->retrieve_user_orders();
        
        foreach ($orderData as $key => $value) {
            $productObject = (object) [
                           'id' => $value['ItemId'],
                           'pName' => $value['ProductName'],
                           'price' => $value['Price'],
                           'img' => base_url().$value['ProductImg']
                       ];
            $orderData[$key]['Jsn'] = htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8');
        }
        $orderDetailFormattedArr = Array();
        for ($i=0; $i < count($orderData); $i++) { 
            if(!$orderDetailFormattedArr[$orderData[$i]["OrderId"]])
                $orderDetailFormattedArr[$orderData[$i]["OrderId"]] = Array();
            array_push($orderDetailFormattedArr[$orderData[$i]["OrderId"]], $orderData[$i]);
        }
        $data = array(
            'title' => 'Manage Order',
            'orderData' => $orderDetailFormattedArr
        );
        return $CI->parser->parse('order/order_list', $data, true);
    }

    public function view_orders($links, $perpage, $page, $pageText, $pageTitle){
        $CI = & get_instance();
        $CI->load->model('Orders');
        $orderData = $CI->Orders->retrieve_orders($perpage, $page);
        if (!empty($orderData)) {
            foreach ($orderData as $k => $v) {
                $i++;
                $orderData[$k]['sl'] = $i + $CI->uri->segment(3);
            }
        }
        $data = array(
            'title' => $pageTitle,
            'orderData' => $orderData,
            'links' => $links
        );
        return $CI->parser->parse($pageText, $data, true);
    }

    //order Edit Data
    public function order_edit_data($OrderId) {
        $CI = & get_instance();
        $CI->load->model('Orders');
        $order_detail = $CI->Orders->retrieve_order_editdata($OrderId);
        $data = array(
            'title' => 'Order Edit',
            'OrderData' => $order_detail
        );
        //echo "<pre>";print_r($data);die;
        return $CI->parser->parse('order/edit_order_form', $data, true);
    }

    public function admin_order_edit_data($OrderId) {
        $CI = & get_instance();
        $CI->load->model('Orders');
        $order_detail = $CI->Orders->retrieve_order_editdata($OrderId, true);
        $totalValue = 0;
        foreach ($order_detail['OrderDetail'] as $k => $v) {
                $i++;
                $order_detail['OrderDetail'][$k]['sl'] = $i;
            }
            $order_detail['DeliverySlot'] = date('Y-m-d h:i a', strtotime($order_detail["OrderDetail"][0]["DeliveryFrom"])) . ' <b>to</b> ' . date('Y-m-d h:i a', strtotime($order_detail["OrderDetail"][0]["DeliveryUpto"]));
            $totalValue += floatval($order_detail['OrderDetail'][0]['OrderValue']) + floatval($order_detail['OrderDetail'][0]['deliveryCharges']);
                if(!empty($order_detail['OrderDetail'][0]['CopunDiscount']))
                    $totalValue -= floatval($order_detail['OrderDetail'][0]['CopunDiscount']);
        $data = array(
            'title' => 'Order Edit',
            'OrderData' => $order_detail,
            'OrderId' => $OrderId,
            'TotalValue' => $totalValue
        );
        //echo "<pre>";print_r($data);die;
        return $CI->parser->parse('order/admin_order_detail', $data, true);
    }
    
    //order Traking Form
    public function track_order_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Track your order'
        );
        return $CI->parser->parse('order/order_traking_form', $data, true);
    }

}

?>