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

<style>
  .table-hover tbody tr:hover{
        background-color: transparent;
    }
   .ui-autocomplete {
      max-height: 200px;
      overflow-y: auto;
      overflow-x: hidden;
      padding-right: 1px;
      font-size: 13px;
      position: absolute;
      overflow: auto;
   }
    .content-box1{
        position: relative;
        background-color: #ffffff;
        margin-top: 28px;
        border-radius: 10px 10px 0 0;
        /* padding: 20px; */
        border: 1px solid #cccccc;
        -moz-transition: opacity 0.4s ease-in-out;
        -o-transition: opacity 0.4s ease-in-out;
        -webkit-transition: opacity 0.4s ease-in-out;
        transition: opacity 0.4s ease-in-out;   
    }
    .content-box2{
        position: relative;
        background-color: #ffffff;
        margin-top: 20px;
        border-radius: 0px 0px 10px 10px;
        padding: 20px;
        border: 1px solid #cccccc;
        width:100%;
        -moz-transition: opacity 0.4s ease-in-out;
        -o-transition: opacity 0.4s ease-in-out;
        -webkit-transition: opacity 0.4s ease-in-out;
        transition: opacity 0.4s ease-in-out;   
    }
    .content-box3{
        position: relative;
        background-color: #ffffff;
        margin-top: 20px;
        border-radius: 0px 0px 10px 10px;
        padding: 28px;
        border: 1px solid #cccccc;
        width: 100%;
        -moz-transition: opacity 0.4s ease-in-out;
        -o-transition: opacity 0.4s ease-in-out;
        -webkit-transition: opacity 0.4s ease-in-out;
        transition: opacity 0.4s ease-in-out;   
    }
    .content-box4{
        position: relative;
        background-color: #ffffff;
        margin-top: 20px;
        /* border-radius: 0px 0px 10px 10px; */
        width: 89%;  
        margin-left: 16px; 
    }
    .row2{
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    }
    .coupon::placeholder {
    font-size: 13px;
    }
    .table>tbody>tr>td, .table>tfoot>tr>td{
        vertical-align: middle;
    }
    @media screen and (max-width: 600px){

        table#cart tbody td .form-control{
            width:20%;
            display: inline !important;
        }
        .actions .btn{
            width:36%;
            margin:1.5em 0;
        }
        
        .actions .btn-info{
            float: left;
        }
        .actions .btn-danger{
            float: right;
        }
        
        table #cart thead{ 
            display: none;
        }
        table #cart tbody td{ 
            display: block;
            padding: .6rem; 
            min-width: 320px;
            }
        table#cart tbody tr td:first-child{ 
            background: #333; 
            color: #fff; 
            }
        table#cart tbody td:before {
            content: attr(data-th);
            font-weight: bold;
            display: inline-block; 
            width: 8rem;
        }
        table#cart tfoot td{
            display:block; 
        }
        table #cart tfoot td .btn{
            display:block;
        }
    }
    .emptycart {
      line-height: 100px;
      height: 400px;
      text-align: center;
    }

    .emptycart p {
      line-height: 1.5;
      display: inline-block;
      vertical-align: middle;
    }
</style>
<script type="text/javascript">$('body').hide();</script>
<div id="main-page" style="display: none;">
        <!-- Bread Crumb -->
        <div class="bread_crumb">
            <div class="container">
                <div class="row d-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                            <li class="breadcrumb-item">Cart</li>
                        </ol>
                    </nav>
                    <h3 class="mb-0">Shopping Cart</h3>
                </div>
            </div>
        </div>

        <!-- Bread Crumb -->


        <section class="cart-page main-content">
            <div class="content-box1" style="margin-left: -3px;" id="shoppingCartBody2">
            </div>
            <div class="container">
                <!-- Alert Message -->
                <?php
                    $message = $this->session->userdata('message');
                    if (isset($message)) {
                        ?>
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $message ?>
                        </div>
                        <?php
                        $this->session->unset_userdata('message');
                    }
                    $error_message = $this->session->userdata('error_message');
                    if (isset($error_message)) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $error_message ?>                    
                        </div>
                        <?php
                        $this->session->unset_userdata('error_message');
                    }
                ?>
                <!-- Alert Message -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="content-box1" style="margin-left: -3px;">
                            <div class="container" id="shoppingCartBody1">
                                <table class="table table-hover table-responsive-md table-condensed">
                                    <thead>
                                        <tr>
                                            <!-- <th colspan="3">Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th> 
                                            <th class="text-center">total</th> -->
                                            <!-- <th style="width: 110px; height:70px ">Image</th> -->
                                            <th colspan="4" style="color: #25bfa9;">Product Name</th>
                                            <th colspan="2" style="text-align: center; color: #25bfa9;">Price</th>
                                            <th style="text-align: center; color: #25bfa9;">Quantity</th>
                                            <th style="text-align: center; color: #25bfa9;">Total</th>
                                            <th style="text-align: center; color: #25bfa9;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row d-none d-md-block">
                          <div class="col-12">
                            <div class="content-box order-box" style="border-radius: 0px 0px 5px 5px;">
                              <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                  <a href="<?=base_url("corder/checkout_form")?>" style="width: 100%; margin-bottom: 3px; color:white; background-color:#25bfa9;" class="btn">Proceed To Checkout</a>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                                    <a href="<?=base_url()?>" class="btn" style="width: 100%;color:white; background-color:#333333;"><i class="fas fa-long-arrow-alt-left"></i> Continue Shopping</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-box order-box">
                                    <h4>Your Order</h4>
                                    <div class="content-box-gray">
                                        <div class="orderbox-header d-flex justify-content-between">
                                            <h6 class="font-weight-600">Subtotal</h6>
                                            <h6 class="subtotal-price font-size-15"></h6>
                                        </div>
                                        <div class="orderbox-content">
                                            <div class="orderbox-content-charges d-flex justify-content-between mb-3">
                                                <h6>Delivery Charges</h6>
                                                <h6 id="dCharges"><script type="text/javascript">document.write(formatCurrency(0));</script></h6>
                                            </div>
                                            <div id="cDiscount" style="display: none;" class="orderbox-content-charges justify-content-between mb-3">
                                                <h6>Coupon Discount</h6>
                                                <h6 id="cDiscountValue"></h6>
                                            </div>
                                            <div class="orderbox-content-footer d-inline-flexbox align-self-start">
                                                <h6>Shipping options will be updated during checkout.</h6>
                                            </div>
        
                                        </div>
                                    </div>
                                    <div class="orderbox-footer d-flex justify-content-between mx-3">
                                        <h6>TOTAL</h6>
                                        <h6 class="total-price font-size-15 sub-total grand-amount"></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-box order-box" style="border-radius: 0px 0px 10px 10px;">
                                    <h3 class="text-center">Apply Coupon Here</h3>
                                    <div class="input-group">
                                        <form method="POST" id="copun-form" action="<?=base_url("Ccopun/apply_copun")?>" style="width: 100%;">
                                            <input name="copun" type="text" class="form-control coupon" placeholder="Enter coupon code here...">
                                            <input type="hidden" name="ov" id="ov">
                                            <div class="input-group-append">
                                                <button class="btn" style="width:100%; margin-top:5px; margin-bottom: 2px; background-color:#333333; color:white;" type="submit">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none d-block d-md-none">
                          <div class="col-md-12">
                            <div class="content-box order-box" style="border-radius: 0px 0px 10px 10px;">
                              <div class="col-md-12">
                                <a href="<?=base_url("corder/checkout_form")?>" style="width: 100%; margin-bottom: 3px; color:white; background-color:#25bfa9;" class="btn">Proceed To Checkout</a>
                              </div>
                              <div class="col-md-12" style="text-align: right;">
                                  <a href="<?=base_url()?>" class="btn" style="width: 100%;color:white; background-color:#333333;"><i class="fas fa-long-arrow-alt-left"></i> Continue Shopping</a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- HOUSEHOLD ESSENTIALS -->

            </div>
        </section>
</div>


    <!-- TESTING ADD TO CART -->
<!-- 
    <a href="#addtoCartModal" role="button" class="btn btn-primary" data-toggle="modal">Launch addtoCartModal</a>
 -->
    <div class="modal" id="addtoCartModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-full" role="document" style="min-width: 100%; margin: 0; min-height: 100vh;">
          <div class="modal-content" style="min-height: 100vh;">
            <div class="container-fluid">
              <div class="row d-flex justify-content-start align-items-center" style="background-color: var(--secondary-color);">
                  <button style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none;" type="button" class="close" aria-label="Close">
                    <i class="fas fa-arrow-left" onclick="history.back();" style="color: #fff; font-size: 20px;"></i>
                  </button>
                  <p class="mb-0" style="font-size: 22px; font-weight: 600; margin-left: 10px; color: #fff;">Cart</p>
              </div>
              <div id="cart-area">
                <section style="display: none; margin-bottom: 10px;" class="empty-cart-page main-content">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="content-box1">
                            <div class="container">
                              <div class="emptycart">
                                <p>
                                  <h3>SHOPPING CART</h3>
                                  <span>You have no items in your shopping cart.</span><br>
                                  <b>
                                    <span>Click <a href="<?=base_url()?>">here</a> to continue shopping.</span>
                                  </b>
                                </p>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </section>
              </div>


              <div class="row d-flex justify-content-start align-items-center py-3 px-3" style="background-color: var(--secondary-color)">
                  <button class="d-flex justify-content-between align-items-center mb-0" style="width: 100%; background-color: transparent; border: none; height: 100%; color: #fff; font-size: 18px;  font-weight: 500;">
                    <a href="<?=base_url("corder/checkout_form")?>" style="color:white;"><p class="mb-0">Checkout</p></a>
                    <div>
                      <p class="d-inline pr-2 grand-amount" style="border-right: 2px solid #fff;"></p>
                      <i class="fas fa-chevron-right" style="color: #fff;"></i>
                    </div>
                  </button>
              </div>

            </div>
          </div>
      </div>
    </div> 
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#addtoCartModal').modal('show');
            $('body').show();
        });
    </script>

    <!-- TESTING ADD TO CART ENDS -->

    <div class="seperatorDiv my-5"></div>


<script type="text/javascript">
    var baskit = getCookie('baskit');
    var selectedAddress = false;
    var deliveryTime = false;
    var step1Verified = true;
    var step2Verified = false;
    var step3Verified = false;
    var step4Verified = true;
    if(!baskit || JSON.parse(baskit).length == 0){
        //window.location.href = '<?=base_url();?>';
        $(".cart-page").hide();
        $('.empty-cart-page').show();
    }
    $(document).ready(() => {
        loadCheckoutCartArea();
        loadShoppingCart1();
    });

    function loadCheckoutCartArea(){
         var cartBody = $('#cartProductsArea');
         cartBody.empty();
         var eachProdTemplate = `<div data-id="{pId}" data-name="{prodName}" class="my-box-order d-flex">
                                    <img src="{imgValue}" alt="" class="img-fluid">
                                    <div class="my-box-order-content ml-3 d-flex flex-column justify-content-center">
                                        <h6>{prodName}  X {qty}</h6>
                                        <h6 class="mt-2 my-order-price">{totalPrice}</h6>
                                    </div>
                                </div>`;
         var cart = getCookie('baskit');
         if(cart){
            cart = JSON.parse(cart);
            var sum = 0;
            for (var i = 0; i < cart.length; i++) {
               var eachProdTemplateCopy = eachProdTemplate;
               sum += parseInt(cart[i].quantity) * parseInt(cart[i].price);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{pId}', cart[i].id);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{imgValue}', cart[i].img);
               eachProdTemplateCopy = eachProdTemplateCopy.replace(/{prodName}/g, `${cart[i].pName} ( ${cart[i].saleUnitQty} ${cart[i].saleUnit} )`);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{qty}', cart[i].quantity);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{totalPrice}', formatCurrency(parseInt(cart[i].quantity) * parseInt(cart[i].price)));
               //append newly created row in card body
               cartBody.append(eachProdTemplateCopy);
            }
            $('.item-counts').html(`${cart.length} ${cart.length > 1 ? 'Items' : 'Item'}`);
            subTotal = sum;
            $('#copun-form #ov').val(subTotal);
             $('.subtotal-price').html(formatCurrency(sum));
             $('.grand-amount').html(formatCurrency(parseFloat(subTotal)));
            if(cart.length >= 15){
                $('#delivery-date').html('Next working day');
            }else{
                $('#delivery-date').html('Today');
            }
         }
         else{
            //show empty message
            return false;
         }
    }   
    
    var subTotal = 0;
    var addressCounter = 1;

    function loadShoppingCart1(){
       var cartBody = $('#shoppingCartBody1');
       var cartBody2 = $('#cart-area');
       var cart = getCookie('baskit');
       $(cartBody.find('tbody')).empty();
       if(cart){
          cart = JSON.parse(cart);
          if(cart.length == 0)
          {
             //show empty response here
             showEmptyResponse($('.cart-page'));
             return;
          }
          //<td style="text-align:center;"><b>{qty}</b></td>
          $(cartBody).show();
          $($('.emptyCart')[0]).hide();
          $(document).off('click', '.checkout-btn', handleCheckout(event));
          var eachProdTemplate1 = `<tr class="each-prod">
          <td class="text-center">
          <img style="width: 110px;" src="{imgValue}" alt="" class="img-fluid">
          </td>
          <td colspan="3">{prodName}</td>
          <td class="" style="text-align: center;" colspan="2"><b>{price}</b></td>
          <td>
            <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
              <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                  <input type="number" min="0" class="d-inline-flex quantity quantity-input" value="{qty}">
                  <span class="d-block quantity-button">
                     <a href="javascript:void(0);" class="qty-pls d-block text-center">+</a>
                     <div class="separator"></div>
                     <a href="javascript:void(0);" class="qty-mns d-block text-center">-</a>
                  </span>
               </div>
            </td>
        <td class="" style="text-align: center;"><b>{totalPrice}</b></td>
          <td class="" style="text-align: center;">
          <a href="javascript:void(0)" data-id="{pId}" data-name="{prodName}" class="remove-item-from-cart">
          <i class="fas fa-times" data-id="{pId}" data-name="{prodName}" style="font-size:25px; color:red;"></i>
          </a>
          </td>
          </tr>`;

          var eachProdTemplate2 = `<div class="each-prod row cart-single-elem" style="background-color: #fff; padding: 20px;">
                    <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
                    <div class="d-flex justify-content-between align-items-between px-4" style="width: 100%;">
                      <div class="d-flex justify-content-between align-items-center">
                        <img class="mr-3" src="{imgValue}" alt="" style="width: 120px;">
                        <div class="d-flex flex-column justify-content-between align-items-stretch" style="height:100%;">
                          <div>
                            <p class="mb-1" style="color: #333; font-size:20px; font-weight:600;">{prodName}</p>
                            <p style="color: #A9A9A9; font-size: 16px; font-weight: 500;">{unitValue}</p>
                          </div>
                          <p class="info-bottom mb-0" style="font-size:18px; font-weight: 600; color: #409244;">{price}</p>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-between align-items-end" style="height:100%;">
                        <button class="remove-item-from-cart" data-id="{pId}" data-name="{prodName}" style="color: #ECA5A5; font-size: 22px; background-color: transparent; border:none; padding: 0px;">
                          <i class="far fa-trash-alt"></i>
                        </button>
                        <div class="add-to-cart-btn d-flex flex-row align-items-center p-2" style="border: 1px solid #448AFF; border-radius: 18px 18px 18px 18px;">
                          <button style="background-color: transparent; border:none; padding: 0px;">
                            <i class="fas fa-minus qty-mns"></i>
                          </button>
                          <p class="px-3 mb-0 quantity" style="color: #619CFF; font-weight: 500;">{qty}</p>
                          <button style="background-color: transparent; border:none; padding: 0px;">
                            <i class="fas fa-plus qty-pls"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    </div>`;

          var sum = 0;
          for (var i = 0; i < cart.length; i++) {
             var eachProdTemplateCopy1 = eachProdTemplate1;
             var eachProdTemplateCopy2 = eachProdTemplate2;
             sum += parseInt(cart[i].quantity) * parseInt(cart[i].price);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace(/{pId}/g, cart[i].id);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{imgValue}', cart[i].img);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace(/{prodName}/g, `${cart[i].pName} ( ${cart[i].saleUnitQty} ${cart[i].saleUnit} )`);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{price}', formatCurrency(cart[i].price));
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{qty}', cart[i].quantity);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{totalPrice}', formatCurrency(parseInt(cart[i].quantity) * parseInt(cart[i].price)));

             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace(/{pId}/g, cart[i].id);
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace('{imgValue}', cart[i].img);
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace(/{prodName}/g, `${cart[i].pName}`);
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace(/{unitValue}/g, `${cart[i].saleUnitQty} ${cart[i].saleUnit}`);
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace('{price}', formatCurrency(cart[i].price));
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace('{qty}', cart[i].quantity);
             eachProdTemplateCopy2 = eachProdTemplateCopy2.replace('{totalPrice}', formatCurrency(parseInt(cart[i].quantity) * parseInt(cart[i].price)));

             //append newly created row in card body
             $(cartBody.find('tbody')).append(eachProdTemplateCopy1);
             cartBody2.append(eachProdTemplateCopy2);
            }

          }
          else{
             //show empty response here
             showEmptyResponse($('.cart-page'));
             return false;
          }   
       }

      var copun = null;
      $(document).on('click', '.remove-item-from-cart, .qty-pls, .qty-mns', function () {
          setTimeout(function(){
            calculatePrice();
          }, 500);
       });
      function calculatePrice(){
        var cart = getCookie('baskit');
         if(cart){
            cart = JSON.parse(cart);
            var sum = 0;
            for (var i = 0; i < cart.length; i++) {
               sum += parseInt(cart[i].quantity) * parseInt(cart[i].price);
            }
            subTotal = sum;
            $('#copun-form #ov').val(subTotal);
            $('.subtotal-price').html(formatCurrency(sum));
            $('.grand-amount').html(formatCurrency(parseFloat(subTotal)));
        }

        if(copun){
            if(copun.copunMinPurchase > subTotal){
                $('.grand-amount').html(formatCurrency(parseFloat(subTotal)));
                $('#cDiscountValue').html("");
                $('#cDiscount').removeClass('d-flex');
                $('#cDiscount').hide();
                copun = null;
                $.ajax({
                    url: "<?php echo base_url(); ?>Ccopun/empty_copun",
                    type: 'get',
                    success: function( data ) {}
                 });
            }
          var discountedValue = 0.00;
          if(copun.copunDiscountType == "Amount"){
            $('#cDiscountValue').html(formatCurrency(-copun.copunDiscountValue));
            $('.grand-amount').html(formatCurrency(parseFloat(subTotal) - parseFloat(copun.copunDiscountValue)));
          }else{
            $('#cDiscountValue').html(copun.copunDiscountValue + "%");
            $('.grand-amount').html(formatCurrency(subTotal - ((parseFloat(subTotal) / 100) * parseFloat(copun.copunDiscountValue))));
          }
          $('#cDiscount').addClass('d-flex');
        }else{
          $('#cDiscountValue').html("");
          $('#cDiscount').removeClass('d-flex');
          $('#cDiscount').hide();
        }
      }

      $(document).ready(function(){
         $( "#q" ).autocomplete({
            source: function( request, response )
            {
                 $.ajax({
                    url: "<?php echo base_url(); ?>Autocomplete/userdata",
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

         $("#copun-form").on("submit", function(){
            event.preventDefault();
            var currentElem = $(this);
            $.ajax({
                    url: currentElem.attr("action"),
                    type: currentElem.attr("method"),
                    data: currentElem.serialize(),
                    dataType: 'json',
                    success: function(a) 
                    {
                      if(!a.Success){
                        $.notify(a.Message, "error");
                        copun = null;
                        calculatePrice();
                      }else{
                        copun = a.Data;
                        //applyDiscount(copun);
                        calculatePrice();
                      }
                    },
                    error: function(a){
                      copun = null;
                      calculatePrice();
                    }
                 });
         });

      });
  </script>
   <!-- Cart Scripts End -->