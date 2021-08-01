<style>
.checkmark__circle {
  stroke-dasharray: 400;
  stroke-dashoffset: 400;
  stroke-width: 50;
  stroke-miterlimit: 20;
  stroke: #e74c3c;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}
.checkmark {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  margin: 2% auto 44px auto;
  box-shadow: inset 0px 0px 0px #e74c3c;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;

}
.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 29;
  stroke-dashoffset: 29;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}
@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #e74c3c;
  }
}
.PaymentResponseMessageContainer {
  background-color: #fff;
  border-radius:4px;
  width: 70%;
  margin-top: 3%;
  padding: 40px;
}
.paymentButton {
  background-color: var(--main-color);
  color: #fff;
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 4px;
  transition: 0.1s ease-in-out;
}
.paymentButton:hover {
  background-color: var(--secondary-color);
  color: #fff;
  text-decoration: none;
}
#secondsDisplay {
  color: var(--secondary-color);
  font-weight: bold;
}
</style>


<script type="text/javascript">
  var seconds = 10;
  var secondText = seconds;
  var redirectSeconds = (seconds*1000);
  function displaySeconds() {
    seconds -= 1;
    document.getElementById("secondsDisplay").innerText = seconds;
    if(seconds == secondText-1) {
      document.getElementById("redirectText").append(" seconds");  
    }
    if(seconds == 0) {
      redirectToPage();
    }
  }
  setInterval(displaySeconds,1000);

  function redirectToPage() {
    window.location.href = "<?php echo base_url('Dashboard/index'); ?>";
  }
  //setTimeout("redirectToPage()", redirectSeconds);
</script>  

<div class="d-flex justify-content-center">
  <div class="flex d-flex flex-column justify-content-center align-items-center mb-5 PaymentResponseMessageContainer">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
      <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
      <path class="checkmark__check" fill="none" d="M16 16 36 36 M36 16 16 36" />
    </svg>
    <h2 class="paymentMainText">Payment Processing Failed</h2>
    <p class="paymentSubText" id="redirectText" style="margin-bottom:0px;">You will be redirected to Homepage in <span id="secondsDisplay"></p>
    <hr style="border-top:1px solid #ccc;width:100%;">
    <p class="paymentSubText">Click link below to redirect to homepage</p>
    <a class="paymentButton" href="<?php echo base_url('Dashboard/index'); ?>"><< Back To Homepage</a>
  </div>
</div>




