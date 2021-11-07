<?php

$CI = & get_instance();
$CI->load->model('Users');
$users = $CI->Users->profile_edit_data();

if(is_array($users) && !empty($users[0])){
  $users = $users[0];
}else{
  $users = null;
}
$CI->load->library('lcategory');
$menuCatList = $CI->lcategory->get_category_hierarchy();
?>

<div class="sidebar-menu">


        <?php if(!is_null($users)){?>
          <div class="card border-none">
              <div class="card-header px-4 py-2">
                  <div class="card-header p-0 sidebar-menu-title" id="headingOne">
                      <a href="<?=base_url("User/edit_profile")?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                          <img src="<?php echo base_url() ?>assets/img/profile.png" class="d-inline pr-4" alt="">
                          <h4 class="d-inline">Profile</h4>
                      </a>
                  </div>
              </div>
          </div>
          <div class="card border-none">
              <div class="card-header px-4 py-2">
                  <div class="card-header sidebar-menu-title p-0" id="headingOne">
                      <a href="<?=base_url('Corder/my_order')?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                          <img src="<?php echo base_url() ?>assets/img/my_order_history.png" class="d-inline pr-4" alt="">
                          <h4 class="d-inline">My Order History</h4>
                      </a>
                  </div>
              </div>
          </div>
          <div class="card border-none">
              <div class="card-header px-4 py-2">
                  <div class="card-header sidebar-menu-title p-0" id="headingOne">
                      <a href="<?=base_url('Corder/track_order_form')?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                          <img src="<?php echo base_url() ?>assets/img/track_your_order.png" class="d-inline pr-4" alt="">
                          <h4 class="d-inline">Track Your Order</h4>
                      </a>
                  </div>
              </div>
          </div>
        <?php } ?>
        <div class="card border-none">
            <div class="card-header px-4 py-2" id="headingTwo">
                <div class="card-header sidebar-menu-title p-0" id="headingOne">
                    <a href="tel:+92 318 2294472" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                        <img src="<?php echo base_url() ?>assets/img/call_us.png" class="d-inline pr-4" alt="">
                        <h4 class="d-inline">Call Us</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="card border-none">
            <div class="card-header px-4 py-2">
                <div class="card-header sidebar-menu-title p-0" id="headingOne">
                    <a href="<?= is_null($users) ? base_url('Dashboard/user_authentication') : base_url('Dashboard/logout') ; ?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                        <img src="<?php echo base_url() ?>assets/img/sign-in.png" class="d-inline pr-4" alt="">
                        <?php if(is_null($users)){?>
                           <h4 class="d-inline">Sign In</h4>
                        <?php } else{?>
                           <h4 class="d-inline">Sign Out</h4>
                        <?php } ?>
                    </a>
                </div>
            </div>
        </div>

</div>