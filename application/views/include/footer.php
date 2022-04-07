<?php
$CI = & get_instance();
$CI->load->model('Brands');
$CI->load->library('lcategory');
$TopBrandList = $CI->Brands->top_brands();

$CatList = $CI->lcategory->get_category_hierarchy();
foreach($CatList as $key => $value) {
    $products = $CI->Categories->getCatPrducts($value->catId, null, 0, 8);
    if($products)
        $products = $products['products'];
    $value->products = $products;
}
?>
</div>
<section class="main-footer" style="margin-top: 10px;">
	<div class="container">
		<div class="main-footer-content" style="padding-top: 10px;">
			
	        <div class="categories my-4">
				<h4>Categories</h4>
				<div class="category-grid">

					<?php $counter = 0; foreach($CatList as $key => $value) {
						if(++$counter == 1)
            				continue;
						?>

						<div class="sub-category">
							<div class="sub-category-content">

								<h6><?=$key?></h6>
								
								<?php for ($i=0; $i < count($value->childCats); $i++) {?>
									<a href="<?=base_url('Cproduct/products?categoryId=').$value->childCats[$i]['CategoryId']?>">
										<span class="hyphen">-</span> <span class="category-text"><?=$value->childCats[$i]['CatName']?></span>
									</a>
								<?php } ?>

							</div>
						</div>
					<?php } ?>

				</div>
			</div>
			<div class="feature-details my-4">
				<h4>9 o'Clock Shop – Best quality Halal products</h4>
				<div class="feature_details_content">
					<h6>Local Halal shop</h6>
					<p>Order anywhere in Swindon to get the best deals on Halal grocery items delivered at your doorsteps in a timely and professional manner</p>
				</div>
				<div class="feature_details_content">
					<h6>Innovative Approach</h6>
					<p>We at 9 o'Clock Shop take special pride in being innovative and ahead of our competition to create convenience for our customers.</p>
				</div>
				<div class="feature_details_content">
					<h6>Long term Commitment</h6>
					<p>We genuinely believe in long-lasting relationships based on trust and mutual respect.</p>
				</div>
				<div class="feature_details_content">
					<h6>Best Value for your Money</h6>
					<p>We understand that our customers have the right to get the best value for their money when they shop at 9 o'Clock. Hence, we make every effort to offer a wide range of quality products at the lowest possible prices.</p>
				</div>
				<div class="feature_details_content">
					<h6>Special features for members</h6>
					<p>By becoming 9 o'Clock members our customers can view their history, compare their present grocery cart with previous ones and place standing instructions for a seamless shopping experience</p>
				</div>
				<div class="feature_details_content">
					<h6>Payment Options</h6>
					<p>We offer a secure payment platform to allow Credit and Debit card payments.</p>
				</div>
			</div>
			
			<div class="top-brands my-4">
				<h4>Top Brands</h4>
				<?php foreach($TopBrandList as $key => $value)  { ?>
				<a href="<?=base_url("cproduct/products?brand=".$value['BrandId'])?>" id="<?=$value['BrandId']?>"><?=$value['BrandName']?> (<?=$value['Total_Products']?>)</a>
				<?php } ?>
			</div>

			<div class="company-address">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<?php if (isset($Web_settings[0]['footer_text'])) { echo $Web_settings[0]['footer_text']; }?>
						</div>
						<div class="col-md-4" style="text-align: end; padding: 0px;">
							<img src="<?php echo base_url('assets/img/payment_images.png'); ?>" alt="">
						</div>
					</div>
				</div>
			</div>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
			<div class="company-address">
				<div class="container">
					<div class="row" style="font-size: 10px;">
						<div class="col-6" style="letter-spacing: 10px; display: none;">
							<!-- <a href="https://www.facebook.com/9oclockpk"><i class="fab fa-facebook fa-2x" style="color:#666666;"></i></a>
							<a href="https://twitter.com/9oclockpk"><i class="fab fa-twitter fa-2x" style="color:#666666;"></i></a>
							<a href="#"><i class="fab fa-whatsapp fa-2x" style="color:#666666;"></i></a> -->
						</div>
						<div class="col-6 text-right">
							<p>Powered By: <span><a href="https://malejol.site" style="text-decoration:none; color:#3d3d3b">Malejol</a></span></p>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>