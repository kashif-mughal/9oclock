
<div class="d-flex justify-content-center">
  <div class="flex d-flex flex-column justify-content-center align-items-center mb-5 PaymentResponseMessageContainer">
   
    <h2 class="paymentMainText">Enter Amount to Refund</h2>

    <form action="http://localhost/9oclock/PaymentIntegration/refundprocess" 
          method="post" 
          class="form-vertical" 
          id="refund_amount">
            
          <input type="number" name="refund_amount" class="form-control" placeholder="refund Amount" />
          <input type="submit" class="btn btn-primary mt-2" value="Process Refund" />

		</form>

    <hr style="border-top:1px solid #ccc;width:100%;">
    <p class="paymentSubText">Click link below to redirect to homepage</p>
    <a class="paymentButton" href="<?php echo base_url('Dashboard/index'); ?>"><< Back To Homepage</a>
  </div>  
</div>

