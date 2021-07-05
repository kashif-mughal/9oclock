<!-- Production -->
<form method="POST" action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp"
id="paymentForm" name="paymentForm">

<!-- Test -->
<!-- <form method="POST" action="https://mdepayments.epdq.co.uk/ncol/test/orderstandard.asp"
id="form" name="form"> -->


   <!-- general parameters -->
   <input type="hidden" id="AMOUNT"    name="AMOUNT" value="<?php echo $PaymentModel->AMOUNT; ?>">
   <input type="hidden" id="CN"        name="CN" value="<?php echo $PaymentModel->CN; ?>">
   <input type="hidden" id="CURRENCY"  name="CURRENCY" value="GBP">
   <input type="hidden" id="LANGUAGE"  name="LANGUAGE" value="<?php echo $PaymentModel->LANGUAGE; ?>">
   <input type="hidden" id="ORDERID"   name="ORDERID" value="<?php echo $PaymentModel->ORDERID; ?>">
    
   <input type="hidden" id="OWNERADDRESS" name="OWNERADDRESS" value="<?php echo $PaymentModel->OWNERADDRESS; ?>"> 
   <input type="hidden" id="OWNERCTY"     name="OWNERCTY" value="<?php echo $PaymentModel->OWNERCTY; ?>">
   <input type="hidden" id="OWNERTELNO"   name="OWNERTELNO" value="<?php echo $PaymentModel->OWNERTELNO; ?>">
   <input type="hidden" id="OWNERTOWN"    name="OWNERTOWN" value="<?php echo $PaymentModel->OWNERTOWN; ?>">    
   <input type="hidden" id="OWNERZIP"     name="OWNERZIP" value="<?php echo $PaymentModel->OWNERZIP; ?>">
    
   <input type="hidden" id="PSPID" name="PSPID" value="<?php echo $PaymentModel->PSPID; ?>">
   <input type="hidden" id="SHASIGN" name="SHASIGN" value="<?php echo strtoupper($ShaPass); ?>"> 

   <!-- $ShaPass; ?>"> -->

   <input type="hidden" name="ACCEPTURL" value="<?php echo base_url("PaymentIntegration/Success") ?>">
   <input type="hidden" name="DECLINEURL" value="<?php echo base_url("PaymentIntegration/Decline") ?>">
   <input type="hidden" name="EXCEPTIONURL" value="<?php echo base_url("PaymentIntegration/Cancelled") ?>">
   <input type="hidden" name="CANCELURL" value="<?php echo base_url("PaymentIntegration/Cancelled") ?>">

   <!-- <input type="submit" value="Submit" class="placeOrderBtn" id="submit" name="submit"> -->
</form>

<script>
   function onloadSubmit() {
      document.paymentForm.submit();
   }

   onloadSubmit();
</script>