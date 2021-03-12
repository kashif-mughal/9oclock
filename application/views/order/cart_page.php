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

<div id="main-page">
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
      <div class="row d-flex justify-content-start align-items-center" style="margin-top: 115px;">
         <button onclick="window.history.back()" class="d-inline" style="height: 60px; width: 60px; border-radius: 0px 30px 30px 0px; background-color: transparent; border:none; color: #333;">
            <i class="fas fa-arrow-left" style="font-size: 20px;"></i>
         </button>
         <h3>Cart</h3>
      </div>
      <div style="background-color: #ffffff;">      
        <table class="table table-hover table-responsive-md table-condensed">
            <tbody>
            </tbody>
        </table>
      </div>

      <div style="background-color: #fff; border-color: #ececec; border-radius: 2px; padding: 12px;">
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-bottom: 1px solid #ececec;">
          <h6 style="font-weight: 600; margin-bottom: 0px;">Sub Total</h6>
          <h5 style="font-weight: 600; margin-bottom: 0px;" class="subtotal-price"></h5>
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
                    <button class="btn" style="width:100%; margin-top:5px; margin-bottom: 2px; background-color:var(--secondary-color); color:white;" type="submit">Apply</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-bottom: 1px solid #ececec;">
          <div>
            <h6 style="color: orange; font-weight: 600; margin-bottom: 0px;">Delivery Charges</h6>
            <p style="font-size:12px; font-weight: 600; margin-bottom: 0px;">Free delivery on order above Rs.45</p>
          </div>
          <h5 style="font-weight: 600;"><script type="text/javascript">document.write(formatCurrency(0));</script></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3">
          <h6 style="color: green; font-weight: 600; margin-bottom: 0px;">Total Amount</h6>
          <h5 style="color: green; font-weight: 600; margin-bottom: 0px;" class="grand-amount"></h5>
        </div>
      </div>

      <div style="background-color: var(--main-color); border: 1px solid #ececec; border-radius: 2px; padding: 12px; margin-top: 12px;">
        <div class="d-flex justify-content-between align-items-center px-3 py-2" style="color:#fff;">
          <h5 class="p-0 m-0">Sign in to Checkout</h5>
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 pr-2 grand-amount" style="border-right: 1px solid #fff;"></h5>
            <i class="fas fa-chevron-right ml-3" style="font-size: 1.25rem;"></i>
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
        loadCheckoutCartArea();
        loadShoppingCart1();

        $('#btnCoupon').on('click',function() {
          $('#inputCoupon').toggle();
        });
    });

    function loadCheckoutCartArea(){
         var cartBody = $('#cartProductsArea');
         cartBody.empty();
         var eachProdTemplate2 = `<div data-id="{pId}" data-name="{prodName}" class="my-box-order d-flex">
                                    <img src="{imgValue}" alt="" class="img-fluid">
                                    <div class="my-box-order-content ml-3 d-flex flex-column justify-content-center">
                                        <h6>{prodName}  X {qty}</h6>
                                        <h6 class="mt-2 my-order-price">{totalPrice}</h6>
                                    </div>
                                </div>`;
        var eachProdTemplate = `
            <tr class="each-prod" data-id="{pId}" data-name="{prodName}">
                <td class="text-center">
                  <img style="width: 110px;" src="{imgValue}" alt="" class="img-fluid">
                </td>
                  <td colspan="3">{prodName}</td>
                  <td class="" style="text-align: center;" colspan="2"><b>{qty}</b></td>
                  <td>
                    <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
                      <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                          <span class="d-flex justify-content-between align-items-center px-2 py-2" style="width: 80px; height: 40px; border: 1px solid #cccccc; border-radius: 2px;">
                            <a href="javascript:void(0)">-</a>
                            <p class="m-0 p-0">2</p>
                            <a href="javascript:void(0)">+</a>
                          </span>
                      </div>
                    </td>
                    <td class="" style="text-align: center;">
                    <a href="javascript:void(0)" data-id="1" data-name="apple" class="remove-item-from-cart">
                    <i class="fas fa-trash-alt" data-id="1" data-name="apple" style="font-size:25px; color:red;"></i>
                    </a>
                  </td>
              </tr>`;
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
       var cart = getCookie('baskit');
       $(cartBody.find('tbody')).empty();
       if(cart){
          cart = JSON.parse(cart);
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
          var eachProdTemplate2 = `<tr class="each-prod">
          <td class="text-center">
          <img style="width: 110px;" src="{imgValue}" alt="" class="img-fluid">
          </td>
          <td colspan="3">{prodName}</td>
          <td class="" style="text-align: center;" colspan="2"><b>{price}</b></td>
          <td>
            <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
              <div kashif class="quantity-area d-flex justify-content-center align-items-center mt-2">
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
          var eachProdTemplate1 = `<tr class="each-prod">
                <td class="text-center">
                  <img style="width: 110px;" src="{imgValue}" alt="" class="img-fluid">
                </td>
                  <td colspan="3">{prodName}<br><small>{unit}</small></td>
                  <td class="" style="text-align: center;" colspan="2"><b>{price}</b></td>
                  <td>
                    <span class="add-cart" pId="{pId}" style="display:none;">remove from cart</span>
                      <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                          <span class="d-flex justify-content-between align-items-center px-2 py-2" style="width: 80px; height: 40px; border: 1px solid #cccccc; border-radius: 2px;">
                            <a href="javascript:void(0)">-</a>
                            <p class="m-0 p-0">2</p>
                            <a href="javascript:void(0)">+</a>
                          </span>
                      </div>
                    </td>
                    <td class="" style="text-align: center;">
                    <a href="javascript:void(0)" data-id="{pId}" data-name="{prodName}" class="remove-item-from-cart">
                    <i class="fas fa-trash-alt" data-id="{pId}" data-name="{prodName}" style="font-size:25px; color:red;"></i>
                    </a>
                  </td>
              </tr>`;

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
             //append newly created row in card body
             $(cartBody.find('tbody')).append(eachProdTemplateCopy1);
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