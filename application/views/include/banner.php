<div class="container-fluid" style="padding:0px;">
   <div id="main-banner" class="carousel slide justify-item-center text-center" data-ride="carousel">
      <ol class="carousel-indicators">
         <?php 
            foreach($BannerImages as $key => $value) { ?>
               <li data-target="#main-banner" data-slide-to="<?=$key?>" class="<?php if($key == 0) { echo "active"; }?>"></li>
         <?php } ?>
      </ol>
      <div class="carousel-inner">
         <?php 
            foreach($BannerImages as $key => $value) { ?>
               <div class="carousel-item <?php if($key == 0) { echo "active"; }?>">
                  <a href="<?=base_url($value['image_url'])?>">
                     <img class="d-block w-100" src="<?=base_url($value['image_path'])?>" alt="Banner">
                  </a>
               </div>
         <?php } ?>
         
      </div>
   </div>
</div>