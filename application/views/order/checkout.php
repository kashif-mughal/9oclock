<div id="main-page">
        <!-- Bread Crumb -->

        <div class="bread_crumb">
            <div class="container">
                <div class="row d-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item">Checkout</li>
                        </ol>
                    </nav>
                    <h3 class="mb-0">Checkout</h3>
                </div>
            </div>
        </div>

        <!-- Bread Crumb -->


        <section class="main-content mx-4">
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="content-box pd-30">
                            <div class="checkout-header">
                                <h3>Thank you for your order</h3>
                                <h6>Read your details below</h6>
                            </div>
                            <div class="checkout-content mrgt-30">
                                
                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/OrderID.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Order ID</h4>
                                            <h4 class="feature-text-price mb-0"><?=$_SESSION["orderId"];?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/TotalOrder.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Total Order</h4>
                                            <h4 class="feature-text-price mb-0"><script type="text/javascript">
                                            document.write(formatCurrency('<?=$_SESSION["OV"] + $_SESSION["deliveryCharges"] - $_SESSION["discountedPrice"]?>'));
                                        </script></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/Estimated-Delivery-Time.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Estimated Delivery Time</h4>
                                            <h4 class="feature-text-price mb-0"><?=$_SESSION['userDeliveryTime']?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/Delivery-Date.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Delivery Date</h4>
                                            <h4 class="feature-text-price mb-0" id="delivery-date"><script type="text/javascript">document.write((new Date("<?=$_SESSION['userDeliveryDate']?>")).toDateString());</script></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/Payment-Option.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Payment Option</h4>
                                            <h4 class="feature-text-price mb-0" id="delivery-date"><?=$_SESSION['paymentMode']?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="check-in-feature">
                                    <div class="grid-container">
                                        <div class="feature-img">
                                            <img src="<?=base_url('assets/img/Checkout/Address.png')?>" alt="">
                                        </div>
                                        <div class="feature-content d-flex flex-column justify-content-center">
                                            <h4 class="feature-text mb-0">Delivery Address</h4>
                                            <h4 class="feature-text-price mb-0"><?php echo empty($_SESSION['addressText']) ? 'Not Specified' : $_SESSION['addressText'];?></h4>
                                        </div>
                                    </div>
                                </div>

                                <a href="<?=base_url();?>" id="checkout" class="button-secondary button-full-width mt-5 mb-1 p-2 text-dec-none text-white font-size-18">Done</a>
                                <a href="<?=base_url('Corder/my_order');?>" class="button-secondary button-full-width mt-5 mb-1 p-2 text-dec-none text-white font-size-18">View Order history</a>
                                
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
                                            <h6 class="subtotal-price font-size-15 sub-total"></h6>
                                        </div>
                                        <div class="orderbox-content">
                                            <div class="orderbox-content-charges d-flex justify-content-between mb-3">
                                                <h6>Delivery Charges</h6>
                                                <h6><script type="text/javascript">document.write(formatCurrency('<?=$_SESSION["deliveryCharges"];?>'))</script></h6>
                                            </div>
                                            <?php if($_SESSION["discountedPrice"] != 0){?>
                                                <div class="orderbox-content-charges d-flex justify-content-between mb-3">
                                                    <h6>Copun Discount</h6>
                                                    <h6><script type="text/javascript">document.write(formatCurrency('-<?=$_SESSION["discountedPrice"];?>'))</script></h6>
                                                </div>
                                            <?php } ?>
                                            <div class="orderbox-content-footer d-inline-flexbox align-self-start">
                                                <h6>Shipping options will be updated during checkout.</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="orderbox-footer d-flex justify-content-between mx-3">
                                        <h6>TOTAL</h6>
                                        <h6 class="total-price font-size-15" id="grand-amount"><script type="text/javascript">
                                            document.write(formatCurrency('<?=$_SESSION["OV"] + $_SESSION["deliveryCharges"] - $_SESSION["discountedPrice"]?>'));
                                        </script></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="content-box my-box">
                                    <div class="my-box-header d-flex justify-content-between align-items-baseline">
                                        <h4>My Order</h4>
                                        <h6 class="font-weight-700 item-counts"></h6>
                                    </div>
                                    <div class="my-box-content p-3" id="cartProductsArea"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- HOUSEHOLD ESSENTIALS -->

            </div>
        </section>
    </div>
<script type="text/javascript">
    var baskit = getCookie('baskit');
    if(!baskit || JSON.parse(baskit).length == 0)
        window.location.href = '<?=base_url();?>';
    $(document).ready(() => {
        loadCheckoutCartArea();
        emptyCart();
    });

    function loadCheckoutCartArea(){
         var cartBody = $('#cartProductsArea');
         cartBody.empty();
         var eachProdTemplate = `<div data-id="{pId}" data-name="{prodName}" class="my-box-order d-flex">
                                    <img src="{imgValue}" alt="" class="img-fluid" style="width:auto; height:80px;">
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
               sum += parseFloat(cart[i].quantity) * parseFloat(cart[i].price);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{pId}', cart[i].id);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{imgValue}', cart[i].img);
               eachProdTemplateCopy = eachProdTemplateCopy.replace(/{prodName}/g, cart[i].pName);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{qty}', cart[i].quantity);
               eachProdTemplateCopy = eachProdTemplateCopy.replace('{totalPrice}', parseFloat(cart[i].quantity) * parseFloat(cart[i].price));
               //append newly created row in card body
               cartBody.append(eachProdTemplateCopy);
            }
            $('.item-counts').html(`${cart.length} ${cart.length > 1 ? 'Items' : 'Item'}`);
            $('.sub-total').html(formatCurrency('<?=$_SESSION["OV"]?>'));
         }
         else{
            //show empty message
            return false;
         }   
    }

</script>
