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
<style type="text/css">
   .emptyCart{
      background: red;
      padding: 20px;
      margin: 35px;
      text-align: center;
      border-radius: 10px;
      color: white;
      font-weight: 400;
      font-size: 20px;
      min-width: 360px;
   }
   .nothing-to-show{
    background: #cc0808;
    color: white;
    border-radius: 4px;
    padding: 10px;
    text-align: center;
   }
   .left-menu-head{
    padding: 20px 40px !important;
   }
   .error{
    color: red;
   }
   .select2-container--default .select2-results__option--highlighted[aria-selected]{
    background-color: var(--secondary-color);
   }
</style>

<!-- Script for the use of auto complete search START-->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Script for the use of auto complete search  END-->
<!-- Sidebar -->
    
    <div id="mySidenav" class="sidenav">
        <div class="sidenav-content">
            <a href="javascript:void(0)" class="closebtn" id="btn-close-sidebar">&times;</a>
            <h3 class="sidebar-heading"><?php echo !is_null($users) ? "Welcome, ".$users['first_name'].'&nbsp;'.$users['last_name'] : "<a href='".base_url()."account/login'>Login or Register</a>"?></h3>

            <div class="sidebar-menu">
                <div class="accordion border-b-primary" id="accordionExample">
                    <div class="card border-none">
                        <div class="card-header p-2 sidebar-menu-title p-0" id="headingOne">
                            <a href="javascript:void(0)" class="btn-block d-flex align-items-center p-0" type="button" data-toggle="collapse" 
                                data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <img src="<?php echo base_url() ?>assets/img/sidenav-toggle.png" class="d-inline pr-4" alt="">
                                <h4 class="d-inline">Shop Categories</h4>
                                <img src="<?php echo base_url() ?>assets/img/sidenav-chevron.png" class="d-inline ml-auto" alt="">  
                            </a>
                        </div>
                
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body p-0">
                               <ul class="sidebar-menu-items navbar-nav mb-3 ml-4">
                                <?php foreach($menuCatList as $key => $value) {?>
                                   <li><a target="_blank" href="<?=base_url('Cproduct/products?categoryId='.$value->catId) ?>"><?=$key?></a></li>
                                <?php } ?>
                               </ul>
                            </div>
                        </div>
                    </div>

                  </div>

                    <?php if(!is_null($users)){?>
                       <div class="card border-none">
                           <div class="card-header p-2" id="headingTwo"> 
                               <div class="card-header sidebar-menu-title p-0" id="headingOne">
                                   <a href="<?=base_url("User/edit_profile")?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button">
                                       <img src="<?php echo base_url() ?>assets/img/profile.png" class="d-inline pr-4" alt="">
                                       <h4 class="d-inline">Profile</h4>
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="card border-none">
                           <div class="card-header p-2" id="headingTwo">
                               <div class="card-header sidebar-menu-title p-0" id="headingOne">
                                   <a href="<?=base_url("Corder/my_order")?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button"
                                       >
                                       <img src="<?php echo base_url() ?>assets/img/my_order_history.png" class="d-inline pr-4" alt="">
                                       <h4 class="d-inline">My Order History</h4>
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="card border-none">
                           <div class="card-header p-2" id="headingTwo">
                               <div class="card-header sidebar-menu-title p-0" id="headingOne">
                                   <a href="<?=base_url("Corder/track_order_form")?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button"
                                       >
                                       <img src="<?php echo base_url() ?>assets/img/track_your_order.png" class="d-inline pr-4" alt="">
                                       <h4 class="d-inline">Track Your Order</h4>
                                   </a>
                               </div>
                           </div>
                       </div>
                    <?php }?>
                    <div class="card border-none">
                        <div class="card-header p-2" id="headingTwo">
                            <div class="card-header sidebar-menu-title p-0" id="headingOne">
                                <a href="tel:+92 318 2294472" class="btn-block bg-transparent d-flex align-items-center p-0" type="button"
                                    >
                                    <img src="<?php echo base_url() ?>assets/img/call_us.png" class="d-inline pr-4" alt="">
                                    <h4 class="d-inline">Call Us</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card border-none">
                        <div class="card-header p-2" id="headingTwo">
                            <div class="card-header sidebar-menu-title p-0" id="headingOne">
                                <a href="<?= is_null($users) ? base_url('Dashboard/user_authentication') : base_url('Dashboard/logout') ; ?>" class="btn-block bg-transparent d-flex align-items-center p-0" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                      <div class="card-header sidebar-menu-title p-0 text-left" id="headingOne">
                     <h4>Follow Us</h4>
                  </div>
                  <div class="row" style=" margin-left: 0px;">
                     <a href="https://www.facebook.com/saudaexpresspk"><i class="fab fa-facebook-square fa-1x"></i></a>
                     <div class="socialmedia-footer">|</div>
                     <a href="https://twitter.com/saudaexpresspk"><i class="fab fa-twitter-square fa-1x"></i></a>
                      <div class="socialmedia-footer">|</div>
                     <a href="#"><i class="fab fa-whatsapp-square fa-1x"></i></a>
                  </div>

            </div>
        </div>
    </div>
    
    <!-- Sidebar -->

<!-- Sidebar Ends -->


<div class="section-head" style="position: fixed; top: 0; width: 100%; z-index: 21;">
      <div class="top-bar">
         <div class="container">
            <div class="row">
               <nav class="navbar navbar-expand-sm ml-md-auto px-2 px-md-0">
                  <ul class="navbar-nav">
                    <?php if(!is_null($users)){?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("User/edit_profile");?>">My Account</a>
                     </li>
                     <li>
                        <p class="seperator">|</p>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("Corder/track_order_form")?>">Track your order</a>
                     </li>
                     <li>
                        <p class="seperator">|</p>
                     </li>
                       <li class="nav-item">
                          <a class="nav-link" href="<?=base_url("Corder/my_order")?>">Order History</a>
                       </li>
                     <?php if($_SESSION['user_type'] == 1){?>
                      <li>
                        <p class="seperator">|</p>
                     </li>
                       <li class="nav-item">
                          <a class="nav-link" href="<?=base_url("Admin_dashboard")?>">Admin Panel</a>
                       </li>
                     <?php } ?>
                     <li>
                        <p class="seperator">|</p>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().'Dashboard/logout'?>">Logout</a>
                     </li>
                   <?php }else{?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=base_url().'Dashboard/user_authentication'?>">Register Or Login</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#userAccount" role="button" data-toggle="modal">Sign in Modal</a>
                     </li>
                   <?php } ?>
                  </ul>
               </nav>
            </div>
         </div>
      </div>
      <div class="main-nav bg-light">
         <div class="container">
            <div class="row align-items-center py-1 py-md-2 pb-sm-0">
               <!-- Brand Logo & Sidebar Button -->
               <div class="col-lg-2 col-md-9 col-sm-9 mb-sm-4 mb-md-2 mb-lg-0 col-8 order-1 text-center">
                  <div class="logo-container d-flex flex-row align-item-center 
                     justify-content-start justify-content-md-start justify-content-sm-start">
                     <div class="logo ml-2">
                        <div style="cursor: pointer;" class="logo_content text-center" onclick="window.location.href = '<?=base_url();?>'">
                           <!-- <img src="<?php //echo base_url() ?>assets/img/logo-white.png" alt="Sauda Express" class="img-fluid d-block"> -->
                           <img src="<?php echo base_url() ?>assets/img/Logo.png" alt="9oClock" class="img-fluid d-block">

                           <!-- <p class="text-white tag-line mb-0">Inventing Tomorrow</p>  -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Brand Logo & Sidebar Button End -->
               <!-- Search Bar -->
               <div class="col-lg-8 col-md-12 col-sm-12 order-lg-2 order-3 text-lg-left text-right align-item-center">
                  <div class="header_search">
                     <div class="header_search_content">
                        <div class="header_search_form_container">
                           <form action="<?=base_url('cproduct/products')?>" method="get">
                              <div class="input-group mb-1">
                                 <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary dropdown-toggle font-weight-400 category-button" type="button"
                                       data-toggle="dropdown">
                                       All
                                       <img src="<?php echo base_url() ?>assets/img/chevron.png" alt="" class="img-fluid">
                                    </button>
                                    <div class="dropdown-menu">
                                      <?php foreach($menuCatList as $key => $value) {?>
                                         <a class="dropdown-item" id="cat-<?=$value->catId?>" onclick="changeSelectedCat(this);" href="javascript:void(0);" data-value="<?=$value->catId?>"><?=$key?></a>
                                      <?php } ?>
                                   </div>
                                 </div>
                                 <input type="text" name="q" id="q" class="form-control font-weight-400 border-none" placeholder="Search here" onfocus="this.value=''">
                                 <div class="input-group-append">
                                    <button class="btn btn-outline-secondary button-primary text-white border-none px-4 font-size-14" type="submit">
                                       <i class="fas fa-search"></i>
                                    </button>
                                 </div>
                              </div>
                              <input type="hidden" name="categoryId" id="categoryId">
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Search Bar Ends -->
                  <!-- Phone Number & Add to Cart Button -->
                  <!-- <div class="col-lg-3 col-md-6 col-sm-5 mb-sm-2 order-lg-3 order-2 text-lg-left text-left pl-1"> -->
                  <div class="col-lg-2 col-md-3 col-sm-3 mb-sm-2 order-lg-3 order-2 col-4">
                     <div class="d-flex justify-content-between align-items-center">

                        <div class="phone_cart">
                           <!-- <i class="fas fa-user" id="user_icon"></i> -->
                           <img src="<?php echo base_url("assets/img/account-icon.png") ?>" alt="">
                        </div>

                        <div class="cart_icon">
                           <a href="<?php echo base_url() ?>corder/cart_page" id="cartBtn" data-toggle="" data-target="#shoppingCartModal">
                              <!-- <img src="<?php //echo base_url() ?>assets/img/basket.png" alt="" id="basket-img"> -->
                              <img src="<?php echo base_url() ?>assets/img/basket.png" alt="" id="basket-img">
                              <div class="cart_icon_text">
                                 <span id="add_to_cart_items" class="badge badge-pill badge-light b-r-50">0</span>
                              </div>
                           </a>
                        </div>

                        <div class="sidebar-button">
                           <button class="navbar-toggler" id="btn-sidebar"
                           class="p-0"
                            type="button" data-toggle="collapse"
                                 data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                 aria-expanded="false" aria-label="Toggle navigation">
                                 <!-- <i class="fa fa-bars"></i> -->
                                 <img src="<?php echo base_url() ?>assets/img/Menu-icon.png" alt="">
                           </button>
                        </div>

                     </div>

                  </div>
               </div>
            </div>
         </div>
   </div>



<!-- Shopping Cart Modal Start -->
<div id="shoppingCartModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body w-100 p-0">
            <div class="card">
               <div class="card-header">
                  Shopping Cart
               </div>
               <div class="emptyCart" style="display: none;">The cart is empty!!!</div>
               <div class="card-body" id="shoppingCartBody">
                  <table class="table table-sm table-bordered table-responsive-md">
                     <thead>
                        <tr>
                           <th>Image</th>
                           <th colspan="3">Product Name</th>
                           <th>Quantity</th>
                           <th colspan="2">Price</th>
                           <th>Total</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                     </tbody>
                  </table>
                  <div class="text-right">
                     <a href="<?php echo base_url() ?>corder/checkout_form" class="checkout-btn btn btn-sm btn-primary">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Checkout
                     </a>
                       <a href="<?php echo base_url() ?>corder/cart_page" class="checkout-btn btn btn-sm btn-primary">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Proceed to Cart Page
                     </a>
                     <a href="javascript:void(0);" onclick="emptyCart();" class="btn btn-sm btn-secondary">
                        <i class="fa fa-trash" aria-hidden="true"></i> Clear
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



  <!-- TESTING ADD TO CART -->

  <div class="modal" id="userAccount" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-full" role="document" style="min-width: 100%; margin: 0; min-height: 100vh;">
      <div class="modal-content" style="min-height: 100vh;">
        <div class="container-fluid">
          <div class="row" style="height: 40vh; background-color: #EFF3F6;">

              <button style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
              </button>

          </div>
          <div class="row justify-content-center" style="background-color: #fff; height: 60vh;">
            <div class="text-center my-3">
               <p class="mb-0" style="font-size: 17px; font-weight: 500;">ACCOUNT</p>
               <p style="font-size: 16px; font-weight: 500; margin-bottom: 10px;">Login to access all the features of 9oClock</p>
               <button style="color: #fff; background-color: #1BAB32; font-size: 17px; font-weight: 500; border-color: #1BAB32; width: 390px; height: 60px;">LOGIN</button>
               <p style="font-size: 16px; font-weight: 500; margin-top: 16px;">Don't have an account?</p>
               <a href="<?=base_url().'Dashboard/user_authentication_email'?>" style="color: #fff; background-color: #1BAB32; font-size: 17px; font-weight: 500; border-color: #1BAB32; padding: 18px 161px;">SIGN UP</a>
            </div>

          </div>
        </div>
      </div>
  </div>
</div> 

<!-- TESTING ADD TO CART ENDS -->




<?php
   if($PageName == 'Home') {
      $this->load->view('include/banner', $BannerImages); 
   }
?>

<div class="wrapper">

<!-- Shopping Cart Modal End -->



    <!-- SEARCHING -->

    <a href="#searchingModal" role="button" class="btn btn-primary pl-0" data-toggle="modal" style="display: none;" id="search-modal-trigger">Launch searchingModal</a>
    <div class="modal" id="searchingModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding:0px !important;">
       <div class="modal-dialog modal-full" role="document" style="min-width: 100%; margin: 0;">
          <div class="modal-content" style="min-height: 100vh;">
             <div class="container-fluid p-0">
                <div class="row d-flex justify-content-start align-items-center" style="background-color: #fff; margin-bottom: 10px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
                   <button style="height: 60px; width: 50px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none;" type="button" class="close pl-3" data-dismiss="modal" aria-label="Close">
                     <i class="fas fa-arrow-left" style="color: var(--secondary-color); font-size: 20px;"></i>
                   </button>
                   <div style="border: 1px solid #ccc; position: relative; width: 82%; border-radius: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
                      <i class="fa fa-search" style="position: absolute; top:12px; left: 10px; color: var(--secondary-color);"></i>
                      <input id="q2" type="text" class="form-control" placeholder="Search" style="padding: 6px 6px 6px 34px; border:none; width: 98%; border-radius: 20px; font-weight: 600;">
                   </div>
                </div>
                <div id="products-area" style="padding:0px 20px; background-color: #EFF3F6;">
                  
                </div>
             </div>
          </div>
       </div>
    </div>


    <!-- SEARCHING ENDS -->


<script type="text" id="clone-cart">
  <div class="row" style="background-color: #fff; padding: 8px 0px; margin-bottom:10px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px; border-radius: 5px;">
     <a href="javascript:void(0)" class="d-flex justify-content-between align-items-between" style="width: 100%; text-decoration: none;">
        <div class="d-flex justify-content-between align-items-between" style="width: 100%;">
           <div class="d-flex justify-content-between align-items-center" onclick="location.href='{productId}'" style="position:relative; width:100%;">
              <img src="{imgUrl}" alt="" style="width: 100px; max-width: 100px;">
              <div class="d-flex flex-column justify-content-between align-items-stretch" style="height:100%; width:100%;">
                 <div>
                    <p class="mb-1" style="color: #333; font-size:17px; font-weight:600;">{productName}</p>
                    <p style="color: #A9A9A9; font-size: 15px; font-weight: 500;">{unitName}</p>
                 </div>
                 <i class="fas fa-chevron-right" style="color: var(--secondary-color); font-size: 20px; margin-bottom: 30px; position:absolute; top: 45px; right: 19px;"></i>
                 <div class="d-flex justify-content-between align-items-between" style="height:100%;">
                     <div>
                        <p class="info-bottom mb-0" style="font-size:14px; font-weight: 600; color: #red; text-decoration: line-through;">{priceString}</p>
                        <p class="info-bottom mb-0" style="font-size:15px; font-weight: 600; color: var(--secondary-color);">{salePrice}</p>
                     </div>
                     <button style="background-color: var(--secondary-color); color: #fff; border:none; border-radius: 10px; font-size: 15px; font-weight: 600; margin-right: 10px; ">
                     ADD TO CART
                     </button>
                  </div>
              </div>
               
           </div>
           
        </div>
     </a>
  </div>
</script>


<!-- Cart Scripts Start -->

<script type="text/javascript">
  //€  £
   const currency = '€';
   function getCookie(name) {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if(parts.length > 1){
         while(parts.length == 1)
            parts.shift();
         return (parts.pop()).split(";")[0];
      }
   }
   function formatCurrency(total, toFixed = 2) {
     var neg = false;
     if(total < 0) {
       neg = true;
       total = Math.abs(total);
    }
    return (neg ? `-${currency} ` : `${currency} `) + parseFloat(total, 10).toFixed(toFixed).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
 }
 $(document).ready(() => {
  var urlVars = getUrlVars();
  var searchText = urlVars["q"];
  if(searchText){
    $("#q").val(searchText.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' '));
  }
  var selectedCat = urlVars["categoryId"];
  if(selectedCat){
    $("#cat-" + selectedCat).trigger("click");
  }
   loadCartData();
   $(document).on('keydown', '.quantity', function () {
      if(event.keyCode == 189)
        return false;
   });
   $(document).on('click', '.remove-item-from-cart', function () {
      removeItemFromShoppingCart($(this));
   });
//   $(document).on('click', '#cartBtn', function () {
//       loadShoppingCart();
//   });
   $(document).on('click', '.remove-cart', function () {
      var productJson = $(this).data('json');
      removeAndUpdateFromCart(productJson, $(this));
   });
   $(document).on('click', '.add-cart', function () {
       var productJson = $(this).data('json');
       var quantity = parseInt($(this).parent().parent().parent().find('.quantity')[0].value);
       if(!isNaN(quantity) && quantity > 0){
         var cart = getCookie('baskit');
         if(cart)
            cart = JSON.parse(cart);
         addOrUpdateCart(cart && cart.length > 0 ? cart : [], productJson, quantity, $(this))

      }else{
         $.notify("Select a valid quantity, quantity must be greater then 0", "error");
      }
   });
   $(document).on('click', '.qty-pls', function () {
      changeQtyOfProductAndPutInCart($(this), 'plus');
   });
   $(document).on('click', '.qty-mns', function () {
      changeQtyOfProductAndPutInCart($(this), 'minus');
   });
});
 function addOrUpdateCart(cart, productJson, quantity, addCartObj){
   var currentProduct = cart.filter((each)=>{return each.id == productJson.id});
   var oldQty = 0;
   if(currentProduct.length > 0){
      oldQty = currentProduct[0].quantity;
      currentProduct[0].quantity = quantity;
   }
   else{
      productJson.quantity = quantity;
      cart.push(productJson);
   }
   document.cookie = `baskit=${JSON.stringify(cart)};path=/;`;
   if(currentProduct.length > 0)
      $.notify(`${productJson.pName} quantity updated from ${oldQty} to ${currentProduct[0].quantity}`, "success");
   else
      $.notify(`${productJson.pName} added into cart`, "success");
   $('#add_to_cart_items').html(cart.length);
   $(addCartObj.parent().find('.remove-cart')[0]).show();
   addCartObj.html('Update to Cart');
   if($(addCartObj.parent().find('.remove-cart')[0]).hasClass('remove-cart-main')){
      addCartObj.hide();
   }
   return true;
}
function removeAndUpdateFromCart(productJson, removeCartObj){
   var cart = getCookie('baskit');
   if(!cart)
      return true;
   cart = JSON.parse(cart);
   var cartExceptCurrentProduct = cart.filter((each)=>{return each.id != productJson.id});
   var cookieString = `baskit=${JSON.stringify(cartExceptCurrentProduct)};path=/;`;
   if(cartExceptCurrentProduct.length == 0){
      var oldDt = new Date(1);
      cookieString += `expires=${oldDt}`;
   }
   document.cookie = cookieString;
   $('#add_to_cart_items').html(cartExceptCurrentProduct.length);

   // removeCartObj.hide();
   // $(removeCartObj.parent().find('.quantity')[0]).val('');
   // $(removeCartObj.parent().find('.add-cart')[0]).html('Add to Cart');

   loadCartData();
   $.notify(`${productJson.pName} removed from cart`, "warn");
   return true;
}
function loadCartData(){
   var cart = getCookie('baskit');
   if(!cart)
      cart = '[]';
   cart = JSON.parse(cart);
   var allProducts = $('.each-prod');
   for (var i = 0; i < allProducts.length; i++) {
      var productJson = $($(allProducts[i]).find('.add-cart')[0]).data('json');
      if(!productJson)
         continue;
      var currentProduct = cart.filter((each)=>{return each.id == productJson.id});
      if(currentProduct.length > 0){
         $($(allProducts[i]).find('.remove-cart')[0]).show();
         $($(allProducts[i]).find('.quantity')[0]).val(currentProduct[0].quantity);
         $($(allProducts[i]).find('.add-cart')[0]).html('Update to Cart');
         if($($(allProducts[i]).find('.remove-cart')[0]).hasClass('remove-cart-main')){
            $($(allProducts[i]).find('.add-cart')[0]).hide();
         }
      }else{
         $($(allProducts[i]).find('.remove-cart')[0]).hide();
         $($(allProducts[i]).find('.quantity')[0]).val('');
         $($(allProducts[i]).find('.add-cart')[0]).html('Add to Cart');
         if($($(allProducts[i]).find('.remove-cart')[0]).hasClass('remove-cart-main')){
            $($(allProducts[i]).find('.add-cart')[0]).show();
         }
      }
   }
   $('#add_to_cart_items').html(cart.length);
}
function changeQtyOfProductAndPutInCart(targetElem, operation){
   var prodContainer = $(targetElem.closest('.each-prod')[0]);
   var prodCountObj = prodContainer.find('.quantity')[0];
   if((!prodCountObj || isNaN(prodCountObj.value)) && prodCountObj.tagName == 'INPUT'){
      $.notify(`Please add a valid quantity`, "error");
      return false;
   }
   else{
      var qty = prodCountObj.value == "" ? 0 : prodCountObj.value;
      if(prodCountObj.tagName == 'P'){
        var tempQty = parseInt(prodCountObj.innerHTML);
        if(!isNaN(tempQty)){
          qty = tempQty;
        }
        else{
          qty = 0;
        }
      }
      if(qty <= 0 && operation == 'minus')
         return false;
      prodCountObj.value = operation == 'plus' ? ++qty : --qty;
      if(prodCountObj.tagName == "P")
        prodCountObj.innerHTML = qty;
      var addCartObj = $(prodContainer.find('.add-cart')[0]);
      if(addCartObj && addCartObj.html() && addCartObj.html().toLocaleLowerCase() == 'add to cart'){
         return true;
      }
      var cart = getCookie('baskit');
      if(cart)
         cart = JSON.parse(cart);

      var dataJson = null;
      dataJson = addCartObj.data('json');
      if(!dataJson){
        var currentProdId = addCartObj.attr("pId");
        dataJson = cart.filter(function(each){return each.id == currentProdId});
        if(dataJson.length > 0)
          dataJson = dataJson[0];
      }
      if(qty == 0){
        prodContainer.remove();
        removeAndUpdateFromCart(dataJson, $(prodContainer.find('.remove-cart')[0]));
        return true;
      }else{
         addOrUpdateCart(cart && cart.length > 0 ? cart : [], 
            dataJson, 
            qty,
            addCartObj
            );
         return true;
      }
   }
}
function removeItemFromShoppingCart(currentElem){
   var productId = parseInt(currentElem.data('id'));
   var prodName = currentElem.data('name');
   var cart = getCookie('baskit');
   if(cart)
      cart = JSON.parse(cart);
   var cartExceptCurrentProduct = cart.filter((each)=>{return each.id != productId});
   var cookieString = `baskit=${JSON.stringify(cartExceptCurrentProduct)};path=/;`;
   if(cartExceptCurrentProduct.length == 0){
      var oldDt = new Date(1);
      cookieString += `expires=${oldDt}`;
   }
   document.cookie = cookieString;
   currentElem.closest('.cart-single-elem').remove();
   $.notify(`${prodName} removed from cart`, "warn");
   if(cartExceptCurrentProduct.length == 0){
      var cartObj = $('#shoppingCartBody');
      if(cartObj && cartObj.length > 0)
         showEmptyResponse($(".cart-page"))
   }
   else{
    var totalP = 0;
    for (var i = 0; i < cartExceptCurrentProduct.length; i++) {
      totalP += parseInt(cartExceptCurrentProduct[i].price) * parseInt(cartExceptCurrentProduct[i].quantity);
    }
    $('#Grand-Total').html(totalP);
   }
   loadCartData();
}

   function showEmptyResponse(cartBody){
      if(cartBody)
        $(cartBody).hide();
      if(cartBody && cartBody[0])
        $(cartBody[0]).hide();
      $($('.empty-cart-page')[0]).show();
      $(document).on('click', '.checkout-btn', handleCheckout(event));
   }
   function handleCheckout(e){
    if(event)
      event.preventDefault();
      return false;
   }
   function emptyCart(){
      var oldDt = new Date(1);
      document.cookie = `baskit=[];path=/;expires=${oldDt}`;
      showEmptyResponse($('.cart-page'));
      loadCartData();
   }
   function changeSelectedCat(currentElem){
      $('#categoryId').val($(currentElem).data('value'));
      $('#q').attr("placeholder" , $(currentElem).text());
   }
   
   function getUrlVars(){
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }
</script>
   <!-- Cart Scripts End -->
<style>
     .ui-autocomplete {
      max-height: 200px;
      overflow-y: auto;
      overflow-x: hidden;
      padding-right: 1px;
      font-size: 13px;
      position: fixed;
      overflow: auto;
   }
</style>
 <!-- Auto Complete search script START-->
<script type='text/javascript'>
  $(document).ready(function(){
     $("#q").autocomplete({
        source: function( request, response )
        {
             $.ajax({
                url: "<?php echo base_url();?>Autocomplete/userdata",
                type: 'post',
                dataType: "json",
                data: {
                  search: request.term
                },
                success: function( data ) 
                {
                  response( data );
                }
             });
        },
        select: function (values, ui) {
             $('#q').val(ui.item.label);
             return false;
        }
     });

    var allTxt = $(".card-text, .product-card-title");
    for (var i = 0; i < allTxt.length; i++) {
      $(allTxt[i]).attr("data-toggle", "tooltip");
    }
    $('[data-toggle="tooltip"]').tooltip();
    $("#q").focusin(function() {
      $('#searchingModal').fadeIn("slow");
      $('#search-modal-trigger')[0].click();
      $('#q2').focus();
    });
  });

  function WindowsResizeFunc() {
    if ($(window).width() >  768) {
      $(".edibles-main .product-category").addClass('show');
      $("#InnerPageMenuContent").addClass('show');
    }
    else {
      $(".edibles-main .product-category").removeClass('show');
      $("#InnerPageMenuContent").removeClass('show');
    }
  }




    $(document).ready(function(){
      $('.modal').off('resize');
        var urlVars = getUrlVars();
        $('#q2').on('keyup', function(e){
           var currentElem = $(this);
            var perpage = 20
            $.ajax({
                url : '<?=base_url("Cproduct/fetch");?>',
                type : 'GET',
                data : {
                    'q' : currentElem.val(),
                    'categoryId' : urlVars['categoryId'],
                    'page': 0,
                    'perpage' : perpage
                },
                dataType:'json',
                success : function(data) {
                    var productArea = $('#products-area');
                    var baseUrl = '<?=base_url()?>';
                    if(!data){
                        productArea.empty();
                    }else{
                        var totalProducts = data.total;
                        data = data.products;
                        var cartTemplate = $('#clone-cart').text();
                        productArea.empty();
                        for (var i = 0; i < data.length; i++) {
                            var discountPercentage = parseInt(((data[i].Price - data[i].SalePrice)/data[i].Price) * 100);
                            var disText = null;
                            if(discountPercentage != 0){
                                var disString = `<h5 class="card-title float-left">${discountPercentage}% OFF</h5>`;
                                var priceString = `<span class="product-discount"><del>${formatCurrency(data[i].Price,0)}</del></span>`;
                            }
                            var cartTemplateCopy = cartTemplate;
                            if(disString)
                                cartTemplateCopy = cartTemplateCopy.replace(/{discountString}/g, disString);
                            else
                                cartTemplateCopy = cartTemplateCopy.replace(/{discountString}/g, "");
                            if(priceString)
                                cartTemplateCopy = cartTemplateCopy.replace(/{priceString}/g, priceString);
                            else
                                cartTemplateCopy = cartTemplateCopy.replace(/{priceString}/g, "");
                            cartTemplateCopy = cartTemplateCopy.replace(/{imgUrl}/g, baseUrl + data[i].ProductImg);
                            cartTemplateCopy = cartTemplateCopy.replace(/{productName}/g, data[i].ProductName);
                            cartTemplateCopy = cartTemplateCopy.replace(/{unitName}/g, !data[i].SaleUnitName ? data[i].UnitName : data[i].SaleUnitQty + " " + data[i].SaleUnitName );
                            cartTemplateCopy = cartTemplateCopy.replace(/{salePrice}/g, formatCurrency(data[i].SalePrice,0));
                            cartTemplateCopy = cartTemplateCopy.replace(/{productId}/g, baseUrl + 'Cproduct/viewProduct/' + data[i].ProductId);
                            pjsonString = {id: data[i].ProductId, pName: data[i].ProductName, price: data[i].SalePrice, img: data[i].ProductImg};
                            cartTemplateCopy = cartTemplateCopy.replace(/{pjsonString}/g, data[i].Jsn);
                            productArea.append(cartTemplateCopy);
                        }
                    }
                },
                error : function(request,error)
                {
                    console.log("Request: " + JSON.stringify(request));
                },
                complete: function(data){
                }
            });
        });
    });






</script>
 