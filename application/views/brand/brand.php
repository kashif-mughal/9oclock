<!-- Manage brand Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Manage Brand</h1>
            <small>Manage Your Brand</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Brand</a></li>
                <li class="active">Manage Brand</li>
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

                    <a href="<?php echo base_url('Cbrand') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> Add Brand </a>

                </div>
            </div>
        </div>

        <!-- Manage brand -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Manage Brand</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th class="text-center">Brand Name</th>
                                        <th class="text-center">Alias</th>
                                        <th class="text-center">Last Modified</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($brand_list) {
                                        ?>
                                        {brand_list}
                                        <tr id="{Id}">
                                            <td class="text-center">{sl}</td>
                                            <td class="text-center">{BrandName}</td>
                                            <td class="text-center">{Alias}</td>
                                            <td class="text-center">{ModifiedOn}</td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <a href="<?php echo base_url() . 'Cbrand/brand_update_form/{BrandId}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="" class="Deletebrand btn btn-danger btn-sm" name="{BrandId}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php echo form_close() ?>
                                                </center>
                                            </td>
                                    </tr>
                                    {/brand_list}
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
<!-- Manage brand End -->

<!-- Delete brand ajax code -->
<script type="text/javascript">
    //Delete brand 
    $(".Deletebrand").click(function ()
    {
        var BrandId = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are You Sure,Want to Delete ?");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Cbrand/brand_delete') ?>',
                        data: {BrandId: BrandId, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {
                            alert(datas);
                        }
                    });
        }
    });
</script>



