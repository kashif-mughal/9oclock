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
                  <i class="fas fa-map-marker-alt" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputZipCode" id="inputZipCode" class="form-control" placeholder="Zip Code" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputTownContainer">
                  <i class="fas fa-map-marker-alt" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="text" name="inputTown" id="inputTown" class="form-control" placeholder="Town" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off">
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputCityContainer">
                  <i class="fas fa-map-marker-alt" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
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
               <div class="text-center" style="width:100%; margin-top: 40px; margin-bottom: 20px;">
                  <input type="submit" value="Sign Up" name="registerForm" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
                  <p class="mt-2" style="font-weight: 500; color: #cccccc;">By creating an account, I accept the terms & conditions</p>
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
                  console.log(data);
						if(data.status == 'Error') {
                        showNoti(data.response, "error");
                  }
                  else {
                     if(data.loggedInStatus == "login") { // && data.redirectURL == false) {
                        $('#otpForm').hide(); // to otp page
                        $('#login_new').show();
                        $("#userRegistrationForm_new").trigger("reset");
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

         console.log("Status 1");

			if(!$('#inputFirstName').val() || !$('#inputLastName').val() || !$('#inputEmail').val() || !$('#inputAddress').val() || !$('#inputZipCode').val() || !$('#inputTown').val() || !$('#inputCity').val() || !$('#inputPassword').val() || !$('#inputConfirmPassword').val()) {

            console.log('Error');

            showNoti("Please fill all the required fields", "error");
				
				
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