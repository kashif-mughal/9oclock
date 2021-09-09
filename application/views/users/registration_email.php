<style>
   #registration, #login, #otpForm, #sign_up {
      display:none;
   }
   #digits {
      text-align:left !important;
      padding-left: 15px;
      letter-spacing: 42px;
      border: 0;
      background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
      background-position: bottom;
      background-size: 50px 1px;
      background-repeat: repeat-x;
      background-position-x: 35px;
      width: 220px;
      min-width: 220px;
   }

   #divInner{
    left: 0;
    position: sticky;
 }

 #divOuter{
    width: 190px; 
    overflow: hidden;
 }
 #digits:focus{
   outline: none;
}  
</style>

<!-- Modal -->
<div class="modal fade" id="TandCModal" tabindex="-1" role="dialog" aria-labelledby="TandCModalLabel" aria-hidden="true" style="height: 90%">
  <div class="modal-dialog modal-dialog-centered" role="document" style="border-radius:2px;">
    <div class="modal-content" style="border-radius:2px; height:90%;">
      <div class="modal-header" style="padding-top:8px;padding-bottom:8px;font-size:18px;">
        <h5 class="modal-title" id="TandCModalLabel">Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: scroll;">
      <h6>Our details</h6>
      <p>The data controller in respect of our website is A2Z GROCERY SWINDON LTD, 131 Beatrice Street, Swindon, United Kingdom, SN2 1BD. You can contact the data controller by writing to A2Z GROCERY SWINDON LTD, 131 Beatrice Street, Swindon, or sending an email to Contact@9oclockshop.co.uk</p>
      <h6 class="mt-3">Contact Us</h6>
      <p>If you have any questions/comments about our terms and conditions, you should contact us at Contact@9oclockshop.co.uk.
         This site is owned and operated by 9 o'clock Shop. These terms and conditions tell you the rights and obligations you have. Please read these carefully before you use this website. You may have other rights granted by law, and these terms and conditions do not affect  these. This does not affect your statutory rights as a consumer. Should you have any questions complaints or comments, please email us at Contact@9oclockshop.co.uk.</p>
      
      <h6 class="mt-3">Ownership of Intellectual Property</h6>
      <p>All rights, including trademarks and copyright, on this website are licensed to or
owned by 9 o’ clock Shop. You acknowledge and agree that all rights are made available for your use while visiting this website. You also acknowledge that apart from your own personal non-commercial use, that any copying, storing of the website in whole or part, and display, distribution, reproduction or commercial use of material or content from this website is strictly prohibited without the permission of 9 ‘o clock Shop and A2Z Grocery Swindon Ltd.</p>

   <h6 class="mt-3">Your Account Security</h6>
      <p>9 ‘o clock Shop cannot be held responsible for any loss/damage of information which may arise as a result of failure by you to protect your account security.
   Please do not divulge your password to anyone and keep account details confidential at all times.</p>

   <h6 class="mt-3">Purchasing From Us</h6>
      <p>By submitting your order you are offering to buy our goods and allowing us to use your personal details for the purposes of supplying products / services. We do not sell your details or pass them onto any other 3rd party companies that aren't operated by 9 ‘o clock Shop (Data Processor) in any circumstance, under the Data Protection Act 1998. We are not obliged to supply goods to you until we have confirmed acceptance of your order. At this point a contract is made.
      You do not own the goods until we receive payment in full. If you discover you have made a mistake with your order please contact us immediately. Please do this before we confirm your order.</p>

   <h6 class="mt-3">Marketing</h6>
   <p>By notifying us that you would like to hear from us [Ticking a Checkbox at sign-up or checkout] you agree to opt in to our marketing mailing lists, which you can opt out of anytime by contacting us at Contact@9oclockshop.co.uk.Legal basis for processing: our legitimate interests (Article 6(1)(f) of the General Data Protection Regulation). Legitimate interests: direct marketing and advertising our products and services.</p>

   <h6 class="mt-3">Online Prices</h6>
   <p>We always ensure that the best possible prices are available online at this website. We do this through applying promotional pricing to our own website which may differ from our promotions in the shop.</p>

   <h6 class="mt-3">For Out of Stock Items</h6>
   <p>We will advise you should any food be out of stock and give you a call. At this point you can cancel your order if you wish.</p>

   <h6 class="mt-3">Refusal of Transaction</h6>
   <p>We reserve the right to withdraw any products from this website at any time
and/or remove or edit any materials or content on this website. We may refuse
to process a transaction for any reason or refuse service to anyone at any time at
our sole discretion. We will not be liable to you or any third party by reason of
our withdrawing any product from this website whether or not that product has
been sold; removing or editing any materials or content on the website; refusing
to process a transaction or unwinding or suspending any transaction after
processing has begun.</p>

   <h6 class="mt-3">Age Restricted Items</h6>
   <p>Where Age restricted items Fire lighters, medicines or tobacco products are sold, we must comply with the law and restrict sale of these items to minors. 
      You must be eighteen (18) years of age, to purchase tobacco or alcoholic products. 9 ‘o clock Shop reserves the right to cancel any transaction where it reasonably believes the purchaser is either not of the required legal age or purchasing products on behalf of a minor.</p>

      <h6 class="mt-3">Delivery Time</h6>
   <p>We aim to deliver your order within the quoted times, but please consider traffic and weather conditions. During busy periods your order may take longer. We may or may not have time to notify you but please be patient or feel free to call us to check-up on your order. Delivery times are approximate and cannot be guaranteed.</p>

      <h6 class="my-3">Refunds</h6>
   <p>We process the refund wherever it is needed as soon as possible. We aim to raise a refund for your money within 48 hours of the refund agreement, but please consider bank processing times and holidays, during such periods your refund may take longer. We may or may not have time to notify you but please be patient or feel free to call us to check-up on your refund</p>

      </div>
      <div class="modal-footer" style="padding-top:8px;padding-bottom:8px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding-top:4px;padding-bottom:4px;background-color: var(--main-color);">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- alert-info -->
 <div id="alertBox" class="alert alert-danger alert-dismissable" style="position: absolute;width: 100%; display: none;">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
     <span></span>
 </div>
<section id="otpForm" style="display:none;">
   <div class="container">
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Email verification</h3>
      </div>
      <div style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc;">      
         <div class="row">
            <div class="ml-3">
               <h2 style="color: var(--main-color); font-weight: 600;">Email address verification</h2>
               <p style="font-weight: 500; color: #cccccc;">Enter 4 digit code sent to your email address</p>
            </div>
         </div>
         <div class="row d-flex justify-content-start align-items-center">
            <div class="form-inline pl-3">
               <form class="digit-group" id="inputOtp">
                  <div id="divOuter">
                     <div id="divInner">
                        <input id="digits" type="text" maxlength="4" />
                     </div>
                  </div>
               </form>
            </div>
            
         </div>

         <div class="row">
            <div class="d-block form-inline pl-3 pt-3">
               <a href="javascript:void(0)" id="resendCode" class="d-block mb-4 ml-2">Resend Code again</a>
            </div>

            <div class="text-center" style="width:100%; margin-top: 40px; margin-bottom: 20px;">
               <input type="submit" value="Verify Code" name="otpSubmit" id="otpSubmit" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
            </div>
         </div>

      </div>
   </div>
</section>

<!-- TESTING SIGN UP -->

<section id="registration_new" style="display:none;">
   <div class="container">
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Sign Up</h3>
      </div>
      <div style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc;">      
         <div class="row">
            <div class="ml-3">
               <h2 style="color: var(--main-color); font-weight: 600;">Sign Up</h2>
               <p style="font-weight: 500; color: #cccccc;">Create an account with an email</p>
            </div>
         </div>
         <div class="row d-flex justify-content-center align-items-center">
            <form id="userRegistrationForm_new" method="post" style="width:100%;">
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputFirstNameContainer">
                  <i class="fas fa-user" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputFirstName" id="inputFirstName" class="form-control" placeholder="First Name" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputLastNameContainer">
                  <i class="fas fa-user" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputLastName" id="inputLastName" class="form-control" placeholder="Last Name" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputEmailContainer">
                  <i class="fas fa-envelope" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email Address" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputPhoneContainer">
                  <i class="fas fa-mobile-alt" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="tel" name="inputPhone" id="inputPhone" class="form-control simple-field-data-mask" data-mask="+44-000-0000000" placeholder="Phone Number" value="+44-" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputAddressContainer">
                  <i class="fas fa-map-marker-alt" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputAddress" id="inputAddress" class="form-control" placeholder="Address" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputZipCodeContainer">
               
                  <i class="fas fa-map-pin" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputZipCode" id="inputZipCode" class="form-control" placeholder="Postal Code" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputTownContainer">
                  <i class="fas fa-building" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputTown" id="inputTown" class="form-control" placeholder="Town" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputCityContainer">
                  <i class="fas fa-city" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputCity" id="inputCity" class="form-control" placeholder="City" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputPasswordContainer">
                  <i class="fas fa-lock" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputConfirmPasswordContainer">
                  <i class="fas fa-lock" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="password" name="inputConfirmPassword" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>
                  <div style="margin-top: 46px; margin-bottom:20px;">
                     <div class="ml-4 d-flex justify-content-start align-items-center">
                        <div>
                           <input type="checkbox" name="chbxTermsAndConditions" 
                           id="chbxTermsAndConditions">
                        </div>
                        <div class="ml-4">
                           <span>By creating an account, I accept the terms & conditions.</span> <button style="border:none;    background-color:transparent;color: #333;font-size: 14px;padding:0px;margin:0px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#TandCModal"><i class="fas fa-external-link-alt"></i> read</button>
      <!-- <a href="www.google.com" style="font-weight: 500; color: #333;" target="_blank"> -->
      </a>
                        </div>
                     </div>
                     <div class="my-2 ml-4 d-flex justify-content-start align-items-center">
                        <div>
                           <input type="checkbox" name="chbxReceiveOffers" id="chbxReceiveOffers">
                        </div>
                        <div class="ml-4">
                           <span>I want to receive news about offer and deals.</span>
                        </div>
                     </div>
                  </div>
                  <div class="text-center" style="width:100%; margin-top: 40px; margin-bottom: 20px;">
                     <input type="submit" value="Sign Up" name="registerForm" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
                  </div>
               
            </form>
         </div>
      </div>
   </div>
</section>


<!-- Login New  -->
<section id="login_new">
   <div class="container">
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Login</h3>
      </div>
      <div style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc;">      
         <div class="row">
            <div class="ml-3">
               <h2 style="color: var(--main-color); font-weight: 600;">Login</h2>
               <p style="font-weight: 500; color: #cccccc;">Enter your credentials to proceed</p>
            </div>
         </div>
         <div class="row d-flex justify-content-center align-items-center">
            <form id="userLoginForm_new" method="post" style="width:100%;">
               
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputLoginEmailContainer">
                  <i class="fas fa-envelope" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="email" name="inputLoginEmail" id="inputLoginEmail" class="form-control" placeholder="Email Address" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>
               
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputLoginPasswordContainer">
                  <i class="fas fa-lock" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="password" name="inputLoginPassword" id="inputLoginPassword" class="form-control" placeholder="Password" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>
               
               <div class="text-center" style="width:100%; margin-top: 40px; margin-bottom: 20px;">
                  <input type="submit" value="Login" name="loginForm" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
               </div>

            </form>
         </div>
         <div>
            <div><span>Forgot your password? <a href="<?=base_url("dashboard/user_password_reset")?>">Click to reset</a></span></div>
            <div><span>New Customer? <a href="javascript:void(0)" onclick="
            document.getElementById('login_new').style.display = 'none';
            // document.getElementById('sign_up').style.display = 'block';
            document.getElementById('registration_new').style.display = 'block';
            
            ">Create New Account</a></span></div>
         </div>
      </div>
   </div>
</section>
<!-- Login New Ends -->


<section id="sign_up" style="display:none;">
   <div class="container">
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Email Verification</h3>
      </div>
      <div style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc;">      
         <div class="row">
            <div class="ml-3">
               <h2 style="color: var(--main-color); font-weight: 600;">Email Verification</h2>
               <p style="font-weight: 500; color: #cccccc;">Please verify your Email address</p>
            </div>
         </div>
         <div class="row d-flex justify-content-center align-items-center">
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputEmailVerifyContainer">
                  <i class="fas fa-envelope" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="email" name="inputEmailVerify" class="form-control" id="sign_up_email" placeholder="Email Address" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>
                              
               <!-- <input type="submit" value="Login" name="loginForm" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2"> -->
               <button href="javascript:void(0)" id="registerationContinue" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px; margin-top: 40px;" class="py-2">CONTINUE REGISTERATION</button>
            </form>
         </div>
      </div>
   </div>
</section>
<!-- Login New Ends -->

<!-- Scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery.mask.js" type="text/javascript"></script>
<script>
   $(document).ready(function() {
      $('#otpForm').hide();
      //$('#otpForm').show();

      $('#registerationContinue').on('click', function(e) {
         e.preventDefault();
         // call to verify provided email
         if($('#sign_up_email').val().length > 0) {
            try {
            $.ajax({
                url: "<?php echo base_url();?>Dashboard/email_exist",
                type: 'post',
                dataType: "json",
                data: {
                  email: $('#sign_up_email').val()
                },
                success: function( data ) {
                  if(data.status == 'userAvailable') { // 0 = otp email is verified
                     $('#sign_up').hide();
                     $('#login_new').show(); // to login page
                     $('#digits').focus();
                  }
                  else if(data.status == 'userNotRegister') {
                     $('#sign_up').hide();
                     $('#registration_new').show(); // to register page
                  }
                  else if(data.status == "OTPsend"){
                     $('#otpForm').show(); // to otp page
                     $('#sign_up').hide();
                  }

                }
             });
            }
            catch(err) {
               console.log(err);
            }

         }
         else {
            showNoti("Please enter email to continue", "error");
         }
   
      });

      // Submit OTP
		$('#otpSubmit').click(function() {
			var otpCode = $('#digits').val();
			var otpRegEx = /^[0-9]{4}$/;
         var email_address = $('#inputEmail').val();
			if(!otpCode.match(otpRegEx)) {
				showNoti("OTP should be 4 digit number", "error");
			}
			else {
				$.ajax({
					url: "<?php echo base_url(); ?>Auth2/otpVerifyEmail",
					method: "POST",
					data: { code: otpCode, email: email_address },
					dataType: "json",
					success: function(data) {
                  alert(data);
						if(data.status == 'Error') {
                        showNoti(data.response, "error");
                  }
                  else {
                     if(data.loggedInStatus == "login") { // && data.redirectURL == false) {
                        //$('#otpForm').hide(); // to otp page
                        //$('#login_new').show();
                        //$("#userRegistrationForm_new").trigger("reset");

                        if(!data.redirectURL) {
								   window.location = "<?php echo base_url(); ?>Dashboard";
                        } else {
								   window.location.href = decodeURIComponent(data.redirectURL);
                        }
                     }
                     showNoti(data.response, "success");
                  }
					},
					error: function(data) {
						showNoti(data.response, "error");
				   }
				});
			}
		});

      $('#userLoginForm_new').on('submit',function(event) {
         event.preventDefault();
         $('#userId').val(localStorage.getItem('UserId'));

         if(!$('#inputLoginEmail').val()) { $('#inputLoginEmail').css("border", "1px solid red"); }
			else { $('#inputLoginEmailContainer').css("border", "1px solid green"); }

			if(!$('#inputLoginPassword').val()) { $('#inputLoginPassword').css("border", "1px solid red"); }
			else { $('#inputLoginPasswordContainer').css("border", "1px solid green"); }

         if(!$('#inputLoginEmail').val() && !$('#inputLoginPassword').val()) {
            showNoti("Error! Please fill all fields", "error");
         }
         else {

            $.ajax({
					url: "<?php echo base_url(); ?>Auth2/login_email",
					method: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(data) {
						if(data.status == 'Error') {
							showNoti(data.response, 'error');
                     console.log('Error is True');
						}
						else {
							showNoti(data.response, 'success');
							setTimeout(function() {
								if(!data.redirectUrl) {
									$("#userLoginForm").trigger("reset");
								 	window.location = "<?php echo base_url(); ?>"; 
                            console.log('data redirect URL is FALSE');
								}
								else {
									window.location = decodeURIComponent(data.redirectUrl);
                           console.log('data redirect URL is TRUE');
								}
							}, 2000);
						}
					},
					error: function(data) {
						showNoti(data.response, 'error');
					}
				});
         }

      });

      //Logout
      $('#userLoggedOut').click(function() {
			window.location = "<?= base_url(); ?>Auth2/logout_email";
		});

      $('#resendCode').click(function() {
			$('#digits').val('');

         var email_address = $('#inputEmail').val();
         $.ajax({
            url: "<?php echo base_url(); ?>Auth2/resendOtp",
					method: "POST",
					data: { email: email_address },
					dataType: "json",
					success: function(data) {
                  if(data.status == 'Error') {
                     showNoti(data.responseMessage, "error");
						}
                  else {
                     showNoti(data.responseMessage, 'success');
                     if(!data.loggedInStatus) {
                        $('#digits').select().focus();
                     }
                  }
               },
               error: function(data) {
                  showNoti(data.responseMessage, 'error');
               }
         });

		});

      
      // Register User
		$('#userRegistrationForm_new').on('submit', function(event) {
			event.preventDefault();
			$('#userId').val(localStorage.getItem('UserId'));
			
         if(!$('#inputFirstName').val()) { $('#inputFirstNameContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputFirstNameContainer').css("border-bottom", "0.13rem solid green"); }

         if(!$('#inputLastName').val()) { $('#inputLastNameContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputLastNameContainer').css("border-bottom", "0.13rem solid green"); }

			if(!$('#inputEmail').val()) { $('#inputEmailContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputEmailContainer').css("border-bottom", "0.13rem solid green"); }

			if(!$('#inputAddress').val()) { $('#inputAddressContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputAddressContainer').css("border-bottom", "0.13rem solid green"); }

         if(!$('#inputZipCode').val()) { $('#inputZipCodeContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputZipCodeContainer').css("border-bottom", "0.13rem solid green"); }

         if(!$('#inputTown').val()) { $('#inputTownContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputTownContainer').css("border-bottom", "0.13rem solid green"); }

         if(!$('#inputCity').val()) { $('#inputCityContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputCityContainer').css("border-bottom", "0.13rem solid green"); }

			if(!$('#inputPassword').val()) { $('#inputPasswordContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputPasswordContainer').css("border-bottom", "0.13rem solid green"); }

			if(!$('#inputConfirmPassword').val()) { $('#inputConfirmPasswordContainer').css("border-bottom", "0.13rem solid red"); }
			else { $('#inputConfirmPasswordContainer').css("border-bottom", "0.13rem solid green"); }

         if($('#inputPhone').val() == "" || $('#inputPhone').val() == "+44-") {
            $('#inputPhoneContainer').css("border-bottom", "0.13rem solid red");
         } else { $('#inputPhoneContainer').css("border-bottom", "0.13rem solid green"); }

         console.log("Status 1");

			if(!$('#inputFirstName').val() || !$('#inputLastName').val() || !$('#inputEmail').val() || !$('#inputAddress').val() || !$('#inputZipCode').val() || !$('#inputTown').val() || !$('#inputCity').val() || !$('#inputPassword').val() || !$('#inputConfirmPassword').val() ) {

            console.log('Error');

            showNoti("Please fill all the required fields", "error");
				
			}
         else if(!$('#chbxTermsAndConditions').is(":checked")) {
            // !$('#chbxReceiveOffers').is(":checked") 
            showNoti("Please accept terms and conditions to register.", "error");
         }
			else {
				$.ajax({
					url: "<?php echo base_url(); ?>Auth2/updateUserRegistrationByEmail",
					method: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(data) {
						if(data.status == 'Error') {
                     showNoti(data.responseMessage, "error");
						}
						else {
                     alert(data.redirectURL);
                     showNoti(data.responseMessage, "success");
                     $('#registration_new').hide();
							$('#registration_new').css('display', 'none');
							$('#userId').val(localStorage.removeItem('UserId'));

                     if(data.loggedInStatus) {
                        $('#login_new').show();
                        $('#login_new').css('display', 'block');
                     }
                     else {
                        $('#otpForm').show();
                        $('#otpForm').css('display', 'block');
                        $('#digits').select().focus();
                     }
                     
                     showNoti(data.responseMessage, "success");
							// if(!data.redirectUrl)
							// 	window.location = "<?php //echo base_url(); ?>Dashboard";
							// else
							// 	window.location.href = decodeURIComponent(data.redirectURL);
						}
					},
					error: function(data) {
                  showNoti(data.responseMessage, "error");

					}
				});
			}
		});

      // Private Functions
		function validateEmail() {
			var email = $('#inputEmail').val();
			var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			return (reg.test(email)) ? true : false;
		}
      var allowKeys = ["0","1","2","3","4","5","6","7","8","9","Backspace"];

      $('#digits').keydown(function() {
			// Check Character
			if(allowKeys.indexOf(event.key) == -1) return false;
		});
      $('#digits').keyup(function() {
         if(event.target.value.length == 4) 
         {
            $('#otpSubmit').select().focus();
            $('#otpSubmit').trigger('click');
         }
      });	

   });
function showNoti(message, type){
   var notiElem = $('#alertBox');
   notiElem.find('span').html(message);
   if(type.toLowerCase() == 'error'){
      notiElem.removeClass('alert-info');
      notiElem.addClass('alert-danger');
   }
   else{
      notiElem.addClass('alert-info');
      notiElem.removeClass('alert-danger');
   }
   notiElem.show();
   window.location.href = '#';
   setTimeout(function(){
      notiElem.hide();
   }, 5000);
}
var obj = document.getElementById('digits');
obj.addEventListener('keydown', stopCarret); 
obj.addEventListener('keyup', stopCarret); 

function stopCarret() {
   if (obj.value.length > 3){
      setCaretPosition(obj, 3);
   }else{
      setCaretPosition(obj, obj.value.length);
   }
}

function setCaretPosition(elem, caretPos) {
    if(elem != null) {debugger;
        if(elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if(elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}
</script>