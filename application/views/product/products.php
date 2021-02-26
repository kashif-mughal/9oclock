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

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 px-0">
                <div class="categories sidebar-inner-page accordion" id="accordionCatInnerPage">
                    <div class="d-flex align-items-center justify-content-between innerPageMenu">
                        <h4>Shop By Department</h4>
                        <a href="javascript:void(0)" type="button" data-toggle="collapse" data-target="#InnerPageMenuContent" aria-expanded="true" aria-controls="accordionCatInnerPage">
                            <i class="fas fa-chevron-circle-down"></i>
                        </a>
                    </div>
                    <div class="collapse show" id="InnerPageMenuContent" aria-labelledby="accordionCatInnerPage" data-parent="#accordionCatInnerPage">
                        <?php foreach($CatList as $key => $value) {?>
                            <div class="sidebar-inner-category-content">
                                <div class="sub-category">
                                    <div class="sub-category-content">

                                        <h6><?=$key?></h6>

                                        <?php for ($i=0; $i < count($value->childCats); $i++) {?>
                                            <a href="<?php echo base_url(); ?>Cproduct/products?categoryId=<?=$value->childCats[$i]['CategoryId']?>">
                                                <span class="hyphen">&#8212;</span> <span class="category-text"><?=$value->childCats[$i]['Alias']?></span>
                                            </a>
                                        <?php } ?>
                                        
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                        <script>
                            WindowsResizeFunc();
                        </script>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-9 col-lg-9 col-md-12 my-3 pr-0">
                <div class="container bg-transparent">
                    <div class="row" id="products-area">
                        <div style="display: none;">
                            <script type="text" id="clone-cart">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="featured-products-content mb-2 d-flex justify-content-between">
                                    <div class="card each-prod product-card-inner">
                                        <div class="card-body p-0">
                                                <div class="header">
                                                    {discountString}
                                                    <!--<a href="#" class="add_to_favorite">
                                                        <i class="fas fa-heart float-right"></i>
                                                    </a>-->
                                                </div>
                                            </div>
                                            <a href="{productId}">
                                            <img class="img-fluid text-center" src="{imgUrl}" alt="Card image cap">
                                            </a>
                                            <div class="product-info text-center">
                                                <p class="card-text product-card-inner-name" title="{productName}">{productName}</p>
                                                <p class="card-text product-card-inner-weight">{unitName}</p>
                                                <p class="card-text product-card-inner-price d-inline">{salePrice}</p>
                                                {priceString}
                                                <div class="quantity-area d-flex justify-content-center align-items-center mt-2 ml-3">
                                                    <span class="d-inline-flex quantity-text mr-1">Qty</span>
                                                    <input type="text" class="d-inline-flex quantity-input quantity">
                                                    <span class="d-block quantity-button">
                                                        <a href="javascript:void(0);" class="qty-pls d-block">+</a>
                                                        <div class="separator"></div>
                                                        <a href="javascript:void(0);" class="qty-mns d-block">-</a>
                                                    </span>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="product-card-btn mx-auto add-cart"
                                            data-json="{pjsonString}"
                                            >Add to Cart</a>
                                            <a href="javascript:void(0);" style="display: none;" class="product-card-btn mx-auto remove-cart"
                                            data-json="{pjsonString}"
                                            >Remove From Cart</a>
                                    </div>

                                </div>
                            </div>
                            </script>
                        </div>
                        <style>
                        .main-content {
                            margin-top: 0 !important;
                        }
                            .main-content .featured-products-content .card .card-body h5{
                                width: 80%;
                                background: #ff2524d1;
                                color: #fff;
                                z-index: 1;
                                text-align: center;
                                font-size: 14px;
                                position: absolute;
                                top: 60px;
                                text-transform: uppercase;
                                margin: 0px 20px;
                                padding: 10px 0px;
                                border-radius: 0px 20px;
                                font-weight: 700;
                            }
                        </style>
                        
                        <?php foreach($ProdList as $value) { 
                            
                            $discountPercentage = (($value['Price'] - $value['SalePrice'])/$value['Price']) * 100;
                            ?>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 px-0">
                                <?php 
                                    if($_SESSION["user_id"] == 1){
                                        echo '<span>'. $value["sort"] .'</span>';
                                    }
                                ?>
                                    
                                <div class="featured-products-content mb-2 d-flex align-items-center justify-content-start">
                                        <div class="card mr-2 each-prod product-card-inner" style="padding-top:5px;">
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
                                                <a href="<?php echo base_url() . 'Cproduct/viewProduct/' . $value['ProductId']; ?>"> 
                                                <img style="max-height: 145px;" class="img-fluid text-center" src="<?php echo base_url().$value['ProductImg']; ?>" alt="Card image cap">
                                                </a>
                                                <div class="product-info text-center">
                                                    <p class="card-text product-card-inner-name" title="<?php echo $value['ProductName']; ?>"><?php echo $value['ProductName']; ?></p>
                                                    <p class="card-text product-card-inner-weight">
                                                        <?= empty($value['SaleUnitName']) ? $value['UnitName'] : $value['SaleUnitQty']. ' ' .$value['SaleUnitName'] ; ?></p>
                                                    <p class="card-text product-card-inner-price d-inline"><script type="text/javascript">document.write(formatCurrency("<?php echo $value['SalePrice']; ?>",0)); </script></p>
                                                    <?php if($discountPercentage != 0) { ?> 
                                                        <span class="product-discount"><del><script type="text/javascript">document.write(formatCurrency("<?php echo $value['Price']; ?>",0)); </script></del></span>
                                                    <?php } 
                                                    $productObject = (object) [
                                                    'id' => $value['ProductId'],
                                                    'pName' => $value['ProductName'],
                                                    'price' => $value['SalePrice'],
                                                    'img' => base_url().$value['ProductImg']
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
                                    <!-- </a> -->
                                </div>


                            </div>
                        <?php } ?>
                    </div>
                    <?php if($TotalProducts && $TotalProducts >= $PerPage){?>
                        <div class="product-info text-center">
                            <button class="product-card-btn mx-auto loadmore" id="load-more">
                                <div id="spinner"></div>
                                <span class="btntext">Load More</span>
                            </button>
                        </div>
                    <?php }?>
                </div>


            </div>

        </div>

        <!-- HOUSEHOLD ESSENTIALS -->

    </div>
</section>
<script type="text/javascript">
    var page = 0;
    $(document).ready(function(){
        $('#load-more').on('click', function(){
            var currentElem = $(this);
            var urlVars = getUrlVars();
            $(currentElem.find('#spinner')[0]).addClass('spinner-border text-info');
            currentElem.attr('disabled', true);
            var perpage = urlVars['perpage'] ? urlVars['perpage'] : -1;
            $.ajax({
                url : '<?=base_url("Cproduct/fetch");?>',
                type : 'GET',
                data : {
                    'q' : urlVars['q'],
                    'categoryId' : urlVars['categoryId'],
                    'page': ++page,
                    'perpage' : perpage
                },
                dataType:'json',
                success : function(data) {
                    var baseUrl = '<?=base_url()?>';
                    if(!data){
                        currentElem.hide();
                    }else{
                        var totalProducts = data.total;
                        data = data.products;
                        var cartTemplate = $('#clone-cart').text();
                        var productArea = $('#products-area');
                        for (var i = 0; i < data.length; i++) {
                            var discountPercentage = parseInt(((data[i].Price - data[i].SalePrice)/data[i].Price) * 100);
                            var disText = null;
                            if(discountPercentage != 0){
                                var disString = `<h5 class="card-title float-left">${discountPercentage}% OFF</h5>`;
                                var priceString = `<span class="product-discount"><del>${formatCurrency(data[i].Price,0)}</del></span>`;
                            }
                            var cartTemplateCopy = cartTemplate;
                            if(disString)
                                cartTemplateCopy = cartTemplateCopy.replace(/{discountString}/g, disString);
                            else
                                cartTemplateCopy = cartTemplateCopy.replace(/{discountString}/g, "");
                            if(priceString)
                                cartTemplateCopy = cartTemplateCopy.replace(/{priceString}/g, priceString);
                            else
                                cartTemplateCopy = cartTemplateCopy.replace(/{priceString}/g, "");
                            cartTemplateCopy = cartTemplateCopy.replace(/{imgUrl}/g, baseUrl + data[i].ProductImg);
                            cartTemplateCopy = cartTemplateCopy.replace(/{productName}/g, data[i].ProductName);
                            cartTemplateCopy = cartTemplateCopy.replace(/{unitName}/g, !data[i].SaleUnitName ? data[i].UnitName : data[i].SaleUnitQty + " " + data[i].SaleUnitName );
                            cartTemplateCopy = cartTemplateCopy.replace(/{salePrice}/g, formatCurrency(data[i].SalePrice,0));
                            cartTemplateCopy = cartTemplateCopy.replace(/{productId}/g, base_url + 'Cproduct/viewProduct/' + data[i].ProductId)
                            pjsonString = {id: data[i].ProductId, pName: data[i].ProductName, price: data[i].SalePrice, img: data[i].ProductImg};
                            cartTemplateCopy = cartTemplateCopy.replace(/{pjsonString}/g, data[i].Jsn);
                            cartTemplateCopy = cartTemplateCopy.replace(/{detailPageLink}/g, base_url + 'Cproduct/viewProduct/' +  data[i].ProductId)
                            productArea.append(cartTemplateCopy);
                        }
                        if(data.length < perpage)
                            currentElem.hide();
                        loadCartData();
                    }
                },
                error : function(request,error)
                {
                    console.log("Request: " + JSON.stringify(request));
                },
                complete: function(data){
                    $(currentElem.find('#spinner')[0]).removeClass('spinner-border text-info');
                    currentElem.attr('disabled', false);
                }
            });
        });
    });
</script>