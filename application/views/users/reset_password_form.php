<style>
#passwordResetForm {
    width: 100%;
}
</style>

<section id="reset_password">
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
            <form id="passwordResetForm" method="post" style="width:100%;">
               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputEmailVerifyContainer">
                  <i class="fas fa-lock" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>

               <div class="m-3" style="border-bottom: 1px solid #B6B6B6; position: relative; width: 97%; padding: 8px;" id="inputEmailVerifyContainer">
                  <i class="fas fa-lock" style="position: absolute; top:22px; left: 12px; color: #B6B6B6;"></i>
                  <input type="password" name="inputConfirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" style="padding: 6px 6px 6px 42px; border:none; width: 98%; font-weight: 500;" autocomplete="off" autofocus>
               </div>

               <input type="hidden" id="userEmail" value="<?php echo $email; ?>">
                              
               <input type="submit" value="Reset Password" name="passwordResetBtn" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px;" class="py-2">
               <!-- <button href="javascript:void(0)" id="resetPassword" style="width:97%; background-color: var(--main-color); border-radius:2px; color: #fff; border: none; font-size: 18px; margin-top: 40px;" class="py-2">Reset Password</button> -->
            </form>
         </div>
      </div>
   </div>
</section>

<script>
    $(document).ready(function() {
        $('#passwordResetForm').on('submit',function(event) {
            debugger;
            event.preventDefault();
            $password = $('#inputPassword').val();
            $confirmPassword = $('#inputConfirmPassword').val();
            if($password != $confirmPassword) {
                alert("Confirm password doesn't match");
            }
            else {
                try {debugger;
                    $.ajax({
                        url: '<?php echo base_url();?>user/updatePassword',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            email: $('#userEmail').val(),
                            password: $password
                        },
                        success: function(data) {
                            alert(data.message);
                        }
                    });
                }
                catch(err) {
                    console.log(err);
                }
            }
        });
    }
</script>

