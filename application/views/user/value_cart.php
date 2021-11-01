<!-- Bread Crumb -->

<div class="bread_crumb">
    <div class="container">
        <div class="row d-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Value Cart</a></li>
                </ol>
                <h3 class="mb-0">Value Cart</h3>
            </nav>
            <h3 class="mb-0"><?php echo $SelectOrder['SubOrder']; ?></h3>
        </div>
    </div>
</div>
<style type="text/css">
    @media (max-width: 767px) {
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
        .remove-cart {
            top: auto;
            left: auto;
            text-align: -webkit-auto;
            z-index: auto;
            position: relative;
            vertical-align: unset;
            background: black !important;
            border-radius: 0px;
            color: black;
        }
    
    .sidebar-inner-page h4 {
        border-bottom: 1px solid #cccccc;
        padding: 20px 26px;
        color: #000000;
    }
    .value-cart-content {
        margin-top: 0px !important;
    }
    
</style>
<!-- Bread Crumb -->


<section class="main-content value-cart-content">
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
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 pr-0 hidden-sm-down">
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
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="order-history-top my-4">
                    <h4>9o'Clock Value Cart</h4>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis amet cumque sunt libero iste repudiandae ullam, ut ipsam fugiat architecto et repellendus minus non impedit dolorum! Nobis pariatur aut necessitatibus?</p> -->
                </div>
                <?php if($value_list && count($value_list > 0) && $value_list["Value"] && count($value_list["Value"] > 0)){?>
                    
                    <div class="container-fluid">
                        <div class="row">
                            <?php foreach($value_list["Value"] as $key => $value) {?>
                                <?php for ($i=0; $i < count($value); $i++) {?>
                                    <div class="col-md-12 col-sm-6 pl-0" style="padding-right: 5px;">
                                        <div class="order-history-header mt-3 p-0">
                                            <div class="card order-history-card each-prod">
                                                
                                                <div class="main-featured-products mt-0 border-none d-flex flex-column flex-md-row text-center text-md-left justify-content-between align-items-center">
                                                    <?php 
                                                    if($value[$i]['IsFeatured'] == 1) {
                                                    $discountPercentage = (($value[$i]['Price'] - $value[$i]['SalePrice'])/$value[$i]['Price']) * 100;
                                                    }?> 

                                                    <img src="<?=base_url($value[$i]['ProductImg'])?>" class="img-fluid" alt="">
                                                    <div class="order-product-name order-item align-self-center" style="width: 230px;">
                                                        <p class="order-name"><?=$value[$i]['ProductName']?></p>
                                                        <p class="order-weight"><?=empty($value[$i]['SaleUnitName']) ? $value[$i]['UnitName'] : 
                                                        ($value[$i]['SaleUnitQty'] . ' ' . $value[$i]['SaleUnitName'])
                                                        ?></p>
                                                    </div>
                                                    <div class="order-product-price order-item" style="padding-top: 9px;padding-bottom: 9px;">
                                                        <p class="order-price"><script type="text/javascript">
                                                            document.write(formatCurrency('<?=$value[$i]["SalePrice"]?>'));
                                                        </script></p>
                                                        <!-- <?php if($discountPercentage != 0) { ?> 
                                                            <p class="order-discount"><del><script type="text/javascript">
                                                            document.write(formatCurrency('<?=$value[$i]["Price"]?>'));
                                                        </script></del></p>
                                                        <?php } ?> -->
                                                    </div>
                                                    <div class="quantity-area order-item" style="width: 125px;padding-top: 7px;padding-bottom: 7px;">
                                                        <div class="d-flex text-md-left text-center">
                                                            <span class="d-inline-flex quantity-text mr-1">Qty</span>
                                                            <input type="number" value="<?=$value[$i]['ItemQuantity']?>" min="0" class="d-inline-flex quantity  quantity-input">
                                                            <span class="d-block quantity-button">
                                                                <a href="javascript:void(0);" class="qty-pls d-block text-center">+</a>
                                                                <div class="separator"></div>
                                                                <a href="javascript:void(0);" class="qty-mns d-block text-center">-</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="order-button order-item d-flex flex-column justify-content-center align-items-center text-center">
                                                        <a href="javascript:void(0);" class="d-block align-self-center button-primary add-cart"
                                                        data-json="<?= $value[$i]["Jsn"]?>"
                                                        >Add to Cart
                                                        </a>
                                                        <!-- <a href="#" class="d-block align-self-center button-primary">Add to Cart</a> -->
                                                        

                                                        <a href="javascript:void(0);" 
                                                           style="display: none;" 
                                                           class="product-card-btn mt-2 mx-auto remove-cart va-panel-remove-cart text-center" 
                                                           data-json="<?= $value[$i]["Jsn"]?>">
                                                           Remove From Cart
                                                        </a>
                                                        <!-- <a href="#" class="d-block align-self-center button-secondary">Delete</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php }else{
                    echo '<h3 class="nothing-to-show">Nothing to show</h3>';
                }?>
            </div>
        </div>
    </div>
</section>