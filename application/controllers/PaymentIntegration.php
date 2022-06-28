<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PaymentIntegration extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->template->current_menu = 'payment';
      $this->load->library('lpayment');
      $this->load->model('Payment');
      $this->load->helper('url');
      $this->load->library('lorder');
  }

  public function index() {
   $paymentPass = "0a197fde-907b-476b-9a38-70d24eb820ee"; // Test
   //$paymentPass = 'qjIG61$UAo3A.I)tHsG'; // Production

   $phone_number = $this->session->userdata('phone');
   if(strlen($phone_number) < 5) {
      $phone_number = "";
   }

   $orderId = $this->session->userdata('order_id');
   $phone = $phone_number;
   $zip_code = $this->session->userdata('zip_code');
   $town = $this->session->userdata('town');
   $city = $this->session->userdata('city');
   $address = $this->session->userdata('address');
   $OV = $this->session->userdata('OV');
   $delivery_charges = $this->session->userdata('deliveryCharges');
   $delivery_price = $this->session->userdata('discountedPrice');

   $Final_Amount = (($OV + $delivery_charges) - $delivery_price);

   // Test
   // $barclayCardModel = new stdClass();
   // $barclayCardModel->AMOUNT = ($OV * 100);
   // $barclayCardModel->CURRENCY = "GBP";
   // $barclayCardModel->LANGUAGE = "en_uk";
   // $barclayCardModel->ORDERID = $orderId;
   // $barclayCardModel->PSPID = "Test2A2zgrocery";
   // $barclayCardModel->Email = "enceladus.works@gmail.com";
   // $barclayCardModel->CN = "Enclaudes";
   // $barclayCardModel->OWNERZIP = $zip_code;
   // $barclayCardModel->OWNERADDRESS = $address;
   // $barclayCardModel->OWNERCTY = $city;
   // $barclayCardModel->OWNERTOWN = $town;
   // $barclayCardModel->OWNERTELNO = $phone;

   // Production
   // $barclayCardModel = new stdClass();
   // $barclayCardModel->AMOUNT = ($Final_Amount * 100);
   // $barclayCardModel->CURRENCY = "GBP";
   // $barclayCardModel->LANGUAGE = "en_uk";
   // $barclayCardModel->ORDERID = $orderId;
   // $barclayCardModel->PSPID = "epdq1553511";
   // $barclayCardModel->Email = "adil.aman40@gmail.com";
   // $barclayCardModel->CN = "9 o'clock shop";
   // $barclayCardModel->OWNERZIP = $zip_code;
   // $barclayCardModel->OWNERADDRESS = $address;
   // $barclayCardModel->OWNERCTY = $city;
   // $barclayCardModel->OWNERTOWN = $town;
   // $barclayCardModel->OWNERTELNO = $phone;

   // $flatPaymentData = "AMOUNT=" . $barclayCardModel->Amount . $paymentPass . "CN=" . $barclayCardModel->CN . $paymentPass . "CURRENCY=" . $barclayCardModel->Currency . $paymentPass . "EMAIL=" . $barclayCardModel->Email . $paymentPass . "LANGUAGE=" . $barclayCardModel->Language . $paymentPass . "ORDERID=" . $barclayCardModel->OrderId . $paymentPass . "OWNERZIP=" . $barclayCardModel->OWNERZIP . $paymentPass . "OWNERADDRESS=" . $barclayCardModel->OWNERADDRESS . $paymentPass . "OWNERCTY=" . $barclayCardModel->OWNERCTY . $paymentPass . "OWNERTOWN=" . $barclayCardModel->OWNERTOWN . $paymentPass . "OWNERTELNO=" . $barclayCardModel->OWNERTELNO . $paymentPass . "PSPID=" . $barclayCardModel->Pspid . $paymentPass;

   // Local
   $flatPaymentData = "ACCEPTURL=" . "http://localhost/9oclock/PaymentIntegration/Success" . $paymentPass . "AMOUNT=" . $barclayCardModel->AMOUNT . $paymentPass . "CANCELURL=" . "http://localhost/9oclock/PaymentIntegration/Cancelled" . $paymentPass . "CN=" . $barclayCardModel->CN . $paymentPass ."CURRENCY=" . $barclayCardModel->CURRENCY . $paymentPass . "DECLINEURL=" . "http://localhost/9oclock/PaymentIntegration/Decline" . $paymentPass . "EXCEPTIONURL=" . "http://localhost/9oclock/PaymentIntegration/Cancelled" . $paymentPass . "LANGUAGE=" . $barclayCardModel->LANGUAGE . $paymentPass . "ORDERID=" . $barclayCardModel->ORDERID . $paymentPass . "OWNERADDRESS=" . $barclayCardModel->OWNERADDRESS . $paymentPass ."OWNERCTY=" . $barclayCardModel->OWNERCTY . $paymentPass ."OWNERTELNO=" . $barclayCardModel->OWNERTELNO . $paymentPass ."OWNERTOWN=" . $barclayCardModel->OWNERTOWN . $paymentPass . "OWNERZIP=" . $barclayCardModel->OWNERZIP . $paymentPass . "PSPID=" . $barclayCardModel->PSPID . $paymentPass;

   // Live
   // $flatPaymentData = "ACCEPTURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Success" . $paymentPass . "AMOUNT=" . $barclayCardModel->AMOUNT . $paymentPass . "CANCELURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Cancelled" . $paymentPass . "CN=" . $barclayCardModel->CN . $paymentPass ."CURRENCY=" . $barclayCardModel->CURRENCY . $paymentPass . "DECLINEURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Decline" . $paymentPass . "EXCEPTIONURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Cancelled" . $paymentPass . "LANGUAGE=" . $barclayCardModel->LANGUAGE . $paymentPass . "ORDERID=" . $barclayCardModel->ORDERID . $paymentPass . "OWNERADDRESS=" . $barclayCardModel->OWNERADDRESS . $paymentPass ."OWNERCTY=" . $barclayCardModel->OWNERCTY . $paymentPass ."OWNERTELNO=" . $barclayCardModel->OWNERTELNO . $paymentPass ."OWNERTOWN=" . $barclayCardModel->OWNERTOWN . $paymentPass . "OWNERZIP=" . $barclayCardModel->OWNERZIP . $paymentPass . "PSPID=" . $barclayCardModel->PSPID . $paymentPass;
	

     $data["ShaPass"] = hash("sha1", $flatPaymentData);
     $data["PaymentModel"] = $barclayCardModel;
     $data["flatPaymentData"] = $flatPaymentData;

     $this->load->view("payment/index",$data);
  }


   public function refund() {
      $content = $this->lpayment->refund();
      $this->template->full_html_view($content);
   }

   // Call Refund Process Page 
   public function refundprocess() {
      $post_data = $this->input->post();
      $data["amount"] = ($post_data["refund_amount"] * 100);
      $data["PSPID"] = "Test2A2zgrocery";
      $data["USERID"] = "9oclockshopswindon";
      $data["REFID"] = "PSPID";
      $data["REFKIND"] =  //$post_data["REFKIND"];
      $data["PSWD"] = "testPassword"; //$post_data["PSWD"];
      $data["PAYID"] = "202"; //$post_data["PAYID"];
      $data["orderID"] = "101"; //$post_data["orderID"];
      $data["OPERATION"] = "RFD";
      $data["Ecom_Payment_Card_Verification"] = "411"; //$post_data["Ecom_Payment_Card_Verification"];
      $data["withroot"] = "testroot"; //$post_data["withroot"];
      $data["submit2"] = "Submit";

      $requestData["RefundPaymentModel"] = $data;

     $this->load->view("payment/refundPost",$requestData);
   }
  

  // add column enum in order table paymentStatus
  // 0 - pending
  // 1 - paid
  // 2 - decline

  // testing
// public function testSuccess() {
//    $this->load->view("include/header");
//    $this->load->view("payment/success");
//    $this->load->view("include/footer");
// }

// public function testcancel() {
//    $this->load->view("payment/cancel");
// }
// public function testdecline() {
//    $this->load->view("payment/decline");
// }

// testing



   public function Success() {
      // 1. Get data from response ($_POST or $_GET)

      $url = current_url() . '?' . $_SERVER['QUERY_STRING'];

      $responseData = array(
         'OrderId' =>  $_GET["orderID"], 
         'Currency' => $_GET["currency"],
         'Amount' => $_GET["amount"],
         'Acceptance' => $_GET["ACCEPTANCE"],
         'PaymentType' => $_GET["PM"],
         'StatusCode' => $_GET["STATUS"],
         'CardNo' => $_GET["CARDNO"],
         'ED' => $_GET["ED"],
         'CustomerName' => $_GET["CN"],
         'PayId' => $_GET["PAYID"],
         'NCError' => $_GET["NCERROR"],
         'PaymentBrand' => $_GET["BRAND"],
         'IP' => $_GET["IP"],
         'ShaSign' => $_GET["SHASIGN"],
         'AddedOn' => date("Y-m-d H:i:s"),
         'TransactionDate' => $_GET["TRXDATE"],
         'ResponseData' => $url
     );

   //   // 2. Save response in bankTransLog table
      $this->SaveBankTransRecord($responseData);
      
   //   // 3. Update order payment status 
      $this->lpayment->update_payment_status($responseData);
     
      $username = $this->session->userdata("user_name");
      $to_email = $this->session->userdata("email");
      $from = "admin@9oclockshop.co.uk";
      $subject = "9oClock - Order placed";
      $message = "<br/>Hi ". $username . ",<br/><br/>Your order detail listed below<br/>OrderId: " . $orderId . "<br/>Payable amount: £" . $Final_Amount . ".";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: ' . '<' . $from .'>' . "\r\n";

      mail($to_email, $subject, $message, $headers);
      $this->lorder->SendOrderToEPOS($_GET["orderID"]);

      $content = $this->lpayment->success();
      $this->template->full_html_view($content);
   }
   public function abc($passcode){
      if($passcode == 'SKsdfDSfsdfSDFSDFIRIejweweKkKcnnCNeo'){
         $this->lorder->SendOrderToEPOS($_GET["orderID"]);
         echo 'Order Send Successfully';
      }
      else
         echo "You are not authorized";
   }

   public function Decline() {
      // 1. Get data from response ($_POST or $_GET)
      $url = current_url() . '?' . $_SERVER['QUERY_STRING'];

      $responseDataDecline = array(
         'OrderId' =>  $_GET["orderID"], 
         'Currency' => $_GET["currency"],
         'Amount' => $_GET["amount"],
         'Acceptance' => $_GET["ACCEPTANCE"],
         'PaymentType' => $_GET["PM"],
         'StatusCode' => $_GET["STATUS"],
         'CardNo' => $_GET["CARDNO"],
         'ED' => $_GET["ED"],
         'CustomerName' => $_GET["CN"],
         'PayId' => $_GET["PAYID"],
         'NCError' => $_GET["NCERROR"],
         'PaymentBrand' => $_GET["BRAND"],
         'IP' => $_GET["IP"],
         'ShaSign' => $_GET["SHASIGN"],
         'AddedOn' => date("Y-m-d H:i:s"),
         'TransactionDate' => $_GET["TRXDATE"],
         'ResponseData' => $url
     );

     // 2. Save response in bankTransLog table
     $this->SaveBankTransRecord($responseDataDecline);

      // 3. Update order payment status 
      $this->lpayment->update_payment_status($responseDataDecline);
      
      $content = $this->lpayment->decline();
      $this->template->full_html_view($content);
   }

   public function Cancelled() {
      // 1. Get data from response ($_POST or $_GET)
      $url = current_url() . '?' . $_SERVER['QUERY_STRING'];

      $responseDataCancelled = array(
         'OrderId' =>  $_GET["orderID"], 
         'Currency' => $_GET["currency"],
         'Amount' => $_GET["amount"],
         'Acceptance' => $_GET["ACCEPTANCE"],
         'PaymentType' => $_GET["PM"],
         'StatusCode' => $_GET["STATUS"],
         'CardNo' => $_GET["CARDNO"],
         'ED' => $_GET["ED"],
         'CustomerName' => $_GET["CN"],
         'PayId' => $_GET["PAYID"],
         'NCError' => $_GET["NCERROR"],
         'PaymentBrand' => $_GET["BRAND"],
         'IP' => $_GET["IP"],
         'ShaSign' => $_GET["SHASIGN"],
         'AddedOn' => date("Y-m-d H:i:s"),
         'TransactionDate' => $_GET["TRXDATE"],
         'ResponseData' => $url
     );

     // 2. Save response in bankTransLog table
     $insertionResponse = $this->SaveBankTransRecord($responseDataCancelled);
     
     // 3. Update order payment status 
      $this->lpayment->update_payment_status($responseDataCancelled);

      $content = $this->lpayment->cancelled();
      $this->template->full_html_view($content);
   }

   private function SaveBankTransRecord($responseData) {
      $content = $this->lpayment->save_record($responseData);
      return $content;
   }











}
