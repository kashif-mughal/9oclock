<?php
$CI =& get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>
<div id="main-page">
        <!-- Bread Crumb -->

        <div class="bread_crumb">
            <div class="container">
                <div class="row d-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item">proceed_to_checkout</li>
                        </ol>
                    </nav>
                    <h3 class="mb-0">Proceed To Checkout</h3>
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
                    <div class="col-md-12">
                        <div class="content-box pd-30 row">
                            <div class="col-md-6">
                                <div class="checkout-content mrgt-30">
                                    <a href="javascript:void(0)" class="button-secondary button-full-width mt-5 mb-3 p-3 text-dec-none text-white font-size-18" onclick="printDiv('receipt-content');"><i class="fa fa-print"></i>&nbsp; Print Receipt</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-content mrgt-30">
                                    <a href="<?=base_url();?>" class="button-secondary button-full-width mt-5 mb-3 p-3 text-dec-none text-white font-size-18">Back To Hone</a>
                                </div>
                            </div>
                        </div>
                        <!-- print area -->

                        <div class="content-box pd-30 row">
                            <div class="col-md-12">
                                <div id="receipt-content">
                                    <div style="width: 60%; margin: 0 auto; margin-top: 100px;">
                                        <style type="text/css">
                                            .center {
                                                text-align: center;
                                                width: 40%;
                                            }
                                            .ten {
                                                width: 10% !important;
                                            }
                                            .fifty {
                                                width: 50% !important;
                                            }
                                            .left {
                                                text-align: left;
                                                width: 20%;
                                            }
                                            .right {
                                                text-align: right;
                                                width: 20%;
                                            }
                                            .inline {
                                                display: table-cell;
                                                vertical-align: top;
                                            }
                                        </style>
                                        <div>
                                            <div class="inline" style="width: 30%;">
                                                <p style="font-size: 12px;">
                                                    <script>
                                                        var siteInfo = `<?php if (isset($Web_settings[0]['footer_text'])) { echo $Web_settings[0]['footer_text']; }?>`;
                                                        var elem = document.createElement('div');
                                                        elem.innerHTML = siteInfo;
                                                        document.write(elem.innerText.trim());
                                                    </script>
                                                </p>
                                            </div>
                                            <div class="inline" style="width: 40%;text-align: center;font-weight: 500;font-size: 40px;">
                                                RECEIPT
                                            </div>
                                            <div class="inline" style="width: 30%; text-align: right;">
                                                <img style="background-color: #25bfa9;border-radius: 200px;" src="<?php echo base_url() ?>assets/img/logo.png">
                                            </div>
                                        </div>
                                        <div style="width: 30%;">
                                            <h3 style="font-size: 17px;">Bill To (<span style="font-size: 15px;">Order#&nbsp;{orderId}</span>)</h3>
                                            <h4 style="font-size: 14px;"><?=$userData['user_name']?></h4>
                                            <p style="font-size: 10px;"><?=$userData['address']?></p>
                                        </div>
                                        <div style="min-height: 400px;">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr style="border-top: 2px solid #008000;border-bottom: 2px solid #008000;font-weight: 500;">
                                                        <td class="left ten">QTY</td>
                                                        <td class="left fifty">DESCRIPTION</td>
                                                        <td class="right">UNIT PRICE</td>
                                                        <td class="right">AMOUNT</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {orderDetail}
                                                    <tr>
                                                        <td class="left ten">{quantity}</td>
                                                        <td class="left fifty">{pName}</td>
                                                        <td class="right">{price}</script></td>
                                                        <td class="right">{total}</td>
                                                    </tr>
                                                    {/orderDetail}
                                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                                    <tr>
                                                        <td class="left ten"></td>
                                                        <td class="left fifty"></td>
                                                        <td class="right" style="font-weight: bolder;">Total</td>
                                                        <td class="right" style="font-weight: bolder;"><script>document.write(formatCurrency('{OV}'));</script></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        var tempTitle = document.title;
        document.title = "ORDER_092834";
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        document.title = tempTitle;
    }
    emptyCart();
    </script>