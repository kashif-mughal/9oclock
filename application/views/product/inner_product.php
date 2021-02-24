<!-- Bread Crumb -->

<div class="bread_crumb">
    <div class="container">
        <div class="row d-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="https://saudaexpress.com/">Home</a></li>
                    <!--<li class="breadcrumb-item"><a href="#"><?php echo $SelectCategory['MainCategory']; ?></a></li>-->
                    <li class="breadcrumb-item"><?php echo $SelectCategory['SubCategory']; ?></li>
                </ol>
            </nav>
            <h3 class="mb-0 d-inline"><?php echo $SelectCategory['MainCategory']; ?><?php if($CurrentBrandName){echo " (".$CurrentBrandName.")";}?></h3>
        </div>
    </div>
</div>

<!-- Bread Crumb -->

<section class="inner-product-main">
   <div class="container">
      <div class="row inner-product-content">
         <div class="col-xl-6 col-lg-6 col-md-12">
            <a href="javascript:void(0);" style="display: none;" class="product-card-btn mx-auto remove-cart"
                   data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>">Remove From Cart
            </a>
            <img src="<?php echo base_url() . $ProductImg; ?>" alt="" style="width: 100%;">
         </div>
         <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="inner-product-content-info d-flex flex-column align-items-stretch justify-content-between">
               <div class="inner-product-top mb-5">
                  <h2 class="main-heading"><?php echo $product_name; ?></h2>
                  <p><?php echo $sale_unit_qty . ' ' . $unitName; ?></p>
               </div>

               <div class="inner-product-mid my-5">
                  <?php $orignalPrice = ($OriginalPrice != $sale_price) ? $OriginalPrice : ''; ?>
                  <span class="price"><?php echo 'Rs. ' . $sale_price; ?></span><span class="discount"><?php echo 'Rs. ' . $orignalPrice; ?></span>
                  <div>
                     <select name="unitVariant" id="unitVariant" class="form-control" style="width:200px;">
                        <option value="1">1 Dozen</option>
                        <option value="2">1 Kg</option>
                        <option value="3">500 gm</option>
                     </select>
                  </div>
               </div>

               <?php 
                  
                  $productObject = (object) [
                     'id' => $product_id,
                     'pName' => $product_name,
                     'price' => $sale_price,
                     'img' => base_url().$ProductImg,
                     'saleUnitQty' => $sale_unit_qty,
                     'saleUnit' => $unitName
                  ];
               ?>
               
               <div class="inner-product-bottom mt-5 each-prod">
                  <div class="quantity-area d-flex justify-content-start align-items-start mt-2">
                     <span class="d-inline-flex quantity-text mr-1">Qty</span>
                     <input type="text" class="d-inline-flex quantity-input quantity">
                     <span class="d-block quantity-button text-center">
                        <a href="javascript:void(0);" class="qty-pls d-block">+</a>
                        <div class="separator"></div>
                        <a href="javascript:void(0);" class="qty-mns d-block">-</a>
                     </span>
                  </div>
                  <div class="my-3">
                     <a href="javascript:void(0);" class="product-card-btn mx-auto add-cart"
                        data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                        >Add to Cart
                     </a>
                     <a href="javascript:void(0);" style="display: none;" class="product-card-btn mx-auto remove-cart"
                        data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                        >Remove From Cart
                     </a>
                  </div>
               </div>


            </div>
         </div>
            
      </div>

      <?php if($Description != null || $Description != '') { ?>
         <div class="row inner-product-content">
            <div class="inner-product-description">
               <h4>Description</h4>
               <div class="d-block mt-3">
                  <p><?php echo $Description; ?></p>
               </div>
            </div>
         </div>
      <?php } ?>

   
</div>





   </div>
</section>

<section>
<div class="container">
      <div class="row inner-product-content">
         <div class="inner-product-similar">
         <div class="featured-products panel-min-height">
               <div class="header">
                  <h2 class="d-inline">SIMILAR PRODUCTS</h2>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon.png?>" class="float-right" alt="">
                  </a>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon_left.png?>" style="right: 65px;position:absolute;top: 30px;" alt="">
                  </a>
                  <div class="lds-roller" style="position:absolute; top:45%;right:45%;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
               </div>
               <div class="slider featured-product-slider">
                     <?php foreach($similarProducts as $value) { 
                         $discountPercentage = (($value['Price'] - $value['SalePrice'])/$value['Price']) * 100;
                         ?>
                             <div class="featured-products-content d-flex align-items-center justify-content-start">
                                 <div class="card mr-2 each-prod product-card-inner" style="padding-top:5px; padding-bottom: 10px; height: unset !important;">
                                     <div class="card-body p-0">
                                         
                                         <?php if($value['stock'] == '0') { 
                                         echo '<h5>Out Of Stock</h5>'; 
                                         }elseif($value['stock'] == '2'){
                                              echo '<h5>Out Of Season</h5>'; 
                                         }?>
                                         <div class="header">
                                             <?php if($discountPercentage != 0) { ?> 
                                                 <h5 class="card-title float-left"><?php echo round($discountPercentage)."% OFF"; ?></h5>
                                             <?php } ?>
                                             <!--<a href="#" class="add_to_favorite">
                                                 <i class="fas fa-heart float-right"></i>
                                             </a>-->
                                         </div>
                                     </div>
                                     <img style="max-height: 145px;" class="img-fluid text-center" src="<?php echo base_url().$value['ProductImg']; ?>" alt="Card image cap">
                                     <div class="product-info text-center">
                                         <p class="card-text product-card-inner-name" title="<?php echo $value['ProductName']; ?>"><?php echo $value['ProductName']; ?></p>
                                         <p class="card-text product-card-inner-weight">
                                             <?= empty($value['SaleUnitName']) ? $value['UnitName'] : $value['SaleUnitQty']. ' ' .$value['SaleUnitName'] ; ?></p>
                                         <!-- <p class="card-text product-card-inner-price d-inline"><script type="text/javascript">document.write(formatCurrency("<?php echo $value['SalePrice']; ?>",0)); </script></p> -->
                                         <?php if($discountPercentage != 0) { ?> 
                                             <span class="product-discount"><del><script type="text/javascript">document.write(formatCurrency("<?php echo $value['Price']; ?>",0)); </script></del></span>
                                         <?php } 
                                         $productObject = (object) [
                                            'id' => $value['ProductId'],
                                            'pName' => $value['ProductName'],
                                            'price' => $value['SalePrice'],
                                            'img' => base_url().$value['ProductImg'],
                                             'saleUnitQty' => $value['SaleUnitQty'],
                                             'saleUnit' => $value['UnitName']
                                        ];
                                        ?>
                                        <?php if($value['stock'] == '1') { ?>
                                         <div class="quantity-area d-flex justify-content-center align-items-center mt-2">
                                             <span class="d-inline-flex quantity-text mr-1">Qty</span>
                                             <input type="text" class="d-inline-flex quantity-input quantity">
                                             <span class="d-block quantity-button">
                                                 <a href="javascript:void(0);" class="qty-pls d-block">+</a>
                                                 <div class="separator"></div>
                                                 <a href="javascript:void(0);" class="qty-mns d-block">-</a>
                                             </span>
                                         </div>
                                         <?php } ?>
                                     </div>
                                     <?php if($value['stock'] == '1') { ?>
                                     <a href="javascript:void(0);" class="product-card-btn mx-auto add-cart"
                                     data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                     >Add to Cart</a>
                                     <a href="javascript:void(0);" style="display: none;" class="product-card-btn mx-auto remove-cart"
                                     data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                     >Remove From Cart</a>
                                     <?php } ?>
                                 </div>
                             </div>
                     <?php } ?>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</section>
