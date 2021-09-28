<!-- Bread Crumb -->

<div class="bread_crumb">
    <div class="container">
        <div class="row d-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/">Home</a></li>
                    <li class="breadcrumb-item">Order Tracking</li>
                </ol>
                <h3 class="mb-0">Order Tracking</h3>
            </nav>
            <h3 class="mb-0"><?php echo $SelectOrder['SubOrder']; ?></h3>
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
            <div class="col-xl-9 col-lg-9 col-md-12 my-3 pr-0">
                <div class="card content-box my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Enter Order# For Traking Your Order</h5>
                        <form action="<?=base_url("Corder/order_traking")?>" method="post"> 
                            <div class="form-label-group mb-3" style="text-align: center;">
                                <input type="text" style="text-align: center;" id="OrderId" name="OrderId" class="form-control" placeholder="Order#" autocomplete="off" required autofocus>
                            </div>
    
                            <input type="submit"class="btn btn-info button-secondary text-white p-2 text-dec-none btn-block text-uppercase" value="Track Now">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>