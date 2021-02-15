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
<h4 class="sidebar-heading border-b-primary font-size-22" data-toggle="collapse" data-target="#collapseTow" aria-expanded="true" aria-controls="collapseTow">Shop Categories</h4>

<div class="sidebar-menu">
    <div class="accordion border-b-primary" id="accordionExample">
        <div class="card border-none">
    
            <div id="collapseTow" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body p-0">
                   <ul class="sidebar-menu-items navbar-nav mb-3 leftmenu">
                    <?php //echo '<pre>';print_r($menuCatList);die; 
                    foreach($menuCatList as $key => $value) {?>
                       <li>
                        <a class="inner-category-heading" href="<?=base_url('Cproduct/products?categoryId='.$value->catId) ?>"><?=$key?></a>
                          <?php foreach($value->childCats as $key => $value2) {?>
                             <div class="inner-category">
                                <a href="<?=base_url('Cproduct/products?categoryId='.$value2['CategoryId']) ?>"><span class="hyphen">—</span><span class="cat-text"><?=$value2['Alias']?></span></a>
                              </div>
                          <?php } ?>
                        </li>
                    <?php } ?>
                   </ul>
                </div>
            </div>
        </div>
      </div>

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