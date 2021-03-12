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
<div id="main-page">
	<div class="container">

		<section >
			<div class="row my-4">
				<div class="col-md-4 col-lg-4 col-sm-12 footer-padding">

					<div class="call_to_action_grid border-right-full">
						<div class="call_to_action_image">
							<img src="<?php echo base_url() ?>assets/img/footer/call_to_action/SameNextDayDelivery_icon.png?>" alt="Icon">
						</div>
						<div class="call_to_action_content text-center text-md-left mb-4 mb-md-0">
							<h5 class="call_to_action_title">Same/Next Day Delivery</h5>
							<h6 class="call_to_action_content">Free delivery on all orders over Rs. 4,000 Rs 100 for orders below Rs. 4,000
							</h6>
						</div>
					</div>
					
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 footer-padding">
					
					<div class="call_to_action_grid border-right-full">
						<div class="call_to_action_image">
							<h4 class="call_to_action_custom_img m-0">Rs.</h4>
						</div>
						<div class="call_to_action_content text-center text-md-left mb-4 mb-md-0">
							<h5 class="call_to_action_title">Cash On Delivery</h5>
							<h6 class="call_to_action_content">You pay when rider comes at your address.</h6>
						</div>
					</div>
					
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12 footer-padding">
					
					<div class="call_to_action_grid">
						<div class="call_to_action_image">
							<img src="<?php echo base_url() ?>assets/img/footer/call_to_action/OnlineSupport_icon.png?>" alt="Icon">
						</div>
						<div class="call_to_action_content text-center text-md-left mb-4 mb-md-0">
							<h5 class="call_to_action_title">Online Support</h5>
							<h6 class="call_to_action_content">Customer support from 9AM - 9PM +92 318 2294472
							</h6>
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>
</div>
<section class="main-footer">
	<div class="container">
		<div class="main-footer-content">
			<p class="footer-text text-center text-md-left">
				9o'Clock is not just another online grocery store. We at 9o'Clock aim at revolutionizing the whole thinking of online shopping by introducing latest technology into the arena and at the same retaining cultural traditions that are still revered by shoppers in Pakistan but are so easily abandoned by online shopping platforms focusing only on the technological aspect. We consistently work hard to:
			</p>

			<div class="best_features">
				<div class="grid-container">
					<div class="feature-img">
						<h4 class="feature-img-text m-0">Rs.</h4>  
					</div>
					<h4 class="feature-text my-2 py-1">Offer best quality at reasonable price</h4>                  
				</div>
			</div>
			<div class="best_features">
				<div class="grid-container">
					<div class="feature-img">   
						<img src="<?php echo base_url() ?>assets/img/footer/round-rectangle.png?>" alt="">
					</div>
					<h4 class="feature-text my-2 py-1">Present a wide range of grocery products to meet diversified needs of all our customers</h4>                  
				</div>
			</div>
			<div class="best_features">
				<div class="grid-container">
					<div class="feature-img">
						<img src="<?php echo base_url() ?>assets/img/footer/arrow-left.png?>" alt="">
					</div>
					<h4 class="feature-text my-2 py-1">Maintain very high level of satisfaction for all our customers - we offer cashback and return options without any questions asked</h4>                  
				</div>
			</div>
			<div class="best_features">
				<div class="grid-container">
					<div class="feature-img">   
						<img src="<?php echo base_url() ?>assets/img/footer/rocket.png?>" alt="">
					</div>
					<h4 class="feature-text my-2 py-1">Continuously innovate and improve out offerings to enhance the experience of our customers</h4>                  
				</div>
			</div>
<!-- 
			<div class="mission_vision my-4">
				<h4>Mission & Vision</h4>
				<div class="mission_vision_content">
					<h6>Mission:</h6>
					<p>To become the most customer-centric, technologically sound and practical online shopping platform which is highly respected for ethics and professionalism by customers and competition alike</p>
				</div>
				<div class="mission_vision_content">
					<h6>Vision:</h6>
					<p>Build strong understanding of customer needs fby carefully analyzing their shopping patterns and paying close attension to their stated expectations through intelligently carried out research and surverys. Use most suitable technology to create out of box solutions with the aim to acheiving optimum level of satisfaction for our customers and at the same time fullfilling our economic objectives. Attract best talent by offering competative remunerations and a healthy work environment that enables every team member to perform at his or her optimum level and at the same time achieve a perfect work-life balance.
					</p>
				</div>
			</div> -->

	        <div class="feature-details my-4">
				<h4>9o'Clock - the most customer-centeric online shopping platform</h4>
				<div class="feature_details_content">
					<h6>Wide Geographic Coverage</h6>
					<p>Order from anywhere in Karachi to get best deals in grocery items delivered at your doorsteps in a timely and professional manner</p>
				</div>
				<div class="feature_details_content">
					<h6>Innovative Approach</h6>
					<p>We at 9o'Clock take special pride in being innovative and ahead of our competition to create convenience for our shoppers.</p>
				</div>
				<div class="feature_details_content">
					<h6>Long term Commitment</h6>
					<p>We genuinely believe in long lasting relationships based on trust and mutual respect.</p>
				</div>
				<div class="feature_details_content">
					<h6>Best Value for your Money</h6>
					<p>We understand that our customers have the right to get best value for their money when they shop at 9o'Clock and hence we make every effort to offer wide range of quality products at lowest possible prices.</p>
				</div>
				<div class="feature_details_content">
					<h6>Special features for members</h6>
					<p>By becoming 9o'Clock member our customers can view their history, compare their present grocery cart with previous ones and place standing instructions for seamless shopping experience</p>
				</div>
				<div class="feature_details_content">
					<h6>Payment Options</h6>
					<p>At present we are offering “cash-on-delivery” (COD) option only. However, we are working hard to add digital payment options.</p>
				</div>
			</div>

			<div class="categories my-4">
				<h4>Categories</h4>
				<div class="category-grid">

					<?php foreach($CatList as $key => $value) {?>
						<div class="sub-category">
							<div class="sub-category-content">

								<h6><?=$key?></h6>
								
								<?php for ($i=0; $i < count($value->childCats); $i++) {?>
									<a href="<?=base_url('Cproduct/products?categoryId=').$value->childCats[$i]['CategoryId']?>">
										<span class="hyphen">-</span> <span class="category-text"><?=$value->childCats[$i]['Alias']?></span>
									</a>
								<?php } ?>

							</div>
						</div>
					<?php } ?>

				</div>
			</div>

			<div class="useful-links my-4">
				<h4>Useful Links</h4>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2 pl-0">
							<a href="<?=base_url("cpage/vision");?>">Mission & Vision</a>
						</div>
						<div class="col-md-2 pl-0">
							<a href="<?=base_url("cpage/privacy");?>">Privacy Policy</a>
						</div>
						<div class="col-md-2 pl-0">
							<a href="<?=base_url("cpage");?>">Terms & Conditions</a>
						</div>
						
						<div class="w-100"></div>

						<div class="col-md-2 pl-0">
							<a href="<?=base_url("cpage/faq");?>">FAQs</a>
						</div>
						<div class="col-md-2 pl-0">
							<a href="<?=base_url("cpage/returnandrefund");?>">Return & Refund</a>
						</div>
					</div>
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
						<?php if (isset($Web_settings[0]['footer_text'])) { echo $Web_settings[0]['footer_text']; }?>
					</div>
				</div>
			</div>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
			<div class="company-address">
				<div class="container">
					<div class="row" style="font-size: 10px;">
						<div class="col-6" style="letter-spacing: 10px;">
							<a href="https://www.facebook.com/saudaexpresspk"><i class="fab fa-facebook fa-2x" style="color:#666666;"></i></a>
							<a href="https://twitter.com/saudaexpresspk"><i class="fab fa-twitter fa-2x" style="color:#666666;"></i></a>
							<a href="#"><i class="fab fa-whatsapp fa-2x" style="color:#666666;"></i></a>
						</div>
						<div class="col-6 text-right">
							<p>Powered By: <span><a href="http://www.malejol.com" style="text-decoration:none; color:#3d3d3b"">Malejol</a></span></p>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>