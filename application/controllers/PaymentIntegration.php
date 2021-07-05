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
  }

  public function index() {
   //$paymentPass = "d65e846a-c652-4f29-8780-9cdc4d9b8cd7"; // Test
   $paymentPass = 'qjIG61$UAo3A.I)tHsG'; // Production

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
   $barclayCardModel = new stdClass();
   $barclayCardModel->AMOUNT = ($OV * 100);
   $barclayCardModel->CURRENCY = "GBP";
   $barclayCardModel->LANGUAGE = "en_uk";
   $barclayCardModel->ORDERID = $orderId;
   $barclayCardModel->PSPID = "epdq1553511";
   $barclayCardModel->Email = "adil.aman40@gmail.com";
   $barclayCardModel->CN = "9 o'clock shop";
   $barclayCardModel->OWNERZIP = $zip_code;
   $barclayCardModel->OWNERADDRESS = $address;
   $barclayCardModel->OWNERCTY = $city;
   $barclayCardModel->OWNERTOWN = $town;
   $barclayCardModel->OWNERTELNO = $phone;

   // $flatPaymentData = "AMOUNT=" . $barclayCardModel->Amount . $paymentPass . "CN=" . $barclayCardModel->CN . $paymentPass . "CURRENCY=" . $barclayCardModel->Currency . $paymentPass . "EMAIL=" . $barclayCardModel->Email . $paymentPass . "LANGUAGE=" . $barclayCardModel->Language . $paymentPass . "ORDERID=" . $barclayCardModel->OrderId . $paymentPass . "OWNERZIP=" . $barclayCardModel->OWNERZIP . $paymentPass . "OWNERADDRESS=" . $barclayCardModel->OWNERADDRESS . $paymentPass . "OWNERCTY=" . $barclayCardModel->OWNERCTY . $paymentPass . "OWNERTOWN=" . $barclayCardModel->OWNERTOWN . $paymentPass . "OWNERTELNO=" . $barclayCardModel->OWNERTELNO . $paymentPass . "PSPID=" . $barclayCardModel->Pspid . $paymentPass;

   
   $flatPaymentData = "ACCEPTURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Success" . $paymentPass . "AMOUNT=" . $barclayCardModel->AMOUNT . $paymentPass . "CANCELURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Cancelled" . $paymentPass . "CN=" . $barclayCardModel->CN . $paymentPass ."CURRENCY=" . $barclayCardModel->CURRENCY . $paymentPass . "DECLINEURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Decline" . $paymentPass . "EXCEPTIONURL=" . "https://9oclockshop.co.uk/PaymentIntegration/Cancelled" . $paymentPass . "LANGUAGE=" . $barclayCardModel->LANGUAGE . $paymentPass . "ORDERID=" . $barclayCardModel->ORDERID . $paymentPass . "OWNERADDRESS=" . $barclayCardModel->OWNERADDRESS . $paymentPass ."OWNERCTY=" . $barclayCardModel->OWNERCTY . $paymentPass ."OWNERTELNO=" . $barclayCardModel->OWNERTELNO . $paymentPass ."OWNERTOWN=" . $barclayCardModel->OWNERTOWN . $paymentPass . "OWNERZIP=" . $barclayCardModel->OWNERZIP . $paymentPass . "PSPID=" . $barclayCardModel->PSPID . $paymentPass;
	

     $data["ShaPass"] = hash("sha1", $flatPaymentData);
     $data["PaymentModel"] = $barclayCardModel;
     $data["flatPaymentData"] = $flatPaymentData;

     $this->load->view("payment/index",$data);
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
     
      $this->load->view("include/header");
      $this->load->view("payment/success");
      $this->load->view("include/footer");
   }

   public function Decline() {
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

     // 2. Save response in bankTransLog table
     $this->SaveBankTransRecord($responseDataDecline);

      // 3. Update order payment status 
      $this->lpayment->update_payment_status($responseData);
      
      $this->load->view("include/header");
      $this->load->view("payment/decline");
      $this->load->view("include/footer");
   }

   public function Cancelled() {
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

     // 2. Save response in bankTransLog table
     $this->SaveBankTransRecord($responseDataCancelled);
     
     // 3. Update order payment status 
     $this->lpayment->update_payment_status($responseData);
     
     $this->load->view("include/header");
     $this->load->view("payment/cancel");
     $this->load->view("include/footer");
   }

   private function SaveBankTransRecord($responseData) {
      $content = $this->lpayment->save_record($responseData);
   }
}