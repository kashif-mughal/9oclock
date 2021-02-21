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
               <div class="col-lg-2 col-md-6 col-sm-8 mb-sm-4 mb-md-2 mb-lg-0 col-8 order-1 text-center">
                  <div class="logo-container d-flex flex-row align-item-center 
                     justify-content-end justify-content-md-end justify-content-sm-center">
                     <div class="logo ml-2">
                        <div style="cursor: pointer;" class="logo_content text-center" onclick="window.location.href = '<?=base_url();?>'">
                           <img src="<?php echo base_url() ?>assets/img/logo-white.png" alt="Sauda Express" class="img-fluid d-block">
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
                  <div class="col-lg-2 col-md-6 col-sm-4 mb-sm-2 order-lg-3 order-2 text-lg-left text-right col-4">
                     <div class="phone_cart d-flex flex-row align-item-center 
                        justify-content-between justify-content-md-between justify-content-sm-between">
                        <!-- Phone -->
                        <div class="phone ml-1 d-flex flex-row align-item-center justify-content-start">
                           <!-- <div class="phone_icon mr-2">
                              <a href="tel:+92 318 2294472">
                                 <img src="<?php //echo base_url() ?>assets/img/hotline_phone_icon.png" alt="">
                              </a>
                           </div>
                           <div class="phone_content text-white">
                              <div class="phone_text">
                                 <h6 class="mb-0">Hotline</h6>
                              </div>
                              <div class="phone_number">
                                 <h6 class="font-weight-bold">+92 318 2294472</h6>
                              </div>
                           </div> -->

                           <i class="fas fa-user" id="user_icon" style="font-size:30px;"></i>

                        </div>
                        <!-- Cart -->
                        <div class="cart">
                           <div class="cart_container d-flex flex-row align-item-center justify-content-start">
                              <!-- Cart Icon -->
                              <div class="cart_icon">
                                 <a href="<?php echo base_url() ?>corder/cart_page" id="cartBtn" data-toggle="" data-target="#shoppingCartModal">
                                    <img src="<?php echo base_url() ?>assets/img/basket.png" alt="" id="basket-img">
                                    <div class="cart_icon_text">
                                       <span id="add_to_cart_items" class="badge badge-pill badge-light b-r-50">0</span>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                        
                        <div class="sidebar-button">
                           <button class="navbar-toggler h-100" id="btn-sidebar" type="button" data-toggle="collapse"
                                 data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                 aria-expanded="false" aria-label="Toggle navigation">
                                 <img src="<?php echo base_url() ?>assets/img/toggler_icon.png">
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


<?php
   if($PageName == 'Home') {
      $this->load->view('include/banner', $BannerImages); 
   }
?>

<div class="wrapper">

<!-- Shopping Cart Modal End -->

<!-- Cart Scripts Start -->

<script type="text/javascript">
   const currency = 'Rs';
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
      }else{
         $($(allProducts[i]).find('.remove-cart')[0]).hide();
         $($(allProducts[i]).find('.quantity')[0]).val('');
         $($(allProducts[i]).find('.add-cart')[0]).html('Add to Cart');
      }
   }
   $('#add_to_cart_items').html(cart.length);
}
function changeQtyOfProductAndPutInCart(targetElem, operation){
   var prodContainer = $(targetElem.closest('.each-prod')[0]);
   var prodCountObj = prodContainer.find('.quantity')[0];
   if(!prodCountObj || isNaN(prodCountObj.value)){
      $.notify(`Please add a valid quantity`, "error");
      return false;
   }
   else{
      var qty = prodCountObj.value == "" ? 0 : prodCountObj.value;
      if(qty <= 0 && operation == 'minus')
         return false;
      prodCountObj.value = operation == 'plus' ? ++qty : --qty;
      var addCartObj = $(prodContainer.find('.add-cart')[0]);
      if(addCartObj.html().toLocaleLowerCase() == 'add to cart'){
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
   currentElem.closest('tr').remove();
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
  });
  $(document).ready(function(){
    var allTxt = $(".card-text, .product-card-title");
    for (var i = 0; i < allTxt.length; i++) {
      $(allTxt[i]).attr("data-toggle", "tooltip");
    }
    $('[data-toggle="tooltip"]').tooltip();
  });

  function WindowsResizeFunc() {
    if ($(window).width() >  768) {
      $(".edibles-main .product-category").addClass('show');
      $(".filter-brand-button").addClass('show');
      $(".filter-weight-button").addClass('show');
      $(".filter-type-checkbox").addClass('show');
      $("#InnerPageMenuContent").addClass('show');
    }
    else {
      $(".edibles-main .product-category").removeClass('show');
      $(".filter-brand-button").removeClass('show');
      $(".filter-weight-button").removeClass('show');
      $(".filter-type-checkbox").removeClass('show');
      $("#InnerPageMenuContent").removeClass('show');
    }
  }
</script>
<!-- Auto Complete search script END-->
 