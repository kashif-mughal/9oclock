<style>
   @media (max-width: 425px) {
      /* Order Tracking */	
      .ordertrackingprogress ul li .check-container {	
         width: 50px;	
         height: 50px;	
      }	
      .ordertrackingprogress ul li i {	
         padding: 12px;	
         font-size: 14px;	
      }	
      .ordertrackingprogress ul li::after {	
         top: 19px;	
      }	
      .ordertrackingprogress ul img.truck {	
         top: -3px;	
         left: 82%;	
         width: 33px;	
      }	
      .ordertrackingprogress ul li p {	
         font-size: 12px;	
      }      
   }
   	
   @media (max-width: 375px) {
      /* Order Tracking */	
      .ordertrackingprogress ul li .check-container {	
         width: 44px;	
         height: 44px;	
      }	
      .ordertrackingprogress ul li i {	
         padding: 10px;	
         font-size: 12px;	
      }	
      .ordertrackingprogress ul li::after {	
         top: 19px;	
      }	
      .ordertrackingprogress ul img.truck {	
         top: -1px;	
         left: 82%;	
         width: 30px;	
      }	
      .ordertrackingprogress ul li p {	
         font-size: 10px;	
      }      
   }

   @media (max-width: 360px) {
      /* Order Tracking */	
      .ordertrackingprogress ul li .check-container {	
         width: 40px;	
         height: 40px;	
      }	
      .ordertrackingprogress ul li i {	
         padding: 9px;	
         font-size: 10px;	
      }	
      .ordertrackingprogress ul li::after {	
         top: 17px;	
      }	
      .ordertrackingprogress ul img.truck {	
         width: 26px;	
      }	
      .ordertrackingprogress ul li p {	
         font-size: 9px;	
      }
   }
</style>

<!-- Bread Crumb -->
<div class="bread_crumb">
   <div class="container">
      <div class="row d-block">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
               <li class="breadcrumb-item"><a href="javascript:void(0);">Track Order</a></li>
            </ol>
         </nav>
         <!-- <h3 class="mb-0"><?php //echo $SelectOrder['SubOrder']; ?></h3> -->
         <h3 class="mb-0">Order Tracking</h3>
      </div>
   </div>
</div>
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

      <div class="row" id="order_form">
         <!-- <div class="col-xl-3 col-lg-3 col-md-12 pr-0 hidden-sm-down">
            <div class="sidenav" style="position: relative;width: 100%;z-index: 0;height: auto;">
               <div>
                  <?php 
                     //if(empty($CatList))
                         //$CatList = Array();
                     //$data['CatList'] = $CatList;
                     //$this->load->view('include/user_left_menu', $data);
                     ?>
               </div>
            </div>
         </div> -->
         
         <div class="col-xl-12 col-lg-12 col-md-12 my-3 px-0">
            <div class="container bg-transparent px-0">

               <div class="card p-sm-5 content-box" style="z-index: 0; border: 3px 3px 0 0;">
                  <div class="d-flex flex-column pb-5 mb-4 border-b-primary">
                     <div id="orderNumberTitle">
                        <span>Order No.</span>
                        <span id="orderNumber"><?='#'.$OrderData['OrderDetail'][0]['OrderId']?></span>   
                     </div>
                     <div id="orderNumberSubtitle">
                        <span>Order Placed on </span>
                        <strong><script>document.write((new Date('<?=$OrderData["OrderDetail"][0]["CreatedOn"]?>')).toDateString());</script></strong>
                        <span> at </span>
                        <strong><?=date('h:i a', strtotime($OrderData["OrderDetail"][0]["CreatedOn"]))?></strong>
                     </div>
                  </div>
                  <!-- Order Details Form -->
                  <div class="ordertrackingprogress my-4">
                     <ul class="px-0">

                        <?php $skip = false; $elem = null; $canceledStepId = 7; $placed = false; for ($i=0; $i < count($OrderData['TrakingSteps']); $i++) {?>
                                 <li>
                                    <?php
                                    if($skip)
                                       $cls = "notdone";
                                    else
                                    $cls = $OrderData['TrakingSteps'][$i]['StepId'] <= $OrderData["OrderDetail"][0]["OrderStep"] ? "" : "notdone";
                                    ?>
                                    <div class="check-container">
                                       <div class="icon-container notdone"></div>
                                       <i class="fas fa-check <?=$cls?>"></i>
                                    </div>
                                    <p><?=$OrderData['TrakingSteps'][$i]['StepName']?></p>
                                    <?php if(!$placed && $OrderData["OrderDetail"][0]["PreviousOrderStep"] == 0){
                                       $placed = true;
                                       ?>
                                       <img src="<?php echo base_url() ?>assets/img/orderTrackingTruck.png" class="truck" />
                                    <?php } ?>


                                    <?php if(!$placed && ($OrderData['TrakingSteps'][$i]['StepId'] == $OrderData["OrderDetail"][0]["OrderStep"] && $OrderData["OrderDetail"][0]["OrderStep"] != 4 && $OrderData["OrderDetail"][0]["OrderStep"] != 7)){
                                       $placed = true;
                                       ?>
                                       <img src="<?php echo base_url() ?>assets/img/orderTrackingTruck.png" class="truck" />
                                    <?php } ?>
                                 </li>
                                 <?php
                                    if($OrderData["OrderDetail"][0]["OrderStep"] == $canceledStepId){
                                       if($OrderData['TrakingSteps'][$i]['StepId'] == $OrderData["OrderDetail"][0]["PreviousOrderStep"]){
                                          $skip = true;?>
                                          <li>
                                             <div class="check-container" style="border: 2px solid red;">
                                                <div class="icon-container notdone"></div>
                                                <i class="fas fa-times done" style="background-color: red;"></i>
                                             </div>
                                             <p style="color: red;">Canceled</p>
                                          </li>
                                       <?php }} ?>
                              <?php } ?>

                     </ul>
                  </div>
                  <!-- Order Details Form Ends -->

                  <!-- Order Details Table -->

                  
                  <table class="table table-bordered bg-white table-responsive-md">
                     <thead>
                        <tr>
                           <td scope="col">S.No</td>
                           <td scope="col">Product</td>
                           <td scope="col">Product Name</td>
                           <td scope="col">Quantity</td>
                           <td scope="col">Price</td>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($OrderData['OrderDetail']){
                           $products = $OrderData['OrderDetail'];
                           $total = 0;
                           for ($i=0; $i < count($products); $i++) {
                              $total += $products[$i]['ItemQuantity'] * $products[$i]['SoldPrice'];
                        ?>
                        <tr>
                           <td class="srno"><?=$i+1?></td>
                           <td>
                              <img src="<?= base_url($products[$i]['ProductImg'])?>" style="width: 70px;">
                           </td>
                           <td>
                              <h5><?=$products[$i]['ProductName']?></h5>
                              <h6><?=$products[$i]['ItemQuantity']?>&nbsp;<?=$products[$i]['UnitName']?></h6>
                           </td>
                           <td class="quantityData"><?=$products[$i]['ItemQuantity']?></td>
                           <td class="priceData">
                              <script>document.write(formatCurrency('<?=$products[$i]['SoldPrice']?>', 0))</script>
                           </td>
                        </tr>
                        <?php }} ?>
                     </tbody>
                  </table>

                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                           <div class="subtotal py-3 mb-3 d-flex justify-content-between align-items-center border-b-primary">
                              <span class="title">Subtotal</span>
                              <span class="price"><script>document.write(formatCurrency('<?=$total?>'))</script></span>
                           </div>
                           <h6 class="shippingHeading">Shipping</h6>
                           <div class="shippingContent pb-3 d-flex justify-content-between align-items-center">
                              <span>Delivery Charges</span>
                              <span><script type="text/javascript">document.write(formatCurrency('<?=$OrderData["OrderDetail"][0]["DeliveryCharges"]?>'));</script></span>
                           </div>
                           <?php $copunDiscount = 0; if($OrderData["OrderDetail"][0]["CopunDiscount"] && !is_null($OrderData["OrderDetail"][0]["CopunDiscount"]) && $OrderData["OrderDetail"][0]["CopunDiscount"] != 0){
                              $copunDiscount = floatval($OrderData["OrderDetail"][0]["CopunDiscount"]);
                              ?>
                              <div class="shippingContent pb-3 d-flex justify-content-between align-items-center">
                                 <span>Copun Discount</span>
                                 <span><script type="text/javascript">document.write(formatCurrency('-<?=$copunDiscount?>'));</script></span>
                              </div>
                           <?php }?>
                           <!-- <div class="shippingContentSub pb-3 border-b-primary">
                              <p>Shipping options will be updated during checkout.</p>
                           </div> -->
                           <div class="total pt-3 d-flex justify-content-between align-items-center">
                              <span class="title">Total</span>
                              <span class="price"><script>document.write(formatCurrency('<?=$total + $OrderData["OrderDetail"][0]["DeliveryCharges"] - $copunDiscount?>'))</script></span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Order Details Table Ends -->   
               </div>

               <?php ?>
            </div>
         </div>
      </div>
   </div>
</section>