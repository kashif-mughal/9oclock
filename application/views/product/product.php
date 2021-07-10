<!-- Manage Category Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Manage Product</h1>
            <small>Manage Your Product</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Product</a></li>
                <li class="active">Manage Product</li>
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

                    <a href="<?php echo base_url('Cproduct') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> Add Product </a>

                </div>
            </div>
        </div>

        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Manage Product</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Sale Price</th>
                                        <th class="text-center">Last Modified</th>
                                        <th class="text-center">Featured</th>
                                        <th class="text-center">Hot</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($product_list) {
                                        ?>
                                        {product_list}
                                        <tr id="{ProductId}">
                                            <td class="text-center">{sl}</td>
                                            <td class="text-center">{ProductName}</td>
                                            <td class="text-center">{CatName}</td>
                                            <td class="text-center">{Unit}</td>
                                            <td class="text-center">{SalePrice}</td>
                                            <td class="text-center">{ModifiedOn}</td>
                                            <td class="text-center">{IsFeatured}</td>
                                            <td class="text-center">{IsHot}</td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <a href="<?php echo base_url() . 'Cproduct/product_update_form/{ProductId}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="" class="DeleteProduct btn btn-danger btn-sm" name="{ProductId}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php echo form_close() ?>
                                                </center>
                                            </td>
                                    </tr>
                                    {/product_list}
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Product End -->

<!-- Delete Product ajax code -->
<script type="text/javascript">
    //Delete Product 
    $(".DeleteProduct").click(function ()
    {
        var product_id = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are You Sure,Want to Delete ?");
        if (x == true) {
            $.ajax
                ({
                    type: "POST",
                    url: '<?php echo base_url('Cproduct/product_delete') ?>',
                    data: {product_id: product_id, csrf_test_name: csrf_test_name},
                    cache: false,
                    success: function (datas)
                    {
                        alert(datas);
                    }
                });
        }
    });
    $(document).ready(function(){
        $("#dataTableExample3").dataTable();
    });
</script>



