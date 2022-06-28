<!-- Production -->
<!-- <form method="POST" action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp"
id="paymentForm" name="paymentForm"> -->


<?php 
function random_strings($length_of_string)
{
   $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   return substr(str_shuffle($str_result), 0, $length_of_string);
}


$refundUrl = "https://mdepayments.epdq.co.uk/ncol/test/maintenancedirect.asp?CSRFSP=/ncol/test/testdm.asp&CSRFKEY=". random_strings(40) ."&CSRFTS=" . date("Ymdhis");
?>

<!-- Test -->
<form method="POST" action="<?php echo $refundUrl; ?>" id="paymentForm" name="paymentForm">

   <!-- general parameters -->
   <input id="PSPID" name="PSPID" value="<?php echo $RefundPaymentModel->PSPID; ?>">
   <input id="USERID" name="USERID" value="<?php echo $RefundPaymentModel->USERID; ?>">
   <input id="REFID" name="REFID" value="<?php echo $RefundPaymentModel->REFID; ?>">
   <input id="REFKIND" name="REFKIND" value="<?php echo $RefundPaymentModel->REFKIND; ?>">
   <input id="PSWD" name="PSWD" value="<?php echo $RefundPaymentModel->PSWD; ?>">
    
   <input id="PAYID" name="PAYID" value="<?php echo $RefundPaymentModel->PAYID; ?>"> 
   <input id="orderID" name="orderID" value="<?php echo $RefundPaymentModel->orderID; ?>">
   <input id="amount" name="amount" value="<?php echo $RefundPaymentModel->amount; ?>">
   <input id="OPERATION" name="OPERATION" value="<?php echo $RefundPaymentModel->OPERATION; ?>">    
   <input id="Ecom_Payment_Card_Verification" name="Ecom_Payment_Card_Verification" value="<?php echo $RefundPaymentModel->Ecom_Payment_Card_Verification; ?>">
    
   <input id="withroot" name="PSPID" value="<?php echo $RefundPaymentModel->withroot; ?>">
   <input id="submit2" name="submit2" value="<?php echo $RefundPaymentModel->submit2; ?>"> 

   <!-- <input type="submit" value="Submit" class="placeOrderBtn" id="submit" name="submit"> -->
</form>

<script>
   function onloadSubmit() {
      document.paymentForm.submit();
   }

   onloadSubmit();
</script>