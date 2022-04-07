<!-- Bread Crumb -->

<div class="bread_crumb">
    <div class="container">
        <div class="row d-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/">Home</a></li>
                    <li class="breadcrumb-item">Orders History</li>
                </ol>
                <h3 class="mb-0">Orders History</h3>
            </nav>
            <h3 class="mb-0"><?php echo $SelectOrder['SubOrder']; ?></h3>
        </div>
    </div>
</div>
<style type="text/css">
    .remove-cart{
        top: auto;
        left: auto;
        text-align: -webkit-auto;
        z-index: auto;
        position: relative;
        vertical-align: unset;
        background: black !important;
        border-radius: 0px;
    }
    @media (max-width: 768px) {
        .remove-cart{
            /* top: auto;
            left: auto;
            text-align: -webkit-auto;
            z-index: auto;
            position: relative;
            vertical-align: unset;
            background: black !important;
            border-radius: 0px; */
            top: 11% !important;
            left: 5% !important;
            text-align: center !important;
            z-index: 20 !important;
            position: absolute !important;
            vertical-align: middle !important;
            background: rgba(43, 233, 204, 0.7) !important;
            border-radius: 10px 0px 10px 0px !important;
            color: white;
            font-weight: bolder !important;
            width: 90% !important;
        }
    }  
        
</style>
<!-- Bread Crumb -->


<section>
    <div class="container">
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
        <div class="row content-box pd-4" style="padding-left:0px; padding-right:10px;">
            <?php if($orderData && count($orderData) > 0){?>
                <h5 class="ml-4 mt-4 mb-2">My Orders History</h5>
            <?php } ?>
            <!-- <div class="col-xl-3 col-lg-3 col-md-12 pr-0 hidden-sm-down">
                <div class="sidenav" style="position: relative;width: 100%;z-index: 0;height: auto;">
                    <div>
                        <?php 
                            if(empty($CatList))
                                $CatList = Array();
                            $data['CatList'] = $CatList;
                            $this->load->view('include/user_left_menu', $data);
                        ?>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-12 col-lg-12 col-md-12 my-3 pr-0">

                <!-- <table id="orderDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th class="text-center">Order Id</th>
                            <th class="text-center">Order Amount</th>
                            <th class="text-center">Placement Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL#</th>
                            <th class="text-center">Order Id</th>
                            <th class="text-center">Order Amount</th>
                            <th class="text-center">Placement Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table> -->

                <?php if($orderData && count($orderData) > 0){$orderCounter = -1;?>
                    
                    <?php foreach ($orderData as $key => $value) { $orderCounter++;?>
                        <div class="accordion" id="orderHistoryaccordion" style="margin-bottom: 10px;">
                           <div class="card order-history-card">
                              <div class="card-header order-header" style="padding:0px 5px;">
                                    <div class="container-fluid">
                                        <div class="row py-3 text-center text-md-left">
                                            <div class="col-md-8 col-12">
                                                <!-- <div class=> -->
                                                
                                                    <button data-toggle="collapse" data-target="#orderHistoryCollapse<?=$value[0]['OrderId']?>" aria-expanded="true" aria-controls="orderHistoryCollapse" class="order-history-button px-sm-0">
                                                        <div class="d-flex align-items-center justify-content-between border-b-sm">    
                                                            <div class="order-id border-r-secondary pr-md-4 mr-md-4 flex-sm-shrink-1" style="border-right: 1px solid #ccc;">
                                                                <img src="<?=base_url("assets/img/orderhistory/track_id.png")?>" alt="Track_Id" style="width: 40px; height: 34px;">
                                                                <span class="order-header-text"><?='#'.$value[0]['OrderId']?></span>
                                                            </div>
                                                            <div class="order-date border-r-secondary pr-md-4 mr-md-4 flex-sm-grow-1 d-flex justify-content-center align-items-center" style="border-right: 1px solid #ccc;">
                                                                <img src="<?=base_url("assets/img/orderhistory/calendar_icon.png")?>" alt="Calendar">
                                                                <span class="order-header-text">
                                                                    <span class="text-left" id="main-date">
                                                                        <span>
                                                                            <script>document.write((new Date('<?=$value[0]["DeliveryDate"]?>')).toDateString());
                                                                            </script>
                                                                        </span><br/>
                                                                        <span class="d-lg-none d-block">
                                                                            <?=date('h:i a', strtotime($value[0]["DeliveryFrom"])). ' - ' .date('h:i a', strtotime($value[0]["DeliveryUpto"]))?>
                                                                        </span>
                                                                    </span>
                                                                    
                                                                <span>     
                                                            </div>
                                                            <div class="order-time pr-4 d-none d-lg-block">
                                                                <img src="<?=base_url("assets/img/orderhistory/clock_icon.png")?>" alt="Clock">
                                                                <span class="order-header-text">
                                                                    <?=date('h:i a', strtotime($value[0]["DeliveryFrom"])). ' - ' .date('h:i a', strtotime($value[0]["DeliveryUpto"]))?>
                                                                </span>
                                                            </div>
                                                        
                                                        </div>
                                                    </button>
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center pt-2 pt-md-0">
                                                <div class="orderTrackingLink">
                                                    <a href="<?=base_url("Corder/order_detail_form/$key")?>" class="orderTrackingIcon pr-2">Track your Order</a>
                                                    <img src="<?=base_url("assets/img/orderhistory/track_id_icon.png")?>" alt="TrackIcon">    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              <div id="orderHistoryCollapse<?=$value[0]['OrderId']?>" class="collapse <?= $orderCounter == 0? "show" : ""; ?>" aria-labelledby="headingOne" data-parent="#orderHistoryaccordion">
                                 <div class="card-body row">
                                    <?php
                                       for ($i=0; $i < count($value); $i++) {?>
                                       
                                            <div class="order-history-header col-6 col-md-12 mt-3 p-2 product-header-card">
                                                <div class="card order-history-card each-prod">
                                                    
                                                    <div class="featured-products mt-0 border-none d-flex flex-column flex-md-row justify-content-between align-items-center">
                                                        <?php 
                                                          $discountPercentage = (($value[$i]['Price'] - $value[$i]['SoldPrice'])/$value[$i]['Price']) * 100;
                                                        ?> 

                                                        <img src="<?=base_url($value[$i]['Images']->Thumb[0])?>" alt="" class="product-image">
                                                        <div class="order-product-name order-item align-self-center text-center text-md-left">
                                                            <p class="order-name"><?=$value[$i]['ProductName']?></p>
                                                            <!-- <p class="order-weight"><?=$value[$i]['ItemQuantity']?>&nbsp;<?=$value[$i]['UnitName']?></p> -->
                                                        </div>
                                                        <div class="order-product-price order-item text-center text=md-left">
                                                            <p class="order-price"><script type="text/javascript">
                                                                document.write(formatCurrency('<?=$value[$i]["SoldPrice"]?>'));
                                                            </script></p>
                                                            <!-- <?php if($discountPercentage != 0) { ?> 
                                                                <p class="order-discount"><del><script type="text/javascript">
                                                                document.write(formatCurrency('<?=$value[$i]["Price"]?>'));
                                                            </script></del></p>
                                                            <?php } ?> -->
                                                        </div>
                                                        <div class="quantity-area order-item">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <span class="d-inline-flex quantity-text mr-1">Qty</span>
                                                                <input type="number" value="<?=$value[$i]['ItemQuantity']?>" min="0" class="d-inline-flex quantity  quantity-input">
                                                                <span class="d-block quantity-button">
                                                                    <a href="javascript:void(0);" class="qty-pls d-block text-center">+</a>
                                                                    <div class="separator"></div>
                                                                    <a href="javascript:void(0);" class="qty-mns d-block text-center">-</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="order-button order-item d-flex flex-column justify-content-center align-items-center mr-lg-2">
                                                            <a href="javascript:void(0);" class="d-block button-primary add-cart"
                                                               data-json="<?= $value[$i]["Jsn"]?>"
                                                               >Add to Cart
                                                            </a>
                                                            <!-- <a href="#" class="d-block align-self-center button-primary">Add to Cart</a> -->
                                                            <a href="javascript:void(0);" style="display: none;" class="button-secondary remove-cart text-center" data-json="<?= $value[$i]["Jsn"]?>"
                                                               >Remove From Cart
                                                           </a>
                                                            <!-- <a href="#" class="d-block align-self-center button-secondary">Delete</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                    <?php } ?>
                <?php }else{
                    echo "<h5 class=\"ml-4 mt-4 mb-2\">Nothing to show!!<br>You didn't order at the first time yet </h5>";
                } ?>
            </div>

        </div>

    </div>
</section>

<!-- Manage Order End -->

<!-- Delete Order ajax code -->
<script type="text/javascript">
    //Delete Order 
    $(document).ready(function(){

        $(".DeleteOrder").click(function ()
        {
            var OrderId = $(this).attr('name');
            var csrf_test_name = $("[name=csrf_test_name]").val();
            var x = confirm("Are You Sure,Want to Delete ?");
            if (x == true) {
                $.ajax
                ({
                    type: "POST",
                    url: '<?php echo base_url('Corder/order_delete') ?>',
                    data: {OrderId: OrderId, csrf_test_name: csrf_test_name},
                    cache: false,
                    success: function (datas)
                    {
                        alert(datas);
                    }
                });
            }
        });
        $('#orderDataTable').DataTable();
    }); 
</script>



