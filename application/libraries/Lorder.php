<?php
require_once 'vendor/autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\ServiceBus\Models\BrokeredMessage;
use WindowsAzure\ServiceBus\Models\ReceiveMessageOptions;

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


    public function SendOrderToEPOS($orderId){
        $CI = & get_instance();
        $CI->load->model('Orders');
        $orderData = $CI->Orders->OrderData($orderId);
        //echo '<pre>'; print_r($orderData);die;
        if($orderData){
            $singleOrder = $orderData[0];
            $orderPayload = Array();
            $orderArr = Array();
            $orderArr["table"] = "tblOrder";
            $orderArr["source"] = "oms";
            $orderArr["OMSCustomerId"] = 1;
            $orderArr["mode"] = "insert";
            $orderArr["data"] = array(
                "OrderStatus" => 'Pending',
                "ShippingType" => 0,
                "CustomerId" => 1,//because there isn't any customer on EPOS
                "GrossTotal" => $singleOrder["OrderValue"],
                "Discount" => $singleOrder["CopunDiscount"],
                "DeliveryFee" => $singleOrder["DeliveryCharges"],
                "Tax" => 0,
                "NetDueTotal" => $singleOrder["OrderValue"] - $singleOrder["CopunDiscount"] + $singleOrder["DeliveryCharges"],
                "Change" => 0,
                "OrderDateTime" => $singleOrder["CreatedOn"],
                "CompanyId" => $singleOrder["CompanyId"],
                "OutletId" => $singleOrder["OutletId"],
                "TillId" => 1,
                "OrderSource" => 'OMS',
                "CreatedOn" => $singleOrder["CreatedOn"],
                "PaymentModeId" => 1,
                "PaymentStatus" => 1,
                "Id" => $singleOrder["GUID"]
            );
            array_push($orderPayload, $orderArr);


            $orderDelivery = Array();
            $orderDelivery["table"] = "tblOrderDelivery";
            $orderDelivery["source"] = "oms";
            $orderDelivery["mode"] = "insert";
            $orderDelivery["data"] = array(
                "OrderId" => $singleOrder["GUID"],
                "FirstName" => $singleOrder["first_name"],
                "LastName" => $singleOrder["last_name"],
                "Email" => $singleOrder["email"],
                "MobileNo" => $singleOrder["phone"],
                "PhoneNo" => $singleOrder["phone"],
                "BuildingNo" => $singleOrder["building_no"],
                "StreetNo" => $singleOrder["street_no"],
                "FloorNo" => $singleOrder["floor_no"],
                "Area" => $singleOrder["area"],
                "PostCode" => $singleOrder["postal_code"],
                "City" => $singleOrder["city"],
                "AdditionalDeliveryInstruction" => '',
                "DeliveryDate" => date("Y-m-d", strtotime($singleOrder["CreatedOn"])),
                "DeliveryTime" => date("H:i:s", strtotime($singleOrder["CreatedOn"])),
                "SpecialInstruction" => '',
                "PaymentTransactionID" => ''
            );
            array_push($orderPayload, $orderDelivery);


            $orderDetail = Array();
            $orderDetail["table"] = "tblOrderDetail";
            $orderDetail["source"] = "oms";
            $orderDetail["mode"] = "insert";
            $orderDetail["data"] = array();

            for ($i=0; $i < count($orderData); $i++) { 
                array_push($orderDetail["data"],
                    array(
                        "OrderId" => $orderData[$i]["GUID"],
                        "ItemId" => $orderData[$i]["ItemId"],
                        "ItemCategoryId" => $orderData[$i]["Category"],
                        "UnitPrice" => $orderData[$i]["SoldPrice"],
                        "ItemQuantity" => $orderData[$i]["ItemQuantity"],
                        "DiscountPerItem" => $orderData[$i]["Discount"],
                        "ItemTotalAmount" => $orderData[$i]["ItemQuantity"] * $orderData[$i]["SoldPrice"],
                        "IsSentToKitchen" => 0,
                        "IsDoneByKitchen" => 0,
                        "ItemTax" => 0,
                        "CompanyId" => $orderData[$i]["CompanyId"],
                        "OutletId" => $orderData[$i]["OutletId"],
                        "SpecialInstruction" => ''
                    )
                );
            }


            array_push($orderPayload, $orderDetail);
            return $this->SendToEposAndLog(json_encode($orderPayload), $CI);
        }
        else{
            return false;
        }
    }

    private function SendToEposAndLog($data, $CI){
        $connectionString = "Endpoint=https://nineoclockshop.servicebus.windows.net/;SharedAccessKeyName=NineOClockShopPolicy;SharedAccessKey=lgx/TOJJJbEqzz6hUF0w6nHvspa6ZG2EW4veIuP49Vw=;";
        $serviceBusRestProxy = ServicesBuilder::getInstance()->createServiceBusService($connectionString);
        $currentExceptionMessage = '';
        $success = false;
        try{
            $message = new BrokeredMessage();
            $message->setBody($data);
            $serviceBusRestProxy->sendQueueMessage("omstoepos", $message);
            $success = true;
        }
        catch(Exception $ex){
            $currentExceptionMessage = $ex->getMessage();
        }
        $CI->Orders->LogServiceBusConsumption("tblOrder", $currentExceptionMessage, '', $data, 'sn');
        return $success;
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
            'deliveryCharges' => $CI->SiteSettings->customSelect("delivery_charges")[0]["delivery_charges"]
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
        $deliveryTime = $CI->session->userdata("deliveryTime");
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
        $deliveryCharges = $OV < 50 ? $CI->SiteSettings->customSelect("delivery_charges")[0]["delivery_charges"] : 0;

        $copunDiscount = 0;

        $copunId = $CI->session->userdata("copunId");
        $copunDiscount = $this->apply_copun($OV);
        $data = array(
            'CustomerId' => $CI->session->userdata('user_id'),
            'GUID' => $this->GUIDv4(),
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

    function GUIDv4 ($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace.
                  substr($charid,  0,  8).$hyphen.
                  substr($charid,  8,  4).$hyphen.
                  substr($charid, 12,  4).$hyphen.
                  substr($charid, 16,  4).$hyphen.
                  substr($charid, 20, 12).
                  $rbrace;
        return $guidv4;
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