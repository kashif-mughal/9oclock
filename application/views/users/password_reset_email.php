<style>
   #registration, #login, #otpForm {
      display:none;
   }
   .resetEmailUserText {
      color: #000;
      font-size: 20px;
      font-weight: 600;
   }
   .resetEmailText {
      color: var(--main-color);
      font-size: 16px;
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
                  <input 
                     type="number" 
                     name="digit-1" 
                     id="digit-1" 
                     autocomplete="off" 
                     autofocus
                     style="font-size: 30px; width: 50px; margin-right: 8px; border: 1px solid #dcdcdc;
                              border-radius: 2px; margin-bottom: 12px; align-items: center;"
                  >
                  <input 
                     type="number" 
                     name="digit-2" 
                     id="digit-2" 
                     autocomplete="off"
                     style="font-size: 30px; width: 50px; margin-right: 8px; border: 1px solid #dcdcdc;
                              border-radius: 2px; margin-bottom: 12px; align-items: center;"
                  >
                  <input 
                     type="number" 
                     name="digit-3" 
                     id="digit-3" 
                     autocomplete="off"
                     style="font-size: 30px; width: 50px; margin-right: 8px; border: 1px solid #dcdcdc;
                              border-radius: 2px; margin-bottom: 12px; align-items: center;"
                  >
                  <input 
                     type="number" 
                     name="digit-4" 
                     id="digit-4" 
                     autocomplete="off" 
                     last="true"
                     style="font-size: 30px; width: 50px; margin-right: 8px; border: 1px solid #dcdcdc;
                              border-radius: 2px; margin-bottom: 12px; align-items: center;"
                  >
               </form>
            </div>
            
         </div>

         <div class="row">
            <div class="d-block">
               <a href="javascript:void(0)" id="resendCode" class="d-block mb-4 ml-2">Resend Code again</a>
            </div>

            <div class="text-center" style="width:100%; margin-top: 40px; margin-bottom: 20px;">
               <input type="submit" value="Verify Code" name="otpSubmit" id="otpSubmit" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
            </div>
         </div>

      </div>
   </div>
</section>




<section id="reset_email">
   <div class="container">
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Reset Password</h3>
      </div>
      <div style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc;">      
         <div class="row">
            <div class="ml-3">
               <h2 style="color: var(--main-color); font-weight: 600;">Reset Password</h2>
               <p style="font-weight: 500; color: #cccccc;">Please enter your email address</p>
            </div>
         </div>
         <div class="row d-flex justify-content-center align-items-center">
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputEmailVerifyContainer">
                  <i class="fas fa-envelope" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Email Address" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>
                              
               <!-- <input type="submit" value="Login" name="loginForm" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2"> -->
               <button href="javascript:void(0)" id="resetEmailContinue" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px; margin-top: 40px;" class="py-2">CONTINUE</button>
            </form>
         </div>
      </div>
   </div>
</section>
<!-- Login New Ends -->

<section id="reset_email_message" style="display:none; margin-top: 133px;">
   <div class="container"> 
      <div class="row text-left" style="background-color: #ffffff; border-radius: 2px; padding: 35px; border: 1px solid #cccccc; height: 400px;">
         <p id="emailResetMessageBox d-flex align-items-center justify-content-center"></p>
      </div>
   </div>
</section>


<!-- Scripts -->
<script>
   $(document).ready(function() {
      $('#otpForm').hide();
      //$('#otpForm').show();

      $('#resetEmailContinue').on('click', function(e) {
        e.preventDefault();
        if($('#inputEmail').val().length > 0) {
             
            // if not exist then show error message ('Your eamil address is invalid')
            try {
                $.ajax({
                    url: "<?php echo base_url();?>Dashboard/reset_password_email",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email: $('#inputEmail').val()
                    },
                    success: function(data) {debugger;
                        if(data.status == 'error') {
                            showNoti("Error!" + data.response, "error");
                        }
                        else {
                            $('#reset_email').hide();
                            $('#reset_email_message').show();
                            $('#emailResetMessageBox').html(data.response);
                        }
                    }
                });
            }
            catch(err) {
                console.log(err);
            }
        }
        else {
            showNoti("Error! Please enter valid email address", "error");
        }
      });

      // $('#registerationContinue').on('click', function(e) {
      //    e.preventDefault();
      //    // call to verify provided email
      //    if($('#sign_up_email').val().length > 0) {
      //       try {
      //       $.ajax({
      //           url: "<?php //echo base_url();?>Dashboard/email_exist",
      //           type: 'post',
      //           dataType: "json",
      //           data: {
      //             email: $('#sign_up_email').val()
      //           },
      //           success: function( data ) {
      //             if(data.status == 'userAvailable') { // 0 = otp email is verified
      //                $('#sign_up').hide();
      //                $('#login_new').show(); // to login page
      //                $('#digit-1').focus();
      //             }
      //             else if(data.status == 'userNotRegister') {
      //                $('#sign_up').hide();
      //                $('#registration_new').show(); // to register page
      //             }
      //             else if(data.status == "OTPsend"){
      //                $('#otpForm').show(); // to otp page
      //                $('#sign_up').hide();
      //             }

      //           }
      //        });
      //       }
      //       catch(err) {
      //          console.log(err);
      //       }

      //    }
      //    else {
      //       showNoti("Please enter email to continue", "error");
      //    }
   
      // });

      // Submit OTP
		// $('#otpSubmit').click(function() {
		// 	var otpCode = $('#digit-1').val() + $('#digit-2').val() + $('#digit-3').val() + $('#digit-4').val();
		// 	var otpRegEx = /^[0-9]{4}$/;
      //    var email_address = $('#sign_up_email').val();
		// 	if(!otpCode.match(otpRegEx)) {
		// 		showNoti("OTP should be 4 digit number", "error");
		// 	}
		// 	else {
		// 		$.ajax({
		// 			url: "<?php //echo base_url(); ?>Auth2/otpVerifyEmail",
		// 			method: "POST",
		// 			data: { code: otpCode, email: email_address },
		// 			dataType: "json",
		// 			success: function(data) {
      //             console.log(data);
		// 				if(data.status == 'Error') {
      //                   showNoti(data.response, "error");
      //             }
      //             else {
      //                if(data.status) { // && data.redirectURL == false) {
      //                   $('#otpForm').hide(); // to otp page
      //                   $('#login_new').show();
      //                }
      //                else {
      //                   $('#otpForm').hide(); // to otp page
      //                   $('#registration_new').show(); // to register page
      //                }
      //             }
		// 			},
		// 			error: function(data) {
		// 				showNoti(data.response, "error");
		// 		   }
		// 		});
		// 	}
		// });

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
									window.location = decodeURIComponent(data.redirectURL); 	
                           console.log('data redirect URL is TRUE');
								}
							}, 2000);
						}
					},
					error: function(data) {
						showNoti(data.response, 'success');
					}
				});
         }

      });

      //Logout
      $('#userLoggedOut').click(function() {
			window.location = "<?= base_url(); ?>Auth2/logout_email";
		});

      // $('#resendCode').click(function() {
		// 	$('#digit-1').val('');
		// 	$('#digit-2').val('');
		// 	$('#digit-3').val('');
		// 	$('#digit-4').val('');

		// 	$('#otpForm').hide();
		// 	$('#phoneForm').show();
		// });

      // Private Functions
		function validateEmail() {
			var email = $('#inputEmail').val();
			var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			return (reg.test(email)) ? true : false;
		}
      var allowKeys = ["0","1","2","3","4","5","6","7","8","9"];

      $('input[name^=digit-]').keydown(function() {
			// Check Character
			if(allowKeys.indexOf(event.key) == -1) return false;
			if(event.key.length <= 1) 
			{
				$("#inputOtp #" + event.target.id).val(event.key);
				var nextElement = $("#inputOtp #" + event.target.id).next();
				nextElement.focus();
				if($("#inputOtp #" + event.target.id).attr('last') == "true"){
					$('#otpSubmit').select().focus();
					$('#otpSubmit').trigger('click');
				}
				return false;
			}
			else {
				var str = event.key;
				str = str.substring(0, str.length - 1);
				$("#inputOtp #" + event.target.id).val(str);
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
</script>