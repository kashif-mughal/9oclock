<style>
    body {
        height: 100vh;
        overflow-y: hidden;
    }
</style>

<section class="main-content" >
   <div class="container">
      <div class="row">
         <div class="col-xl-8 col-lg-8 col-md-12 pr-md-0">
            <div class="featured-products panel-min-height">
               <div class="header">
                  <h2 class="d-inline">FEATURED PRODUCTS</h2>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon.png?>" class="float-right" alt="">
                  </a>
                  <a class="d-none d-md-inline" href="javascript:void(0)">
                     <img src="<?php echo base_url() ?>assets/img/featured_product_arrow_icon_left.png?>" style="right: 65px;position:absolute;top: 30px;" alt="">
                  </a>
                  <div class="lds-roller" style="position:absolute; top:45%;right:45%;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
               </div>
               <div class="slider featured-product-slider">
                     <?php foreach($ProdList as $value) { 
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
         <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="row">
               <div class="col-lg-12 col-md-6 grocery-features-columns">
                  <div class="grocery-features shop-assistant-feature">
                     <div class="card">
                        <div class="card-body grocery-assistant-card">
                           <div class="container-fluid px-0">
                              <h6 class="card-title mb-0">Walk through all sections of the store with our assistant</h6>
                              <div class="row">
                                 <div class="col-md-7 pr-0">
                                    <h4 class="card-heading pt-3 mb-2">SHOP ASSISTANT</h4>
                                    <button class="card-button" id="shopAssistantButton" data-toggle="modal" data-target="#virtualAssistant">Use Assistant</button>
                                 </div>
                                 <div class="image-container">
                                    <img src="<?php echo base_url() ?>assets/img/grocery-assitant-icon.png?>" alt="Grocery Assistant Icon" class="img-fluid" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 col-md-6 grocery-features-columns">
                  <div class="grocery-features value-cart-feature">
                     <div class="card">
                        <div class="card-body value-cart">
                           <div class="container-fluid px-0">
                              <h4 class="card-heading">Value Cart</h4>
                              <div class="row">
                                 <div class="col-md-7 pr-0">                                    
                                    <h6 class="card-title mb-3">Let us assist you in building the most economical cart</h6>
                                    <button class="card-button" onclick="window.location.href = '<?=base_url("user/value_cart")?>'">Build Value Cart</button>
                                 </div>
                                 <div class="value-cart-feature-image">
                                    <img src="<?= base_url("assets/img/value-cart.png") ?>" alt="Grocery Assistant Icon" class="img-fluid" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
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
                                             <a href="javascript:void(0)" class="product-card-details-btn">View more details</a>
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
 <!-- Virtual Assistant -->
<div id="virtualAssistant" class="modal fades" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content p-0">
         <div class="modal-body p-0">
            <a href="javascript:void(0)" class="close" data-dismiss="modal" data-target="virtualAssistant" id="virtualAssistantDismiss">
               <span>&times;</span>
            </a>
            <!-- <a href="javascript:void(0)" type="button" class="close mx-auto" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </a> -->
            <div id="va-panel">
               <div class="va-panel-header d-flex justify-content-between p-3">
                  <img src="<?=base_url("assets/img/GroceryAssistant/Logo-color.png");?>">
                  <div class="d-flex align-items-center ml-2">
                     <img src="<?=base_url("assets/img/GroceryAssistant/grocery_assistant_logo.png")?>" class="d-block">
                     <span class="va-panel-heading d-block">Shop Assistant</span>
                  </div>
               </div>
               <div class="va-panel-header-sub py-3 text-center">
                  <span class="heading-primary d-block">Category: <span id="va-panel-heading-category"></span></span>
                  <span class="heading-secondary d-block">Sub Category: <span id="va-panel-heading-sub-category"></span></span>
               </div> 
               <div class="va-panel-content">
                  <div class="container-fluid">
                     <div class="row" style="width: 105%;">
                        <div class="col-md-4 px-0 pt-0">
                           <div class="filter-sidebar" style="margin-left: 8px;">
                              <button onclick="filterAssistantProduct()" id="showFilterResultBtn" style="display: none; background-color: transparent; border: none;">
                                 <h4 class="ribbon">
                                    <strong class="ribbon-content">SHOW RESULT</strong>
                                 </h4>
                              </button>
                              <div id="main-drawyer" class="accordion filter-header d-flex px-4 py-3 border-b-primary">
                                 <div id="dryr" data-toggle="collapse" 
                                       type="button" 
                                       aria-expanded="false" 
                                       data-target="#main-drawyer-content"
                                       aria-controls="main-drawyer-content" class="filter-icon mr-2">
                                    <img src="<?=base_url("assets/img/GroceryAssistant/filter.png")?>">   
                                 </div>                           
                                 <span class="filter-heading">Use Filters to Find your Product</span>
                                 <button onclick="clearAllFilters();" id="clearFilter" class="align-items-top justify-content-center ml-auto" style="display: none;">
                                    <div class="clearFilterContainer mr-2" style="position: relative;margin-top: 3px;background: #fff;">
                                       <i class="fas fa-filter" style="position: absolute;color: #808080;"></i>
                                       <i class="fas fa-slash" style="position: absolute;left: -2px;top: 0px;"></i>
                                    </div>
                                    <span class="ml-2 clearFilterText">Clear Filters</span>
                                 </button>
                              </div>
                              <div class="collapse show" id="main-drawyer-content" data-parent="#main-drawyer">
                                 <div class="accordion" id="va-filter">
                                    <div class="filter-brand px-4 py-3 border-b-primary">
                                       <div class="heading-primary d-flex justify-content-between align-items-center mb-3">
                                          <div>Filter by Brand:</div>
                                          <a href="javascript:void(0)" 
                                             data-toggle="collapse" 
                                             type="button" 
                                             aria-expanded="false" 
                                             data-target="#brand-filter-area"
                                             aria-controls="brand-filter-area">
                                             <i class="fas fa-chevron-circle-down"></i>
                                          </a>                                    
                                       </div>
                                       <div class="filter-brand-button collapse show" id="brand-filter-area" data-parent="#va-filter">
                                       </div>
                                    </div>

                                    <div class="filter-weight px-4 py-3 border-b-primary">
                                       <div class="heading-primary d-flex justify-content-between align-items-center mb-3">
                                          <div>Filter by Weight:</div>
                                          <a href="javascript:void(0)" 
                                             data-toggle="collapse" 
                                             type="button" 
                                             aria-expanded="false" 
                                             data-target="#saleunit-filter"
                                             aria-controls="saleunit-filter">
                                             <i class="fas fa-chevron-circle-down"></i>
                                          </a> 
                                       </div>
                                       <div class="filter-weight-button collapse show" id="saleunit-filter" data-parent="#va-filter">
                                       </div>
                                    </div>

                                    <div class="filter-type px-4 py-3 border-b-primary">
                                       <div class="heading-primary d-flex justify-content-between align-items-center mb-3">
                                          <div>Filter by Tags:</div>
                                          <a href="javascript:void(0)" 
                                             data-toggle="collapse" 
                                             type="button" 
                                             aria-expanded="false" 
                                             data-target="#tag-filter-area"
                                             aria-controls="tag-filter-area">
                                             <i class="fas fa-chevron-circle-down"></i>
                                          </a>
                                       </div>
                                       <div class="filter-type-checkbox collapse show" id="tag-filter-area" data-parent="#va-filter">
                                       </div>                                    
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-8 pl-2 pt-3">
                           <div class="product-content">
                              <div class="container-fluid">
                                 <div class="row" id="product-wrt-cat">
                                    
                                 </div>
                              </div>
                           </div>

                           <div class="product-content-button my-4 text-center" id="pagination-btn">
                              
                           </div>

                           <div class="product-content-button my-4 text-center" id="pagination-category-btn">
                           </div>

                        </div>
                     </div>
                  </div>
               </div>  

               <div class="va-panel-footer">
                  <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                     <button class="btn btn-link va-panel-footer-btn-red mb-2 mb-md-0 text-center" data-dismiss="modal">Leave Grocery Assistant</button>
                     <button class="btn btn-link va-panel-footer-btn-black mb-2 mb-md-0" id="nextCategoryBtn">Previous Category</button>
                     <button class="btn btn-link va-panel-footer-btn-black mb-2 mb-md-0" id="prevCategoryBtn">Next Category</button>
                     <button class="btn btn-link va-panel-footer-btn-green mb-2 mb-md-0" id="popup-checkout">Checkout</button>
                  </div>
               </div>

            </div>
            
         </div>
      </div>
   </div>
</div>
<div style="display: none;">
    <script type="text" id="clone-cart">
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="featured-products-content mb-2 justify-content-between">
            <div class="card each-prod product-card-inner p-1">
                <img class="img-fluid text-center" src="{Img}" alt="Card image cap">
                <div class="product-info text-center">
                    <p class="card-text product-card-inner-name" title="{ProductName}">{ProductName}</p>
                    <p class="card-text product-card-inner-weight">{UnitName}</p>
                    <p class="card-text product-card-inner-price d-inline">{SalePrice}</p>
                    <div class="quantity-area d-flex justify-content-center align-items-center mt-2" style="width:auto;">
                        <span class="d-inline-flex quantity-text mr-1">Qty</span>
                        <input type="text" class="d-inline-flex quantity-input quantity">
                        <span class="d-block quantity-button">
                            <a href="javascript:void(0);" class="qty-pls d-block">+</a>
                            <div class="separator"></div>
                            <a href="javascript:void(0);" class="qty-mns d-block">-</a>
                        </span>
                    </div>
                </div>
                <a href="javascript:void(0);" class="product-card-btn mx-auto add-cart p-2 text-center" style="width:88%;"
                data-json="{Jsn}"
                >Add to Cart</a>
                <a href="javascript:void(0);" style="display: none; width:90%;" class="product-card-btn mx-auto remove-cart"
                data-json="{Jsn}"
                >Remove From Cart</a>
            </div>
        </div>
    </div>
    </script>
</div>
   <!-- Virtual Assistant -->

   <!-- Website Note -->
   <div id="websiteNote" style="z-index: 2000; display: block; position: fixed; top: 0vh; margin-left: 23%;">
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
    </div>
   <div class="bg-overlay" style="position: fixed; top: 0; background-color:#000; width: 100%; height: 100vh; z-index: 1999; opacity: 0.5;"></div>
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
      // Website Note
      if($(window).width() < 770)
         $("#dryr").trigger("click");
      $("body").css({"height": "100vh", "overflow-y": "hidden"});
      
      $('#websiteNoteDismiss').click(function() {
         $('#websiteNote').hide();
         $("body").css({"height": "100%", "overflow-y": "none"});
          $("html").css({"overflow": "auto"});
         $('.bg-overlay').hide();
      });
     // Website Note Ends
      $(document).on('click', '#popup-checkout', function () {
         checkout($(this));
      });
      var groceryAssistantNumber = 0;
      var categoryByName = [];
      var assistantJson = JSON.parse(`<?=$Assistant?>`);
      assistantJsonArray = assistantJson;
      
      for(each in assistantJson["Assistant"])
      {
         categoryByName.push(each);
      }

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

      $('#shopAssistantButton').click(function() {
         document.body.style.position = 'fixed';
         document.body.style.top = `-${window.scrollY}px`;
      });

      $('#virtualAssistant').on('hidden.bs.modal', function (e) {
         const scrollY = document.body.style.top;
         document.body.style.position = '';
         document.body.style.top = '';
         window.scrollTo(0, parseInt(scrollY || '0') * -1);
      });
      
      groceryAssistantData = setupGroceryAssistant(groceryAssistantNumber);
      
      $('#prevCategoryBtn').click(function() {

         var foundCurrentCat = false;
         var nextCat;
         for(each in groceryAssistantData) {
            if(foundCurrentCat) {
               nextCat = each;
               break;
            }
            if(each == currentCategoryName)
               foundCurrentCat = true;
         }
         if(nextCat) {

            $("#brand-filter-area").empty();
            $("#saleunit-filter").empty();
            $("#tag-filter-area").empty();

            var brandArea = $("#brand-filter-area");
            var weightArea = $("#saleunit-filter");
            var tagArea = $("#tag-filter-area");

            var counter = 0;
            var brandAreaArray = [];
            var weightAreaArray = [];
            var tagAreaArray = [];
            for(each in assistantJson["Assistant"][nextCat]) {
               var tagsArray = [];

               if(assistantJson["Assistant"][nextCat][each]["BrandName"] && (brandAreaArray.indexOf(assistantJson["Assistant"][nextCat][each]["BrandName"]) == -1)) {
                  brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJson["Assistant"][nextCat][each]["BrandName"]}">${assistantJson["Assistant"][nextCat][each]["BrandName"]}</button>`);
                  brandAreaArray.push(assistantJson["Assistant"][nextCat][each]["BrandName"]);
               }       

               if(assistantJson["Assistant"][nextCat][each]["SaleUnitQuantity"] && (weightAreaArray.indexOf(assistantJson["Assistant"][nextCat][each]["SaleUnitQuantity"]) == -1)) {
                  weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJson["Assistant"][nextCat][each]["SaleUnitQuantity"]}" class="btn btn-link mb-2">${assistantJson["Assistant"][nextCat][each]["SaleUnitQuantity"]}</button>`);  
                  weightAreaArray.push(assistantJson["Assistant"][nextCat][each]["SaleUnitQuantity"]);
               }
               var tagString = assistantJson["Assistant"][nextCat][each].tags;
               tagsArray = tagString.split(",");

               for(tag in tagsArray) {
                  if(tagsArray[tag] && (tagAreaArray.indexOf(tagsArray[tag]) == -1)) {
                     tagArea.append(`<div class="form-check">
                                   <input class="form-check-input" data-value="${tagsArray[tag]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${tagsArray[tag]}">
                                   <label class="form-check-label" for="tag${counter}">${tagsArray[tag]}</label>
                                 </div>`);
                     tagAreaArray.push(tagsArray[tag]);
                  }
               }

            }

            $('#nextCategoryBtn').attr('disabled', false);
            $('#prevCategoryBtn').attr('disabled', false);
            $('#product-wrt-cat').empty();
            $("#va-panel-heading-category").text(assistantJson["Assistant"][nextCat][0]["parentCategory"]);
            $("#va-panel-heading-sub-category").text(assistantJson["Assistant"][nextCat][0]["CatName"]);
            var productContainer = $('#product-wrt-cat');
            if(groceryAssistantData[nextCat]) {
               productContainer.append(groceryAssistantData[nextCat][0]);
               $('#pagination-btn').empty();
               for(var i = 0; i < numberOfPageList[nextCat]; i++) {
                  $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${nextCat}')">${i+1}</button>`);
               }
               currentCategoryName = nextCat;
            }
         }
         else {
            $('#nextCategoryBtn').attr('disabled', false);
            $('#prevCategoryBtn').attr('disabled', true);
         }
         
         isCatButtonSearch = false;
      });
        
      // nextCategoryBtn
      $('#nextCategoryBtn').click(function() {
         var foundCurrentCat = false;
         var prevCat;
         var catIndex;
         var isLastCat;
         for(each in groceryAssistantData) {
            if(each == currentCategoryName) {
               foundCurrentCat = true;
               break;
            }
            prevCat = each;
         }

         if(prevCat) {

            $("#brand-filter-area").empty();
            $("#saleunit-filter").empty();
            $("#tag-filter-area").empty();

            var brandArea = $("#brand-filter-area");
            var weightArea = $("#saleunit-filter");
            var tagArea = $("#tag-filter-area");

            var counter = 0;

            var brandAreaArray = [];
            var weightAreaArray = [];
            var tagAreaArray = [];
            for(each in assistantJson["Assistant"][prevCat]) {
               var tagsArray = [];
               
               if(assistantJson["Assistant"][prevCat][each]["BrandName"] && (brandAreaArray.indexOf(assistantJson["Assistant"][prevCat][each]["BrandName"]) == -1)) {
                  brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJson["Assistant"][prevCat][each]["BrandName"]}">${assistantJson["Assistant"][prevCat][each]["BrandName"]}</button>`);
                     brandAreaArray.push(assistantJson["Assistant"][prevCat][each]["BrandName"]);
               }       

               if(assistantJson["Assistant"][prevCat][each]["SaleUnitQuantity"] && (weightAreaArray.indexOf(assistantJson["Assistant"][prevCat][each]["SaleUnitQuantity"]) == -1)) {
                  weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJson["Assistant"][prevCat][each]["SaleUnitQuantity"]}" class="btn btn-link mb-2">${assistantJson["Assistant"][prevCat][each]["SaleUnitQuantity"]}</button>`);  
                  weightAreaArray.push(assistantJson["Assistant"][prevCat][each]["SaleUnitQuantity"]);
               }

               var tagString = assistantJson["Assistant"][prevCat][each].tags;
               tagsArray = tagString.split(",");

               for(tag in tagsArray) {
                  if(tagsArray[tag] && (tagAreaArray.indexOf(tagsArray[tag]) == -1)) {
                     tagArea.append(`<div class="form-check">
                                   <input class="form-check-input" data-value="${tagsArray[tag]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${tagsArray[tag]}">
                                   <label class="form-check-label" for="tag${counter}">${tagsArray[tag]}</label>
                                 </div>`);
                     tagAreaArray.push(tagsArray[tag]);
                  }
               }

            }
            
            $('#prevCategoryBtn').attr('disabled', false);
            $('#nextCategoryBtn').attr('disabled', false);
            $('#product-wrt-cat').empty();
            $("#va-panel-heading-category").text(assistantJson["Assistant"][prevCat][0]["parentCategory"]);
            $("#va-panel-heading-sub-category").text(assistantJson["Assistant"][prevCat][0]["CatName"]);
            var productContainer = $('#product-wrt-cat');
            if(groceryAssistantData[prevCat]) {
               productContainer.append(groceryAssistantData[prevCat][0]);
               $('#pagination-btn').empty();
               for(var i = 0; i < numberOfPageList[prevCat]; i++) {
                  $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${prevCat}')">${i+1}</button>`);
               }
               currentCategoryName = prevCat;
            }
         }
         else {
            $('#nextCategoryBtn').attr('disabled', true);
            $('#prevCategoryBtn').attr('disabled', false);
         }
         
         isCatButtonSearch = false;
      });

      $('#myCollapsible').collapse({
         toggle: false
      })
   });

   function filterAssistantProduct() {
      var assistantJson2 = JSON.parse(`<?=$Assistant?>`);
      var assistantData = assistantJson2["Assistant"];
      var brandSelector = $('.filter-brand .filterSelected');
      var weightSelector = $('.filter-weight .filterSelected');
      var tagSelector = $('.filter-type .filterSelected');
      var selectedBrands = [];
      var selectedWeights = [];
      var selectedTags = [];

      for(var b = 0; b < $('.filter-brand .filterSelected').length; b++) {
         selectedBrands.push($(brandSelector[b]).data('value'));
      }
      for(var b = 0; b < $('.filter-weight .filterSelected').length; b++) {
         selectedWeights.push($(weightSelector[b]).data('value'));
      }
      for(var b = 0; b < $('.filter-type .filterSelected').length; b++) {
         selectedTags.push($(tagSelector[b]).data('value'));
      }
      var finalFilterData = [];
      $('#product-wrt-cat').empty();
      var container = $('#product-wrt-cat');
      var eachPage = 8;
      var cartTemplate = $('#clone-cart').text();
      var baseUrl = '<?=base_url()?>';
      var catIndex = 0;
      $('#pagination-category-btn').empty();
      
      if(isCatButtonSearch) {
         currentCategoryName = $("#va-panel-heading-sub-category").text();
      }

      for(each in assistantData) {
         if(!isCatButtonSearch) {
            if(!currentCategoryName) 
               currentCategoryName = each;
         }
         var pages = [];
         var brands;
         var weights;
         var tags;
         var numberOfPagesCurrent = 0;
         // for(item in assistantData[each]) {
            for(var m = 0; m < assistantData[each].length; m++) {
               var brandsInternal = selectedBrands.length != 0 ? selectedBrands.includes(assistantData[each][m].BrandName) : true;
               var weightsInternal = selectedWeights.length != 0 ? selectedWeights.includes(assistantData[each][m].SaleUnitQuantity) : true;
               
               var tagsInternal = true;
               if(selectedTags.length) {
                  var currentProductTagsArray = assistantData[each][m].tags.split(',');
                  for(var t = 0; t < selectedTags.length; t++) {
                     if( currentProductTagsArray.includes(selectedTags[t]) ) {
                        tagsInternal = true;
                     }
                     else {
                        tagsInternal = false;
                     }
                  }
               }

               if(brandsInternal && weightsInternal && tagsInternal) {
                  numberOfPagesCurrent++;
               }

            }
         // }

         var totalProducts = numberOfPagesCurrent; // total products
         var numberOfPages = Math.ceil(totalProducts/eachPage); // number of pages
         numberOfPageList[each] = numberOfPages;
         for (var i = 0; i < numberOfPageList[each]; i++) {
            var catProductList = [];
            for(var k = i * eachPage; k < eachPage + (eachPage * i); k++) {
               if(!assistantData[each][k]) break;
               var brandAvailable = selectedBrands.length != 0 ? selectedBrands.includes(assistantData[each][k].BrandName) : true;
               var weightAvailable = selectedWeights.length != 0 ? selectedWeights.includes(assistantData[each][k].SaleUnitQuantity) : true;
               
               var tagsAvailable = true;
               if(selectedTags.length) {
                  var currentProductTagsArray = assistantData[each][k].tags.split(',');
                  for(var t = 0; t < selectedTags.length; t++) {
                     if( currentProductTagsArray.includes(selectedTags[t]) ) {
                        tagsAvailable = true;
                     }
                     else {
                        tagsAvailable = false;
                     }
                  }
               }
               if( brandAvailable && weightAvailable && tagsAvailable && (each == currentCategoryName)) {
                  var cartTemplateCopy = cartTemplate;
                  cartTemplateCopy = cartTemplateCopy.replace(/{Img}/g, baseUrl + assistantData[each][k].ProductImg);
                  cartTemplateCopy = cartTemplateCopy.replace(/{ProductName}/g, assistantData[each][k].ProductName);
                  cartTemplateCopy = cartTemplateCopy.replace(/{UnitName}/g, !assistantData[each][k].UnitName ? assistantData[each][k].UnitName : 
                     (assistantData[each][k].SaleUnitQty + " " + assistantData[each][k].SaleUnitName)
                     );
                  cartTemplateCopy = cartTemplateCopy.replace(/{SalePrice}/g, formatCurrency(assistantData[each][k].SalePrice,0));
                  cartTemplateCopy = cartTemplateCopy.replace(/{Jsn}/g, assistantData[each][k].Jsn);
                  catProductList.push(cartTemplateCopy);
               }
            }
            if(catProductList.length > 0) { pages.push(catProductList); }
         }
         if(pages.length > 0) { 
            finalFilterData[each] = pages; 
            $('#pagination-category-btn').append(`<button type="button" class="btn btn-link nav-btn-secondary mx-1" title="${each}" onclick="renderCategoryPages('${each}')">${catIndex+1}</button>`);
            catIndex++;
            //setupGroceryAssistant();
         }
      }
      if(finalFilterData[currentCategoryName]) { 
         $("#va-panel-heading-category").text(assistantData[currentCategoryName][0]["parentCategory"]);
         $("#va-panel-heading-sub-category").text(assistantData[currentCategoryName][0]["CatName"]);
         for(var j = 0; j < finalFilterData[currentCategoryName][0].length; j++) {
            container.append(finalFilterData[currentCategoryName][0][j]);
         } 
      }
      $('#pagination-btn').empty();
      for(var i = 0; i < numberOfPageList[currentCategoryName]; i++) {
         $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${currentCategoryName}')">${i+1}</button>`);
      }
      if ($(window).width() < 576) {
         $('#dryr').click();
      }
      $('#showFilterResultBtn').hide();
      groceryAssistantData = finalFilterData;

   }

   function toggleAndCheckActiveFilter(currentElement){
      currentElement = $(currentElement);
      if(currentElement.hasClass("filterSelected")){
         currentElement.removeClass("filterSelected");
      }
      else
         currentElement.addClass("filterSelected");

      if(anyFilterSelected()) {
         $("#showFilterResultBtn").show();
         $('#clearFilter').css("display", "flex");
         $("#clearFilter").show();
      }
      else {
         $("#showFilterResultBtn").hide();
         $("#clearFilter").hide();
      }
      var selectedItemsLength = $('.filterSelected').length;
      if(selectedItemsLength == 0) {
         clearAllFilters();
      }
      // isCatButtonSearch = false;
   }

   function clearAllFilters() {
      var currentCategoryNameAfterClear = currentCategoryName;
      var brandFilter = $('.filter-sidebar .filter-brand .filter-brand-button button');
      var weightFilter = $('.filter-sidebar .filter-weight .filter-weight-button button');
      var tagsFilter = $('.filter-sidebar .filter-type .filter-type-button button');
      if(brandFilter.hasClass("filterSelected")) {
         brandFilter.removeClass("filterSelected");
      }
      if(weightFilter.hasClass("filterSelected")) {
         weightFilter.removeClass("filterSelected");
      }
      if(tagsFilter.hasClass("filterSelected")) {
         tagsFilter.removeClass("filterSelected");
      }
      $("#showFilterResultBtn").hide();
      $('#product-wrt-cat').empty();
      $("#brand-filter-area").empty();
      $("#saleunit-filter").empty();
      $("#tag-filter-area").empty();
      groceryAssistantData = setupGroceryAssistant();
      
      $("#clearFilter").hide();
      
      var lastCategory;
       for(each in groceryAssistantData) {
         if(each == currentCategoryName) {
            foundCurrentCat = true;
            break;
         }
         lastCategory = each;
       }
       
       lastCategory = currentCategoryNameAfterClear;
       if(lastCategory) {
       
         $("#brand-filter-area").empty();
         $("#saleunit-filter").empty();
         $("#tag-filter-area").empty();
         var brandArea = $("#brand-filter-area");
         var weightArea = $("#saleunit-filter");
         var tagArea = $("#tag-filter-area");
         var counter = 0;
         var brandAreaArray = [];
         var weightAreaArray = [];
         var tagAreaArray = [];
         for(each in assistantJsonArray["Assistant"][lastCategory]) {
            var tagsArray = [];
            if(assistantJsonArray["Assistant"][lastCategory][each]["BrandName"] && (brandAreaArray.indexOf(assistantJsonArray["Assistant"][lastCategory][each]["BrandName"]) == -1)) {
              brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJsonArray["Assistant"][lastCategory][each]["BrandName"]}">${assistantJsonArray["Assistant"][lastCategory][each]["BrandName"]}</button>`);
                brandAreaArray.push(assistantJsonArray["Assistant"][lastCategory][each]["BrandName"]);
            }       
            if(assistantJsonArray["Assistant"][lastCategory][each]["SaleUnitQuantity"] && (weightAreaArray.indexOf(assistantJsonArray["Assistant"][lastCategory][each]["SaleUnitQuantity"]) == -1)) {
              weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJsonArray["Assistant"][lastCategory][each]["SaleUnitQuantity"]}" class="btn btn-link mb-2">${assistantJsonArray["Assistant"][lastCategory][each]["SaleUnitQuantity"]}</button>`);  
              weightAreaArray.push(assistantJsonArray["Assistant"][lastCategory][each]["SaleUnitQuantity"]);
            }
            var tagString = assistantJsonArray["Assistant"][lastCategory][each].tags;
            tagsArray = tagString.split(",");
            for(tag in tagsArray) {
              if(tagsArray[tag] && (tagAreaArray.indexOf(tagsArray[tag]) == -1)) {
                tagArea.append(`<div class="form-check">
                           <input class="form-check-input" data-value="${tagsArray[tag]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${tagsArray[tag]}">
                           <label class="form-check-label" for="tag${counter}">${tagsArray[tag]}</label>
                         </div>`);
                tagAreaArray.push(tagsArray[tag]);
              }
            }
       }
    }
      $('#prevCategoryBtn').attr('disabled', false);
      $('#nextCategoryBtn').attr('disabled', false);
      $('#product-wrt-cat').empty();
      $("#va-panel-heading-category").text(assistantJsonArray["Assistant"][lastCategory][0]["parentCategory"]);
      $("#va-panel-heading-sub-category").text(assistantJsonArray["Assistant"][lastCategory][0]["CatName"]);
      
      if(groceryAssistantData[currentCategoryNameAfterClear]) {
         $('#product-wrt-cat').append(groceryAssistantData[currentCategoryNameAfterClear][0]);
         $('#pagination-btn').empty();
         for(var i = 0; i < numberOfPageList[currentCategoryNameAfterClear]; i++) {
            $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${currentCategoryNameAfterClear}')">${i+1}</button>`);
         }
         currentCategoryName = currentCategoryNameAfterClear;
      }
   }

   function anyFilterSelected(){
      return $(".filterSelected").length > 0;
   }

   function setupGroceryAssistant() {
      $('#product-wrt-cat').empty();
      var container = $('#product-wrt-cat');
      var assistantJson = JSON.parse(`<?=$Assistant?>`);
      
      $("#brand-filter-area").empty();
      $("#saleunit-filter").empty();
      $("#tag-filter-area").empty();

      var brandArea = $("#brand-filter-area");
      var weightArea = $("#saleunit-filter");
      var tagArea = $("#tag-filter-area");
      
      var brandAreaArray = [];
      var weightAreaArray = [];
      var tagAreaArray = [];
      
      // for(var each in assistantJson["Brands"]){
      //    if(assistantJson["Brands"][each])
      //       brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJson["Brands"][each]}">${assistantJson["Brands"][each]}</button>`);
      // }
      // for(var each in assistantJson["SaleUnitQty"]){
      //    if(assistantJson["SaleUnitQty"][each])
      //       weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJson["SaleUnitQty"][each]}" class="btn btn-link mb-2">${assistantJson["SaleUnitQty"][each]}</button>`);
      // }
      // var counter = 0;
      // for(var each in assistantJson["Tags"]){
      //    if(assistantJson["Tags"][each])
      //       tagArea.append(`<div class="form-check">
      //                     <input class="form-check-input" data-value="${assistantJson["Tags"][each]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${assistantJson["Tags"][each]}">
      //                     <label class="form-check-label" for="tag${counter}">
      //                       ${assistantJson["Tags"][each]}
      //                     </label>
      //                   </div>`);
      // }


      var eachPage = 8;

      var cartTemplate = $('#clone-cart').text();
      var baseUrl = '<?=base_url()?>';
      var finalData = [];
      var catIndex = 0;
      $('#pagination-category-btn').empty();

      var firstElement;
      for(each in assistantJson["Assistant"])
      {
         firstElement = each;
         break;
      }
      var counter = 0;
      for(each in assistantJson["Assistant"][firstElement]) {
         if(assistantJson["Assistant"][firstElement][each]["BrandName"] && (brandAreaArray.indexOf(assistantJson["Assistant"][firstElement][each]["BrandName"]) == -1)) {
            brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJson["Assistant"][firstElement][each]["BrandName"]}">${assistantJson["Assistant"][firstElement][each]["BrandName"]}</button>`);
            brandAreaArray.push(assistantJson["Assistant"][firstElement][each]["BrandName"]);
         }       
         if(assistantJson["Assistant"][firstElement][each]["SaleUnitQuantity"] && (weightAreaArray.indexOf(assistantJson["Assistant"][firstElement][each]["SaleUnitQuantity"]) == -1)) {
            weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJson["Assistant"][firstElement][each]["SaleUnitQuantity"]}" class="btn btn-link mb-2">${assistantJson["Assistant"][firstElement][each]["SaleUnitQuantity"]}</button>`);  
            weightAreaArray.push(assistantJson["Assistant"][firstElement][each]["SaleUnitQuantity"]);
         }
        //  if(assistantJson["Assistant"][firstElement][each]["Tags"] && (tagAreaArray.indexOf(assistantJson["Assistant"][firstElement][each]["Tags"]) == -1)) {
        //     tagArea.append(`<div class="form-check">
        //                   <input class="form-check-input" data-value="${assistantJson["Assistant"][firstElement][each]["Tags"]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${assistantJson["Assistant"][firstElement][each]["Tags"]}">
        //                   <label class="form-check-label" for="tag${counter}">
        //                     ${assistantJson["Assistant"][firstElement][each]["Tags"]}
        //                   </label>
        //                 </div>`);
        //     tagAreaArray.push(assistantJson["Assistant"][firstElement][each]["Tags"]);
        //  }
        
        var tagString = assistantJson["Assistant"][firstElement][each].tags;
         tagsArray = tagString.split(",");

         for(tag in tagsArray) {
            if(tagsArray[tag] && (tagAreaArray.indexOf(tagsArray[tag]) == -1)) {
               tagArea.append(`<div class="form-check">
                             <input class="form-check-input" data-value="${tagsArray[tag]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${tagsArray[tag]}">
                             <label class="form-check-label" for="tag${counter}">${tagsArray[tag]}</label>
                           </div>`);
               tagAreaArray.push(tagsArray[tag]);
            }
         }

      }
      
      currentCategoryName = firstElement;

      for(each in assistantJson["Assistant"])
      {
         if(!currentCategoryName) 
            currentCategoryName = each;
         var pages = [];
         var totalProducts = assistantJson["Assistant"][each].length; // total products
         var numberOfPages = Math.ceil(totalProducts/eachPage); // number of pages
         numberOfPageList[each] = numberOfPages;
         
         
         for (var i = 0; i < numberOfPageList[each]; i++) {
            var catProductList = [];
            for(var k = i * eachPage; k < eachPage + (eachPage * i); k++) {
               if(!assistantJson["Assistant"][each][k]) break;
               var cartTemplateCopy = cartTemplate;
               cartTemplateCopy = cartTemplateCopy.replace(/{Img}/g, baseUrl + assistantJson["Assistant"][each][k].ProductImg);
               cartTemplateCopy = cartTemplateCopy.replace(/{ProductName}/g, assistantJson["Assistant"][each][k].ProductName);
               cartTemplateCopy = cartTemplateCopy.replace(/{UnitName}/g, !assistantJson["Assistant"][each][k].SaleUnitName ? assistantJson["Assistant"][each][k].UnitName : 
                  (assistantJson["Assistant"][each][k].SaleUnitQty + " " + assistantJson["Assistant"][each][k].SaleUnitName)
                  );
               cartTemplateCopy = cartTemplateCopy.replace(/{SalePrice}/g, formatCurrency(assistantJson["Assistant"][each][k].SalePrice,0));
               cartTemplateCopy = cartTemplateCopy.replace(/{Jsn}/g, assistantJson["Assistant"][each][k].Jsn);
               catProductList.push(cartTemplateCopy);
            }
            
            pages.push(catProductList);
         }
         finalData[each] = pages;
         $('#pagination-category-btn').append(`<button type="button" class="btn btn-link nav-btn-secondary mx-1" title="${each}" onclick="renderCategoryPages('${each}')">${catIndex+1}</button>`);
         catIndex++;
      }
      if(finalData[firstElement]) { 
         $("#va-panel-heading-category").text(assistantJson["Assistant"][firstElement][0]["parentCategory"]);
         $("#va-panel-heading-sub-category").text(assistantJson["Assistant"][firstElement][0]["CatName"]);
         container.append(finalData[firstElement][0]);
         $('#pagination-btn').empty();
         for(var i = 0; i < numberOfPageList[firstElement]; i++) {
            $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${firstElement}')">${i+1}</button>`);
         }
      }
      $('#showFilterResultBtn').hide();
      return finalData;
   }

   function renderCategoryPages(category) {
      $('#product-wrt-cat').empty();
      $('#product-wrt-cat').append(groceryAssistantData[category][0]);

      $("#brand-filter-area").empty();
      $("#saleunit-filter").empty();
      $("#tag-filter-area").empty();

      var brandArea = $("#brand-filter-area");
      var weightArea = $("#saleunit-filter");
      var tagArea = $("#tag-filter-area");

      var counter = 0;
      var brandAreaArray = [];
      var weightAreaArray = [];
      var tagAreaArray = [];
      for(each in assistantJsonArray["Assistant"][category]) {
         var tagsArray = [];

         if(assistantJsonArray["Assistant"][category][each]["BrandName"] && (brandAreaArray.indexOf(assistantJsonArray["Assistant"][category][each]["BrandName"]) == -1)) {
            brandArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" class="btn btn-link mb-2" data-value="${assistantJsonArray["Assistant"][category][each]["BrandName"]}">${assistantJsonArray["Assistant"][category][each]["BrandName"]}</button>`);
            brandAreaArray.push(assistantJsonArray["Assistant"][category][each]["BrandName"]);
         }       

         if(assistantJsonArray["Assistant"][category][each]["SaleUnitQuantity"] && (weightAreaArray.indexOf(assistantJsonArray["Assistant"][category][each]["SaleUnitQuantity"]) == -1)) {
            weightArea.append(`<button onclick="toggleAndCheckActiveFilter(this);" data-value="${assistantJsonArray["Assistant"][category][each]["SaleUnitQuantity"]}" class="btn btn-link mb-2">${assistantJsonArray["Assistant"][category][each]["SaleUnitQuantity"]}</button>`);  
            weightAreaArray.push(assistantJsonArray["Assistant"][category][each]["SaleUnitQuantity"]);
         }

         var tagString = assistantJsonArray["Assistant"][category][each].tags;
         tagsArray = tagString.split(",");

         for(tag in tagsArray) {
            if(tagsArray[tag] && (tagAreaArray.indexOf(tagsArray[tag]) == -1)) {
               tagArea.append(`<div class="form-check">
                             <input class="form-check-input" data-value="${tagsArray[tag]}" onclick="toggleAndCheckActiveFilter(this);" type="checkbox" name="tag${++counter}" id="tag${counter}" value="${tagsArray[tag]}">
                             <label class="form-check-label" for="tag${counter}">${tagsArray[tag]}</label>
                           </div>`);
               tagAreaArray.push(tagsArray[tag]);
            }
         }

         $('#pagination-btn').empty();
         for(var i = 0; i < numberOfPageList[category]; i++) {
           $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${category}')">${i+1}</button>`);
         }

      }
      
      $("#va-panel-heading-category").text(assistantJsonArray["Assistant"][category][0]["parentCategory"]);
      $("#va-panel-heading-sub-category").text(assistantJsonArray["Assistant"][category][0]["CatName"]);
      $('#pagination-btn').empty();
      for(var i = 0; i < numberOfPageList[category]; i++) {
         $('#pagination-btn').append(`<button class="btn btn-link nav-btn-primary" onclick="renderCatPaginate(${i},'${category}')">${i+1}</button>`);
      }
      isCatButtonSearch = true;
      
   }

   function renderCatPaginate(pageNumber, category) {
      $('#product-wrt-cat').empty();
      $('#product-wrt-cat').append(groceryAssistantData[category][pageNumber]);

   }

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
   }
   .cat-card, .cat-card img{
      border-radius: 10px 10px 0px 0px;
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