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
  /*#checkout_text {
    font-size: 1.25rem;
  }*/

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
    .prodName {
      font-size: 14px;
      line-height: 20px;
      color: #666666;
      font-weight: 500;
      font-family: "Work Sans";
      margin-bottom: 0px;
    }
    .unitText {
      font-size: 12px;
      color: #999999;
      font-weight: 400;
      font-family: "Work Sans";
    }
    .quantityCount {
      font-size: 18px;
      color: #000000;
      font-weight: 400;
      font-family: "Work Sans";
    }
    .priceText {
      font-size: 16px;
      color: #000000;
      font-weight: 500;
      font-family: "Work Sans";
    }
</style>

<div id="main-page">
    <!-- Bread Crumb -->
    <!-- <div class="bread_crumb">
        <div class="container">
            <div class="row d-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php //echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ol>
                </nav>
                <h3 class="mb-0">Shopping Cart</h3>
            </div>
        </div>
    </div> -->

    <!-- Bread Crumb -->

    <section style="display: none;" class="empty-cart-page main-content">
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


<section id="cart_page_new" class="cart_page_new">
   <div class="container" id="shoppingCartBody1">
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
      <div class="row d-flex justify-content-start align-items-center">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3 style="font-size: 24px;color: #000000;font-weight: 600;font-family: 'Work Sans';">Cart</h3>
      </div>
      <div style="background-color: #ffffff;" id="main_cart">      
        <table class="table table-hover table-responsive-md table-condensed">
            <tbody>
            </tbody>
        </table>
      </div>

      <div id="mobile_cart" style="background-color: #ffffff; border: 1px solid #ececec;" class="px-2 py-3">
        
      </div>

      <div style="background-color: #fff; border-color: #ececec; border-radius: 2px; padding: 12px;" id="cart_page_summary">
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-bottom: 1px solid #ececec;">
          <h6 style="font-weight: 600; margin-bottom: 0px;" id="subTotal">Sub Total</h6>
          <p style="font-weight: 600; margin-bottom: 0px;" class="subtotal-price grand-amount"></p>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-bottom: 1px solid #ececec;">
          <h6 style="font-weight: 600; margin-bottom: 0px;">Coupon No.</h6>
          <a href="javascript:void(0)" id="btnCoupon">
            <h5 style="font-weight: 600; margin-bottom: 0px;">
              <i class="fas fa-chevron-down ml-3" style="font-size: 1.25rem;"></i>
            </h5>
          </a>
        </div>
        <div class="input-group" id="inputCoupon" style="width:100%; border-radius: 0px; font-size: 20px; display:none;">
            <form method="POST" id="copun-form" action="<?=base_url("Ccopun/apply_copun")?>" style="width: 100%;">
                <input name="copun" type="text" class="form-control coupon" placeholder="Enter coupon code here..." autocomplete="off">
                <input type="hidden" name="ov" id="ov">
                <div class="input-group-append">
                    <button class="btn" style="width:100%; margin-top:5px; margin-bottom: 2px; background-color:var(--main-color); color:white;" type="submit">Apply</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-bottom: 1px solid #ececec;">
          <div>
            <h6 style="color: orange; font-weight: 600; margin-bottom: 0px;">Delivery Charges</h6>
            <p style="font-size:12px; font-weight: 600; margin-bottom: 0px;" class="delivery-charges-text">Free delivery on order above Rs.45</p>
          </div>
          <p style="font-weight: 600;" class="grand-amount">
            <script type="text/javascript">document.write(formatCurrency(0));</script>
          </p>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3">
          <h6 style="color: green; font-weight: 600; margin-bottom: 0px;">Total Amount</h6>
          <h5 style="color: green; font-weight: 600; margin-bottom: 0px;" class="grand-amount"></h5>
        </div>
      </div>

      <div style="background-color: var(--main-color); border: 1px solid #ececec; border-radius: 2px; padding: 12px; margin-top: 12px;" id="cart_page_summary_bottom">
        <div class="d-flex justify-content-between align-items-center px-3 py-2" style="color:#fff;">
          <p class="p-0 m-0" id="checkout_text" style="cursor: pointer;" 
            <?php
                echo 'onClick=\'window.location.href="'.base_url("corder/checkout_form").'"\'';
            ?>
            >
            <?php
              if(!is_null($users)){
                echo 'Proceed to Checkout';
              }else{
                echo 'Sign in to Checkout';
              }
            ?>
          </p>
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 pr-2 grand-amount" style="border-right: 1px solid #fff;"></p>
            <i class="fas fa-chevron-right ml-3 grand-amount-icon" style="font-size: 1.25rem;"></i>
          </div>
        </div>
      </div>

   </div>
</section>


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
        $(".cart_page_new").hide();
        $('.empty-cart-page').show();
    }
    $(document).ready(() => {
        calculatePrice();
        loadShoppingCart();

        $('#btnCoupon').on('click',function() {
          $('#inputCoupon').toggle();
        });
    });

    
    var subTotal = 0;
    var addressCounter = 1;

    function loadShoppingCart(){
       var cartBody = $('#shoppingCartBody1');
       var cart = getCookie('baskit');
       $(cartBody.find('tbody')).empty();

       if(cart){
          cart = JSON.parse(cart);
          var paymentObject;
          if(cart.length == 0)
          {
             //show empty response here
             showEmptyResponse($('.cart_page_new'));
             return;
          }
          //<td style="text-align:center;"><b>{qty}</b></td>
          $(cartBody).show();
          $($('.emptyCart')[0]).hide();
          $(document).off('click', '.checkout-btn', handleCheckout(event));
          var eachProdTemplate1 = `<tr class="each-prod cart-single-elem">
                <td class="text-center">
                  <img style="width: 110px;" src="{imgValue}" alt="" class="img-fluid">
                </td>
                  <td colspan="3"><p class="prodName">{prodName}</p><small class="unitText">{unit}</small></td>
                  <td class="" style="text-align: center;" colspan="2"><b class="priceText">{price}</b></td>
                  <td>
                    <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
                      <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                          <span class="d-flex justify-content-between align-items-center px-2 py-2" style="width: 80px; height: 40px; border: 1px solid #cccccc; border-radius: 2px;">
                            <a href="javascript:void(0)" class="qty-mns">-</a>
                            <input type="text" style="border:none;" class="quantity-input quantity" value="{qty}" />
                            
                            <a href="javascript:void(0)" class="qty-pls">+</a>
                          </span>
                      </div>
                    </td>
                    <td class="" style="text-align: center; padding-right:30px;">
                    <a href="javascript:void(0)" data-id="{pId}" data-name="{prodName}" class="remove-item-from-cart">
                    <i class="fas fa-trash-alt" data-id="{pId}" data-name="{prodName}" style="font-size:20px; color:red;"></i>
                    </a>
                  </td>
              </tr>`;

            var mobileProdTemp = `<div class="cart-single-elem each-prod d-flex justify-content-start align-items-center mb-3">
              <img style="width: 90px;" src="{imgValue}" alt="">  
              <div class="ml-3" style="width: 100%;">
                <div class="each-prod-top">
                  <p class="mb-0">{prodName}</p>
                  <small>{unit}</small>
                  <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
                </div>
                <div class="each-prod-bottom d-flex justify-content-between align-items-center">
                  <b class="cart-price">{price}</b>
                  <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                      <span class="d-flex justify-content-between align-items-center px-2 py-2 px-sm-1 py-sm-1 quantity-btn" style="width: 80px; height: 40px; border: 1px solid #cccccc; border-radius: 2px;">
                        <a href="javascript:void(0)" class="qty-mns">-</a>
                        <input type="text" style="border:none;" class="quantity-input quantity" value="{qty}" />
                        
                        <a href="javascript:void(0)" class="qty-pls">+</a>
                      </span>
                  </div>
                  <a href="javascript:void(0)" data-id="{pId}" data-name="{prodName}" class="remove-item-from-cart">
                    <i class="fas fa-trash-alt" data-id="{pId}" data-name="{prodName}" style="font-size:20px; color:red;"></i>
                  </a>
                </div>
              </div>
            </div>`;


          var sum = 0;
          for (var i = 0; i < cart.length; i++) {
             var eachProdTemplateCopy1 = eachProdTemplate1;
             sum += parseInt(cart[i].quantity) * parseInt(cart[i].price);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace(/{pId}/g, cart[i].id);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{imgValue}', cart[i].img);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace(/{prodName}/g, `${cart[i].pName}`);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{price}', formatCurrency(cart[i].price));
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{qty}', cart[i].quantity);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{unit}', `${cart[i].saleUnitQty} ${cart[i].saleUnit}`);
             eachProdTemplateCopy1 = eachProdTemplateCopy1.replace('{totalPrice}', formatCurrency(parseInt(cart[i].quantity) * parseInt(cart[i].price)));

            var mobileProdTempCopy = mobileProdTemp;
            mobileProdTempCopy = mobileProdTempCopy.replace(/{pId}/g, cart[i].id);
            mobileProdTempCopy = mobileProdTempCopy.replace('{imgValue}', cart[i].img);
            mobileProdTempCopy = mobileProdTempCopy.replace(/{prodName}/g, `${cart[i].pName}`);
            mobileProdTempCopy = mobileProdTempCopy.replace('{price}', formatCurrency(cart[i].price));
            mobileProdTempCopy = mobileProdTempCopy.replace('{qty}', cart[i].quantity);
            mobileProdTempCopy = mobileProdTempCopy.replace('{unit}', `${cart[i].saleUnitQty} ${cart[i].saleUnit}`);
            mobileProdTempCopy = mobileProdTempCopy.replace('{totalPrice}', formatCurrency(parseInt(cart[i].quantity) * parseInt(cart[i].price)));  

            paymentObject = mobileProdTempCopy;

             //append newly created row in card body
             $(cartBody.find('tbody')).append(eachProdTemplateCopy1);
             $(cartBody.find('#mobile_cart')).append(mobileProdTempCopy);
             }

          }
          else{
             //show empty response here
             showEmptyResponse($('.cart_page_new'));
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