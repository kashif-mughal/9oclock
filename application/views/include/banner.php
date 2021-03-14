<style>
#bannerWrapper {
   margin-top: 113px;
}

@media (max-width: 991px) {
   #bannerWrapper {
      margin-top: 166px;
   }
}

@media (max-width: 576px) {
   #bannerWrapper {
      margin-top: 154px;
   }
}

@media (max-width: 320px) {
   #bannerWrapper {
      margin-top: 172px;
   }
}
</style>

<div class="container-fluid" style="padding:0px;" id="bannerWrapper">
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
                  <a href="<?=$value['image_url']?>">
                     <img class="d-block " src="<?=base_url($value['image_path'])?>" alt="Banner"
                     style="width: 100%;">
                  </a>
               </div>
         <?php } ?>
         
      </div>
   </div>
</div>