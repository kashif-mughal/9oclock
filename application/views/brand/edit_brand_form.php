<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Update Brand</h1>
            <small>Update New Brand</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Brand</a></li>
                <li class="active">Update Brand</li>
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

                    <a href="<?php echo base_url('Cbrand/manage_brand') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Brand </a>

                </div>
            </div>
        </div>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Update Brand </h4>
                        </div>
                    </div>
                    <?php echo form_open('Cbrand/brand_update', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_brand')) ?>
                    <input type="hidden" name="BrandId" value="<?=$BrandData['BrandId']?>">
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="BrandName" class="col-sm-3 col-form-label">Brand Name <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="BrandName" id="BrandName" type="text" value="<?=$BrandData['BrandName']?>" placeholder="brand Name"  required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Alias" class="col-sm-3 col-form-label">Alias </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="Alias" id="Alias" type="text" value="<?=$BrandData['Alias']?>" placeholder="Alias">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">Icon </label>
                            <div class="col-sm-6">
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">&nbsp; </label>
                            <div class="col-sm-6">
                                <img style="background: green; max-width: 100px;" src="<?=base_url().$BrandData['Img']?>">
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




