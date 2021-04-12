<style>
    body {
        height: 100vh;
        overflow-y: hidden;
    }
    .wrapper {
      margin-top: 0px;
    }
</style>

<section class="main-content" >
   <div class="container">
      <div class="row">
         <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="featured-products panel-min-height">
               <div class="header">
                  <h2 class="d-inline">FEATURED PRODUCTS</h2>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon.png?>" class="float-right" alt="">
                  </a>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon_left.png?>" style="right: 90px;position:absolute;top: 50px;" alt="">
                  </a>
                  <div class="lds-roller" style="position:absolute; top:45%;right:45%;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                  </div>
               </div>
               <div class="slider featured-product-slider">
                     <?php foreach($ProdList as $value) {
                      if($value['IsFeatured'] != 1)
                        continue;
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
                                             <!--<a href="#" class="add_to_favorite">
                                                 <i class="fas fa-heart float-right"></i>
                                             </a>-->
                                         </div>
                                     </div>
                                     <a href="<?php echo base_url() . 'Cproduct/viewProduct/' . $value['ProductId']; ?>"> 
                                       <img class="img-fluid text-center" src="<?php echo base_url().$value['ProductImg']; ?>" alt="Card image cap">
                                       <?php if($discountPercentage > 0) { ?> 
                                          <p class="product-card-discount-banner"><?php echo round($discountPercentage)."% OFF"; ?></p>
                                       <?php } ?>
                                     </a>
                                     <div class="product-info text-left px-2">
                                          <p class="product-card-inner-subcategory"><?php echo $value['catAlias']?></p>
                                         <p class="card-text product-card-inner-name" title="<?php echo $value['ProductName']; ?>"><?php echo $value['ProductName']; ?></p>
                                         
                                         <!-- <p class="card-text product-card-inner-price d-inline"><script type="text/javascript">document.write(formatCurrency("<?php //echo $value['SalePrice']; ?>",0)); </script></p> -->
                                         <?php  
                                         $productObject = (object) [
                                            'id' => $value['ProductId'],
                                            'pName' => $value['ProductName'],
                                            'price' => $value['SalePrice'],
                                            'img' => base_url().$value['ProductImg'],
                                            'saleUnitQty' => $value['SaleUnitQty'],
                                             'saleUnit' => $value['UnitName'],
                                             'varient' => $value['VarientData']
                                        ];
                                        ?>
                                        <?php if($value['stock'] == '1') { ?>
                                          <?php if(count($value['VarientData']) > 0){?>
                                            <div class="input-group product-card-dropdown">
                                               <select class="custom-select prodvari" id="inputGroupSelect04" aria-label="Example select with button addon" style="background: url(<?php echo base_url('assets/img/dropdown-angle-down.png') ?>);background-repeat: no-repeat;background-size: 11px 7px;background-position: 95% 50%;">
                                                    <option value="-1">None</option>
                                                  <?php for ($i=0; $i < count($value['VarientData']); $i++) {?>
                                                    <option value="<?php echo $value['VarientData'][$i]['VId']?>"><?php echo $value['VarientData'][$i]['VName']?></option>
                                                  <?php } ?>
                                                  <!-- <option value="2">1 Dozen</option>
                                                  <option value="3">500 grm</option> -->
                                               </select>
                                            </div>
                                          <?php } else{?>
                                            <p class="card-text product-card-inner-weight"><?php echo $value["SaleUnitQty"] . " " .$value["UnitName"]?></p>
                                          <?php } ?>
                                          <!-- <p class="card-text product-card-inner-weight">
                                             <?php //echo empty($value['SaleUnitName']) ? $value['UnitName'] : $value['SaleUnitQty']. ' ' .$value['SaleUnitName'] ; ?></p> -->
                                          <div class="d-flex justify-content-start align-items-center product-card-inner-price">
                                             <p class="mainPrice c<?php echo $value['ProductId']?>"></p>
                                             <?php if($discountPercentage > 0) { ?> 
                                               <p class="originalPrice c<?php echo $value['ProductId']?>"></p>
                                             <?php } ?>
                                          </div>
                                          <script type="text/javascript">
                                            $(document).ready(function(){
                                              $('.mainPrice.c<?php echo $value['ProductId']?>').html(formatCurrency('<?=$value["SalePrice"];?>'));
                                              var orgPrc = $('.originalPrice.c<?php echo $value['ProductId']?>');
                                              if(orgPrc && orgPrc.length > 0){
                                                orgPrc.html(formatCurrency('<?=$value["Price"];?>'));
                                              }
                                            });
                                          </script>
                                         <div class="quantity-area d-flex justify-content-center align-items-center mt-2 text-center">
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
                                     <div class="d-flex align-items-center justify-content-center">
                                       <?php if($value['stock'] == '1') { ?>
                                       <a href="javascript:void(0);" class="product-card-btn add-cart"
                                       data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                       >Add to Cart</a>
                                       <!-- <a href="javascript:void(0);" style="display: none;" class="product-card-btn remove-cart"
                                       data-json="<?php //echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                       >Remove From Cart</a>
                                       <?php } ?> -->
                                    </div>
                                 </div>
                             </div>
                     <?php } ?>
               </div>
               
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="featured-products panel-min-height">
               <div class="header">
                  <h2 class="d-inline">HOT PRODUCTS</h2>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon.png?>" class="float-right" alt="">
                  </a>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon_left.png?>" style="right: 90px;position:absolute;top: 50px;" alt="">
                  </a>
                  <div class="lds-roller" style="position:absolute; top:45%;right:45%;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                  </div>
               </div>
               <div class="slider featured-product-slider">
                     <?php foreach($ProdList as $value) {
                      if($value['IsHot'] != 1)
                        continue;
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
                                             <!--<a href="#" class="add_to_favorite">
                                                 <i class="fas fa-heart float-right"></i>
                                             </a>-->
                                         </div>
                                     </div>
                                     <a href="<?php echo base_url() . 'Cproduct/viewProduct/' . $value['ProductId']; ?>"> 
                                       <img class="img-fluid text-center" src="<?php echo base_url().$value['ProductImg']; ?>" alt="Card image cap">
                                       <?php if($discountPercentage > 0) { ?> 
                                          <p class="product-card-discount-banner"><?php echo round($discountPercentage)."% OFF"; ?></p>
                                       <?php } ?>
                                     </a>
                                     <div class="product-info text-left px-2">
                                          <p class="product-card-inner-subcategory"><?php echo $value['catAlias']?></p>
                                         <p class="card-text product-card-inner-name" title="<?php echo $value['ProductName']; ?>"><?php echo $value['ProductName']; ?></p>
                                         
                                         <!-- <p class="card-text product-card-inner-price d-inline"><script type="text/javascript">document.write(formatCurrency("<?php //echo $value['SalePrice']; ?>",0)); </script></p> -->
                                         <?php  
                                         $productObject = (object) [
                                            'id' => $value['ProductId'],
                                            'pName' => $value['ProductName'],
                                            'price' => $value['SalePrice'],
                                            'img' => base_url().$value['ProductImg'],
                                             'saleUnitQty' => $value['SaleUnitQty'],
                                             'saleUnit' => $value['UnitName'],
                                             'varient' => $value['VarientData']
                                        ];
                                        ?>
                                        <?php if($value['stock'] == '1') { ?>
                                          <?php if(count($value['VarientData']) > 0){?>
                                            <div class="input-group product-card-dropdown">
                                               <select class="custom-select prodvari" id="inputGroupSelect04" aria-label="Example select with button addon" style="background: url(<?php echo base_url('assets/img/dropdown-angle-down.png') ?>);background-repeat: no-repeat;background-size: 11px 7px;background-position: 95% 50%;">
                                                    <option value="-1">None</option>
                                                  <?php for ($i=0; $i < count($value['VarientData']); $i++) {?>
                                                    <option value="<?php echo $value['VarientData'][$i]['VId']?>"><?php echo $value['VarientData'][$i]['VName']?></option>
                                                  <?php } ?>
                                                  <!-- <option value="2">1 Dozen</option>
                                                  <option value="3">500 grm</option> -->
                                               </select>
                                            </div>
                                          <?php } else{?>
                                            <p class="card-text product-card-inner-weight"><?php echo $value["SaleUnitQty"] . " " .$value["UnitName"]?></p>
                                          <?php } ?>
                                          <!-- <p class="card-text product-card-inner-weight">
                                             <?php //echo empty($value['SaleUnitName']) ? $value['UnitName'] : $value['SaleUnitQty']. ' ' .$value['SaleUnitName'] ; ?></p> -->
                                          <div class="d-flex justify-content-start align-items-center product-card-inner-price">
                                             <p class="mainPrice c<?php echo $value['ProductId']?>"></p>
                                             <?php if($discountPercentage > 0) { ?> 
                                               <p class="originalPrice c<?php echo $value['ProductId']?>"></p>
                                             <?php } ?>
                                          </div>
                                          <script type="text/javascript">
                                            $(document).ready(function(){
                                              $('.mainPrice.c<?php echo $value['ProductId']?>').html(formatCurrency('<?=$value["SalePrice"];?>'));
                                              var orgPrc = $('.originalPrice.c<?php echo $value['ProductId']?>');
                                              if(orgPrc && orgPrc.length > 0){
                                                orgPrc.html(formatCurrency('<?=$value["Price"];?>'));
                                              }
                                            });
                                          </script>
                                         <div class="quantity-area d-flex justify-content-center align-items-center mt-2 text-center">
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
                                     <div class="d-flex align-items-center justify-content-center">
                                       <?php if($value['stock'] == '1') { ?>
                                       <a href="javascript:void(0);" class="product-card-btn add-cart"
                                       data-json="<?php echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                       >Add to Cart</a>
                                       <!-- <a href="javascript:void(0);" style="display: none;" class="product-card-btn remove-cart"
                                       data-json="<?php //echo htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8'); ?>"
                                       >Remove From Cart</a>
                                       <?php } ?> -->
                                    </div>
                                 </div>
                             </div>
                     <?php } ?>
               </div>
               
            </div>
         </div>
      </div>
      <?php
         foreach($CatList as $key => $value) {?>
      <div class="row">
         <div class="col-xl-12 col-lg-12 col-md-12">
            <section class="edibles-main products-widget">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-3 pl-0">

                        <h2 class="products-widget-heading accordion" id="accordionCategory">
                           <div class="d-flex align-items-center justify-content-between">
                              <?=$key?>
                              <a href="javascript:void(0)" 
                                 type="button" 
                                 data-toggle="collapse" 
                                 data-target="<?='#collapse'.$value->childCats[0]['CategoryId']?>" 
                                 aria-expanded="false" 
                                 aria-controls="<?='collapse'.$value->childCats[0]['CategoryId']?>" 
                                 class="collapsed">
                                 <i class="fas fa-chevron-circle-down"></i>
                              </a>
                           </div>
                        </h2>
                        <div class="card product-category collapse show" id="<?='collapse'.$value->childCats[0]['CategoryId']?>" aria-labelledby="headingOne" data-parent="#accordionCategory">
                           <div class="card-body product-card-category-list">
                              <?php for ($i=0; $i < count($value->childCats); $i++) {?>
                              <div>
                                 <a href="<?='Cproduct/products?categoryId='.$value->childCats[$i]['CategoryId'] ?>"><?=$value->childCats[$i]['Alias']?></a>
                              </div>
                              <?php } ?>
                           </div>
                           <div class="card-footer">
                              <a href="<?='Cproduct/products?categoryId='.$value->childCats[0]['ParentId'] ?>">VIEW ALL</a>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-9 px-0">

                        <div class="container-fluid px-0">
                           <div class="container-fluid px-0">
                              <div class="row align-items-center justify-content-start" style="padding-right: 10px;">
                                 
                                 <?php if(is_array($value->childCats)) for ($i=0; $i < count($value->childCats); $i++) {?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 p-0">
                                       <div class="card mx-2 cat-card">
                                          <?php if(!empty($value->childCats[$i]['CatName'])){?>
                                          <img class="img-fluid" src="<?php echo base_url().$value->childCats[$i]['Img']; ?>" alt="Card image cap">
                                          <div class="card-body p-0">
                                             <p class="product-card-title" title="<?php echo $value->childCats[$i]['CatName']; ?>"><?php echo $value->childCats[$i]['CatName']; ?></p>
                                             <a href="javascript:void(0)" class="product-card-details-btn">&nbsp;</a>
                                          </div>
                                          <a href="<?php echo base_url().'Cproduct/products?categoryId='.$value->childCats[$i]['CategoryId']; ?>"
                                                class="product-card-viewmore-btn">View more</a>
                                          <?php } else { ?>
                                          <div class="card-img-bottom text-center" style="margin-top: 80%;background: #80808052;padding: 20%;">
                                             No Product
                                          </div>
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
         </div>
      </div>
      <?php } ?>
      <!-- HOUSEHOLD ESSENTIALS -->
   </div>
</section>

   <!-- Website Note -->
   <!-- <div id="websiteNote" style="z-index: 2000; display: block; position: fixed; top: 0vh; margin-left: 23%;">
       <div style="width: 70%; margin-top:35vh; animation-name: moveInUp;animation-duration: 0.5s; box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px;">
          <div class="p-0" style=" border-radius: 5px; border:1px solid #ffc107; background-color: #fff;">
             <div class="modal-body p-5">
                <a href="javascript:void(0)" id="websiteNoteDismiss" 
                   style="width: 36px !important;height: 36px !important;position: absolute;top: -16px;right: -16px;opacity: 1;border-radius: 18px !important; background-color: #000000 !important;align-items: center;vertical-align: middle;">
                   <span style="display: block; font-size: 28px;color: #ffffff;font-weight: 100;font-family: 'Work Sans';align-items: center;
                         width: 100%;position: absolute;top: -3px;right: -10px;">&times;</span>
                </a>
                <div class="text-center">
                   <i class="fas fa-exclamation-triangle fa-3x text-warning mb-4"></i>
                   <h4 class="font-weight-normal initialism text-center font-weight-bold" style="font-size: 95%; line-height: 1.6;">Valued customers, please note that our website is currently going through some test runs and hence cannot process orders. Please call us at  0318-2294472 / 0345-9236839 / 0321-2025777 for any queries that you may have or if you wish to place an order. We apologize for any inconvenience caused due to this.</h4>
                </div>
                
             </div>
          </div>
       </div>
    </div> -->
   
    <!-- Website Note -->

<style>
html{
   overflow: hidden;
}
</style>
<script type="text/javascript">
   var numberOfPageList = [];
   var groceryAssistantData = [];
   var currentCategoryName;
   var assistantJsonArray;
   var isCatButtonSearch = false;
   $(document).ready(function() {
      $('.bg-overlay').hide();
      $("body").css({"height": "100%", "overflow-y": "none"});
      $("html").css({"overflow": "auto"});
      // Website Note
      // if($(window).width() < 770)
      //    $("#dryr").trigger("click");
      // $("body").css({"height": "100vh", "overflow-y": "hidden"});
      
      // $('#websiteNoteDismiss').click(function() {
      //    $('#websiteNote').hide();
      //    $("body").css({"height": "100%", "overflow-y": "none"});
      //     $("html").css({"overflow": "auto"});
      //    $('.bg-overlay').hide();
      // });
     // Website Note Ends
      $(document).on('click', '#popup-checkout', function () {
         checkout($(this));
      });

      $('.featured-product-slider').on('init', function(event, slick, direction){
         $('.lds-roller').hide();
      });

      function checkout(currentElement){
         var cart = getCookie('baskit');
         if(!cart){
            $.notify(`Please add some product before checkout`, "error");
         }
         cart = JSON.parse(cart);
         if(cart.length > 0){
            var url = "<?php echo base_url() ?>Corder/checkout_form";
            window.location.href = url;
         }
         else{
            $.notify(`Please add some product before checkout`, "error");
         }
      }

      $('#myCollapsible').collapse({
         toggle: false
      })
   });

</script>
<style type="text/css">
   .slick-next{
       top: -34px !important;
       right: 0px !important;
   }
   .slick-prev{
      top: -34px !important;
      right: 40px !important;
      left: auto !important;
   }

   .slick-next:before{
      color: black;
      content: '';
   }
   .slick-prev:before{
      color: black;
      content: '';
   }
   .grocery-features .card {
      height: 224px;
   }
   .product-card-inner-name {
      /* white-space: nowrap; */
      width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
   }
   .product-card-title {
      /* white-space: nowrap; */
      width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
   }
   .form-check{
      display: inline-block;
      margin-right: 10px;
   }
   .filterSelected{
      box-shadow: 1px 1px 10px 1px green;
   }
   .filterSelected : focus{
      box-shadow: 1px 1px 10px 1px green;
   }
   .cat-card{
      padding: 10px;
      margin-bottom: 10px;
   }
   .cat-card, .cat-card img{
      border-radius: 2px;
      /* 10px 10px 0px 0px; */
   }

   @media (max-width: 1024px) {
      .main-content .featured-products-content .product-card-inner {
         width: unset;
      }
   }
   @media (max-width: 320px) {
      .featured-products-content .product-card-inner {
         width: 120px !important;
      }
   }
   
</style>