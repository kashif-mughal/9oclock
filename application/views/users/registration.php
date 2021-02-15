<div class="container">
	<style type="text/css">
		.content-box{
			margin-top: 0px !important;
		}
	</style>
	<!-- <div class="row mx-auto">
		<img src="img/logo.png" alt="" class="mx-auto mt-3" style="background-color: #17a18d; border-radius: 47%;">
	</div> -->
	<div class="row" id="registration_form">
		<div class="col-xl-8 col-lg-8 col-md-12 pr-md-0">
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			<!-- Phone Verification -->
			<div id="phoneForm">
				<div class="card content-box" style="padding-bottom: 11px;">

					<div class="sign-in d-flex justify-content-start align-items-start">
						<div class="mt-2 step-number text-center">
							<span>1</span>   
						</div>                  
						<div class="sign-in-content ml-4">
							<h4 class="mb-1">Phone Number Verification</h4>
							<div class="errorNotify my-4"></div>
							<span class="d-block mb-4">We need your phone number so that we can update you about your order.</span>
							<span class="d-block mb-3">Enter your mobile number</span>
						
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text font-size-26 bg-white" id="countryCode">+92</span>
									<span class="input-group-text font-size-26 px-0 bg-white border-l-none" id="dash">-</span>
									<span class="input-group-text font-size-26 bg-white border-l-none" id="startingCode">3</span>
								</div>
								<input type="number" class="form-control mr-0 border-l-none" id="inputPhone" autofocus>
								<div class="input-group-append m-0 phone-Submit-Btn">
									<a href="javascript:void(0)" class="btn btn-dark px-4 py-3" type="submit" id="phoneSubmit">
										Verify Number
									</a>
								</div>
							</div>
							<span class="d-block phoneInputFooterText">* You will receive a sms shortly</span>
							<span class="d-block phoneInputFooterText">Existing user will log in right after verifying the confirmation code</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Phone Verification Ends -->
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			<!-- OTP Verfication -->
			<div id="otpForm" style="display:none;">
				<div class="sign-in content-box d-flex justify-content-start align-items-start">
					<div class="mt-2 step-number text-center">
						<span>1</span>
					</div>
					<div class="sign-in-content ml-4">
						<h4 class="mb-5">Phone Number Verification</h4>
						<span class="d-block mb-3 currentPhoneMessage">Enter 4 digit code sent to your phone </span>
						<div class="form-inline">
							<form class="digit-group" id="inputOtp">
								<input type="number" name="digit-1" id="digit-1" autocomplete="off" autofocus>
								<input type="number" name="digit-2" id="digit-2" autocomplete="off">
								<input type="number" name="digit-3" id="digit-3" autocomplete="off">
								<input type="number" name="digit-4" id="digit-4" autocomplete="off" last="true">
							</form>
						</div>
						<a href="javascript:void(0)" id="resendCode" class="d-block mb-4">Resend Code again</a>
						<button href="javascript:void(0)" class="btn btn-dark px-5 py-2" id="otpSubmit" type="submit">Next</button>
					</div>
				</div>
			</div>
			<!-- OTP Verification Ends -->
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			<!-- Phone Verification Confirm -->
			<!-- <div id="phoneVerified" style="display:none;">
				<div class="row mx-auto">
					<div class="verifiedIcon mx-auto d-flex justify-items-center flex-column pd-75">
						<i class="fas fa-check-circle fa-5x d-block mx-auto mb-4" style="color: green;"></i>
						<h2>Phone Verification Completed</h2>
					</div>
				</div>
			</div> -->
			<!-- Phone Verification Confirm Ends -->
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			<!-- Registration Form -->
			<div id="registrationForm" style="display:none;">
				<div class="card content-box">
					<div class="card-body">
						<h5 class="card-title text-center">Register Member</h5>
						<div class="errorNotify my-4"></div>
							<form id="userRegistrationForm" method="post"> 
								<!-- action="<?php //echo base_url('Auth/updateUserRegistration'); ?>"> -->
								<div class="form-label-group mb-3">
									<label for="inputName" class="mb-0">Fullname</label>
									<input type="text" id="inputName" name="inputName" class="form-control" placeholder="Fullname" required autofocus>
								</div>

								<div class="form-label-group mb-3">
									<label for="inputEmail" class="mb-0">Email address</label>
									<input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address"
										required autofocus>
								</div>
								
								<div class="form-label-group mb-3">
									<label for="inputAddress" class="mb-0">Address</label>
									<input type="text" id="inputAddress" name="inputAddress" class="form-control" placeholder="Address" required autofocus>
								</div>
								<div class="row">
									<div class="col">
										<div class="form-label-group mb-3">
											<label for="selectCountry" class="mb-0">Country</label>
											<select class="form-control form-control-sm" id="selectCountry" name="selectCountry">
												<?php foreach($countries as $country) : ?>
												<option value="<?php echo $country['place_name']; ?>"><?=$country['place_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-label-group mb-3">
											<label for="selectCity" class="mb-0">City</label>
											<select class="form-control form-control-sm" id="selectCity" name="selectCity">
												<?php foreach($cities as $city) : ?>
												<option value="<?php echo $city['place_name']; ?>"><?=$city['place_name'];?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="addressDetails">Address Details</label>
									<textarea class="form-control" id="addressDetails" name="addressDetails" rows="3" placeholder="Address Details"></textarea>
								</div>

								<div class="row">
									<div class="col">
										<div class="form-label-group mb-3">
											<label for="inputPassword" class="mb-0">Password</label>
											<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
										</div>
									</div>
									<div class="col">
										<div class="form-label-group mb-3">
											<label for="inputConfirmPassword" class="mb-0">Confirm Password</label>
											<input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required>
										</div>
									</div>
								</div>
								
								<input type="hidden" name="userId" id="userId">
								<input type="submit" name="registerSubmit" id="registerSubmit" class="btn btn-primary button-primary text-white p-2 text-dec-none btn-block text-uppercase" value="Register">
								<hr class="my-2">
								<a href="javascript:void(0)" id="SigninSwitch" class="p-2 text-dec-none btn-block" type="submit">
									<i class="fab fa-register mr-2"></i> or Sign in
								</a>
							</form>
					</div>
				</div>
			</div>
			<!-- Registration Form Ends -->
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			<!-- Login Form -->
			<div id="loginForm" style="display:none;">
				<div class="card content-box">
					<div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>
						<div class="errorNotify my-4"></div>
					
						<form id="userLoginForm" method="post"> 
							<div class="form-label-group mb-3">
								<label for="inputLoginEmail" class="mb-0">Email address</label>
								<input type="email" id="inputLoginEmail" name="inputLoginEmail" class="form-control" placeholder="Email address"
									required autofocus>
							</div>

							<div class="form-label-group mb-3">
								<label for="inputLoginPassword" class="mb-0">Password</label>
								<input type="password" id="inputLoginPassword" name="inputLoginPassword" class="form-control" placeholder="Password"
									required>
							</div>

							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" id="rememberMe" name="rememberMe">
								<label class="custom-control-label" for="rememberMe">Remember me</label>
							</div>
							<input type="submit" name="signinSubmit" id="signinSubmit" class="btn btn-info button-secondary text-white p-2 text-dec-none btn-block text-uppercase" value="Sign in">
							<hr class="my-2">
							<a href="javascript:void(0)" id="RegisterSwitch" class="p-2 text-dec-none btn-block mx-auto" type="submit">
								<i class="fab fa-register mr-2"></i> Register Here
							</a>
						</form>
					</div>
				</div>
			</div>
			<!-- Login Form Ends -->			
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
		</div>
		
		<div class="col-xl-4 col-lg-4 col-md-12">
            <div class="row">
               <div class="col-lg-12 col-md-6 grocery-features-columns">
                  <div class="grocery-features shop-assistant-feature mt-lg-0">
                     <div class="card">
                        <div class="card-body grocery-assistant-card">
                           <div class="container-fluid px-0">
                              <h6 class="card-title mb-0">Walk through all sections of the store with our assistant</h6>
                              <div class="row">
                                 <div class="col-md-7 pr-0">
                                    <h4 class="card-heading pt-3 mb-2">SHOP ASSISTANT</h4>
                                    <button class="card-button" id="shopAssistantButton" data-toggle="modal" data-target="#virtualAssistant">Use Assistant</button>
                                 </div>
                                 <div class="image-container">
                                    <img src="<?php echo base_url() ?>assets/img/grocery-assitant-icon.png?>" alt="Grocery Assistant Icon" class="img-fluid" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 col-md-6 grocery-features-columns">
                  <div class="grocery-features value-cart-feature">
                     <div class="card">
                        <div class="card-body value-cart">
                           <div class="container-fluid px-0">
                              <h4 class="card-heading">Value Cart</h4>
                              <div class="row">
                                 <div class="col-md-7 pr-0">                                    
                                    <h6 class="card-title mb-3">Let us assist you in building the most economical cart</h6>
                                    <button class="card-button" onclick="window.location.href = '<?=base_url("user/value_cart")?>'">Build Value Cart</button>
                                 </div>
                                 <div class="value-cart-feature-image">
                                    <img src="<?= base_url("assets/img/value-cart.png") ?>" alt="Grocery Assistant Icon" class="img-fluid" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

		
	</div>
</div>

<script>
	$(document).ready(function() {
		localStorage.removeItem('UserId');
		$('#registrationForm').hide();
		$('#registrationForm').css('display', 'none');
		$('#loginForm').hide();
		$('#loginForm').css('display', 'none');
		$('#otpForm').hide();
		$('#otpForm').css('display', 'none');
		$('#phoneVerified').hide();
		$('#phoneVerified').css('display', 'none');
		$('.errorNotify').css('display', 'none');

		// Check Valid Phone Number
		$('#inputPhone').keyup(function(e) {
			var phoneNumber = $('#inputPhone').val();
			var phoneRegEx = /^[0-9]{9}$/;
			if(phoneNumber.match(phoneRegEx)) {
				// if phone is validated
				$('#inputPhone').attr("style", "border-top: 1.3px solid green !important; border-bottom: 1.3px solid green !important; border-right: 1.3px solid green !important;");
				$('#countryCode').attr("style", "border: 1.3px solid green !important; border-right: none !important;");
				$('#dash').attr("style", "border-top: 1.3px solid green !important; border-bottom: 1.3px solid green !important;");
				$('#startingCode').attr("style", "border-top: 1.3px solid green !important; border-bottom: 1.3px solid green !important;");
			}
			else {
				// if phone is not validated
				$('#inputPhone').attr("style", "border-top: 1.3px solid red !important; border-bottom: 1.3px solid red !important; border-right: 1.3px solid red !important;");
				$('#countryCode').attr("style", "border: 1.3px solid red !important; border-right: none !important;");
				$('#dash').attr("style", "border-top: 1.3px solid red !important; border-bottom: 1.3px solid red !important;");
				$('#startingCode').attr("style", "border-top: 1.3px solid red !important; border-bottom: 1.3px solid red !important;");
			}
			console.log(e.keyCode);
			if(e.keyCode == 13)
				$('#phoneSubmit').trigger("click");
			});

		// Phone Verification Submit
		$('#phoneSubmit').click(function() {
			var phoneNumber = $('#inputPhone').val();
			var phoneRegEx = /^[0-9]{9}$/;debugger;
			if(!phoneNumber.match(phoneRegEx)) {
				$.notify("Phone number is wronng", "error");
			}
			else {
				phoneNumber = '923' + phoneNumber;
				$.ajax({
					url: "<?php echo base_url(); ?>Dashboard/phoneVerify",
					method: "POST",
					data: { phone: phoneNumber },
					dataType: "json",
					success: function(data) {
						if(data.success) {
							//responseMessage
							$('.errorNotify').html(`<div style='background-color: #75ff7e; border-radius: 3px; padding:5px;'><small>` + data.responseMessage + `</small></div>`);
							$('.errorNotify').show();
							var currentScreenWidth = $(window).width();
							if(currentScreenWidth <= 576) {
								$('.phoneInputFooterText').remove();
							}
							setTimeout(function() {
								
								$('.errorNotify').hide();
								$('#phoneForm').hide();
								$('#otpForm').show();
								$("#digit-1").focus();
							}, 2000);
						}
						else {
							$.notify(data.responseMessage, "error");
						}

					},
					error: function(data) {
						$.notify(data.responseMessage, "error");
					}
				});
			}
			$("digit-1").select().focus();
		});

		// Submit OTP
		$('#otpSubmit').click(function() {
			var otpCode = $('#digit-1').val() + $('#digit-2').val() + $('#digit-3').val() + $('#digit-4').val();
			var otpRegEx = /^[0-9]{4}$/;
			var phone_number = '923' + $('#inputPhone').val();
			if(!otpCode.match(otpRegEx)) {
				$.notify("OTP should be 4 digit number", "error");
			}
			else {
				$.ajax({
					url: "<?php echo base_url(); ?>Auth2/otpVerify",
					method: "POST",
					data: { code: otpCode, phone: phone_number },
					dataType: "json",
					success: function(data) {
						if(data.status == 'Error') {
							$.notify(data.responseMessage, "error");
						}
						else {
							if(data.loggedInStatus && data.redirectURL == false) {
								// Welcome Screen
								$.notify("Verification completed", "success");
								setTimeout(function() {
									window.location.href = "<?php echo base_url('dashboard/welcome'); ?>";
								}, 2000);
							}
							else {
								// Redirect URL
								$.notify("Verification completed", "success");
								setTimeout(function() {
									window.location.href = decodeURIComponent(data.redirectURL);
								}, 2000);
							}
						}
					},
					error: function(data) {
						$.notify(data.responseMessage, "error");
				}
				});
			}
		});

		$('#inputEmail').keyup(function() {
			if(validateEmail()) {
				// if email is validated
				$('#inputEmail').css("border", "1px solid green");
			}
			else {
				// if email is not validated
				$('#inputEmail').css("border", "1px solid red");
			}
		});

		$('#inputLoginEmail').keyup(function() {
			if(validateEmail()) {
				// if email is validated
				$('#inputLoginEmail').css("border", "1px solid green");
			}
			else {
				// if email is not validated
				$('#inputLoginEmail').css("border", "1px solid red");
			}
		});
		
		// Register User
		$('#userRegistrationForm').on('submit', function(event) {
			event.preventDefault();
			$('#userId').val(localStorage.getItem('UserId'));
			
			if(!$('#inputName').val()) { $('#inputName').css("border", "1px solid red"); }
			else { $('#inputName').css("border", "1px solid green"); }

			if(!$('#inputEmail').val()) { $('#inputName').css("border", "1px solid red"); }
			else { $('#inputEmail').css("border", "1px solid green"); }

			if(!$('#inputAddress').val()) { $('#inputName').css("border", "1px solid red"); }
			else { $('#inputAddress').css("border", "1px solid green"); }

			if(!$('#inputPassword').val()) { $('#inputName').css("border", "1px solid red"); }
			else { $('#inputPassword').css("border", "1px solid green"); }

			if(!$('#inputConfirmPassword').val()) { $('#inputName').css("border", "1px solid red"); }
			else { $('#inputConfirmPassword').css("border", "1px solid green"); }

			if(!$('#inputName').val() || !$('#inputEmail').val() || !$('#inputAddress').val() || !$('#inputPassword').val() 
				|| !$('#selectCountry') || !$('#selectCity') || !$('#inputConfirmPassword').val()) {

				$('.errorNotify').html("<div style='background-color:#ffcccb; border-radius:3px; color:red; padding:5px;'><i class='fas fa-times-circle mr-3'></i><small>Please fill all the fields</small></div>");
				$('.errorNotify').css('display', 'block');
				setTimeout(function() {
					$('.errorNotify').hide();
				}, 2000);
				
			}
			else {
				$.ajax({
					url: "<?php echo base_url(); ?>Auth2/updateUserRegistration",
					method: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(data) {
						if(data.status == 'Error') {
							$('.errorNotify').html("<div style='background-color:#ffcccb; border-radius:3px; color:red; padding:5px;'><i class='fas fa-times-circle mr-3'></i><small>" + data.response + "</small></div>");
							$('.errorNotify').css('display', 'block');
							setTimeout(function() {
								$('.errorNotify').hide();
							}, 2000);
						}
						else {
							$('.errorNotify').html(`<div style='background-color: #75ff7e; border-radius: 3px; padding:5px;'><i class='fas fa-check-square mr-3'></i><small>` + data.response + `</small></div>`);
							$('.errorNotify').css('display', 'block');
							setTimeout(function() {
								$('.errorNotify').hide();
							}, 2000);

							if(data.user_details_available) {
								if(!data.redirectUrl) {
									window.location.href = "<?php echo base_url(); ?>Dashboard";	
								}
								else {
									window.location.href = decodeURIComponent(data.redirectURL);
								}
								$('#userId').val(localStorage.removeItem('UserId'));
							}

							$('#registrationForm').hide();
							$('#registrationForm').css('display', 'none');
							$('#userId').val(localStorage.removeItem('UserId'));
							if(!data.redirectUrl)
								window.location = "<?php echo base_url(); ?>Dashboard";
							else
								window.location.href = decodeURIComponent(data.redirectURL);
						}
					},
					error: function(data) {
						$('.errorNotify').html("<div style='background-color:#ffcccb; border-radius:3px; color:red; padding:5px;'><i class='fas fa-check-square mr-3'></i><small>" + data.response + "</small></div>");
						$('.errorNotify').css('display', 'block');
						setTimeout(function() {
							$('.errorNotify').hide();
						}, 5000);
					}
				});
			}
		});

		// Login User
		$('#userLoginForm').on('submit', function(event) {
			event.preventDefault();

			if(!$('#inputLoginEmail').val()) { $('#inputLoginEmail').css("border", "1px solid red"); }
			else { $('#inputLoginEmail').css("border", "1px solid green"); }

			if(!$('#inputLoginPassword').val()) { $('#inputLoginPassword').css("border", "1px solid red"); }
			else { $('#inputLoginPassword').css("border", "1px solid green"); }

			if(!$('#inputLoginEmail').val() && !$('#inputLoginPassword').val()) {
				$('.errorNotify').css('display', 'block');
				setTimeout(function() {
					$('.errorNotify').hide();
				}, 5000);
				$('.errorNotify').html("<small style='color: red;'>Error! Please fill all fields</small>");
			}
			else {
				$.ajax({
					url: "<?php echo base_url(); ?>Auth2/login",
					method: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(data) {
						if(data.status == 'Error') {
							$('.errorNotify').html("<div style='background-color:#ffcccb; border-radius:3px; color:red; padding:5px;'><i class='fas fa-times-circle mr-3'></i><small>" + data.response + "</small></div>");
							$('.errorNotify').css('display', 'block');
							setTimeout(function() {
								$('.errorNotify').hide();
							}, 2000);
						}
						else {
							$('.errorNotify').html(`<div style='background-color: #75ff7e; border-radius: 3px; padding:5px;'><i class='fas fa-check-square mr-3'></i><small>` + data.response + `</small></div>`);
							$('.errorNotify').css('display', 'block');
							setTimeout(function() {
								$('.errorNotify').hide();
							}, 2000);

							setTimeout(function() {
								if(!data.redirectUrl) {
									$("#userLoginForm").trigger("reset");
								 	window.location = "<?php echo base_url(); ?>Dashboard"; 
								}
								else {
									window.location = decodeURIComponent(data.redirectURL); 	
								}
							}, 2000);
						}
					},
					error: function(data) {
						$('.errorNotify').html("<div style='background-color:#ffcccb; border-radius:3px; color:red; padding:5px;'><i class='fas fa-times-circle mr-3'></i><small>" + data.response + "</small></div>");
						$('.errorNotify').css('display', 'block');
						setTimeout(function() {
							$('.errorNotify').hide();
						}, 2000);
					}
				});
			}		

		});

		// Logout
		$('#userLoggedOut').click(function() {
			window.location = "<?= base_url(); ?>Auth2/logout";
		});

		$('#RegisterSwitch').click(function() {
			$('#loginForm').hide();
			// $('#loginForm').css('z-index', '-10');
			$('#phoneForm').show();
			// $('#registrationForm').css('z-index', '1');
		});

		$('#SigninSwitch').click(function() {
			$('#registrationForm').hide();
			// $('#registrationForm').css('z-index', '1');
			$('#loginForm').show();
			// $('#loginForm').css('z-index', '-10');
		});

		$('#resendCode').click(function() {
			$('#digit-1').val('');
			$('#digit-2').val('');
			$('#digit-3').val('');
			$('#digit-4').val('');

			$('#otpForm').hide();
			$('#phoneForm').show();
		});


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

</script>