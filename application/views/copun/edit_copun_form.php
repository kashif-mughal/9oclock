<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Update Copun</h1>
            <small>Update New Copun</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Copun</a></li>
                <li class="active">Update Copun</li>
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Alert Message -->
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
            <div class="col-sm-12">
                <div class="column">

                    <a href="<?php echo base_url('Ccopun/manage_copun') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Copun </a>

                </div>
            </div>
        </div>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Update Copun </h4>
                        </div>
                    </div>
                    <?php echo form_open('Ccopun/copun_update', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_copun')) ?>
                    <input type="hidden" name="CopunId" value="<?=$CopunData['CopunId']?>">
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="CopunName" class="col-sm-3 col-form-label">Copun Name <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="CopunName" id="CopunName" type="text" value="<?=$CopunData['CopunName']?>" placeholder="copun Name"  required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="StartFrom" class="col-sm-3 col-form-label">StartFrom </label>
                            <div class="col-sm-6">
                                <input class="form-control datepicker" autocomplete="off" name ="StartFrom" id="StartFrom" type="text" placeholder="StartFrom" value="<?php 
                                    if($CopunData['StartFrom'] != '0000-00-00 00:00:00')
                                    {
                                        echo date('Y-m-d', strtotime($CopunData['StartFrom']));
                                    }
                                ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="EndOn" class="col-sm-3 col-form-label">EndOn </label>
                            <div class="col-sm-6">
                                <input class="form-control datepicker" autocomplete="off" name ="EndOn" id="EndOn" type="text" placeholder="EndOn" value="<?php 
                                    if($CopunData['EndOn'] != '0000-00-00 00:00:00')
                                    {
                                        echo date('Y-m-d', strtotime($CopunData['EndOn']));
                                    }
                                ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="DiscountType" class="col-sm-3 col-form-label">Discount Type </label>
                            <div class="col-sm-6">
                                <select class="form-control" required autocomplete="off" name ="DiscountType" id="DiscountType">
                                    <option <?=$CopunData['DiscountType'] == "Amount" ? "selected" : ""?>>Amount</option>
                                    <option <?=$CopunData['DiscountType'] == "Percent" ? "selected" : ""?>>Percent</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="DiscountValue" class="col-sm-3 col-form-label">Discount Value </label>
                            <div class="col-sm-6">
                                <input class="form-control" min="1" autocomplete="off" name ="DiscountValue" id="DiscountValue" type="number" placeholder="DiscountValue" value="<?=$CopunData['DiscountValue']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="MinPurchase" class="col-sm-3 col-form-label">Min Purchase </label>
                            <div class="col-sm-6">
                                <input class="form-control" autocomplete="off" name ="MinPurchase" id="MinPurchase" type="number" placeholder="MinPurchase" value="<?=$CopunData['MinPurchase']?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Infinite" class="col-sm-3 col-form-label">Infinite </label>
                            <div class="col-sm-1">
                                <input style="margin-left: -15px;" type="checkbox" <?=$CopunData['Infinite'] == 1 ? "checked" : ""?> name="Infinite" class="form-control" id="Infinite">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-customer" class="btn btn-success btn-large" name="add-customer" value="Save" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new customer end -->




