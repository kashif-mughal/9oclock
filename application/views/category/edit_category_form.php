<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Add Category</h1>
            <small>Add New Category</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Category</a></li>
                <li class="active">Add Category</li>
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

                    <a href="<?php echo base_url('Ccategory/manage_category') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Category </a>

                </div>
            </div>
        </div>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Add Category </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Ccategory/category_update', array('class' => 'form-vertical', 'id' => 'insert_category')) ?>
                    <div class="panel-body">
                        <input type="hidden" name="CategoryId" value="{CategoryId}">
                        <div class="form-group row">
                            <label for="CatName" class="col-sm-3 col-form-label">Category Name <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="CatName" id="CatName" value="{CatName}" type="text" placeholder="Category Name"  required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Alias" class="col-sm-3 col-form-label">Alias </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="Alias" id="Alias" value="{Alias}" type="text" placeholder="Alias">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ParentId" class="col-sm-3 col-form-label">Parent </label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="ParentId" id="ParentId">
                                    <option value="0">None</option>
                                    {parent_categories}
                                        <option value="{CategoryId}">{CatName}</option>
                                    {/parent_categories}
                                </select>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#ParentId').val('<?=$ParentId?>');
                        </script>

                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">Icon </label>
                            <div class="col-sm-6">
                                <input type="file" name="image" value="{Img}" class="form-control" id="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">&nbsp; </label>
                            <div class="col-sm-6">
                                <img style="background: green; max-width: 100px;" src="<?=base_url()?>{Img}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="sort" class="col-sm-3 col-form-label">sort</label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="sort" id="sort" value="{sort}" type="number">
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




