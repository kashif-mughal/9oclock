<!-- Manage copun Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Manage Copun</h1>
            <small>Manage Your Copun</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Copun</a></li>
                <li class="active">Manage Copun</li>
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

                    <a href="<?php echo base_url('Ccopun') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> Add Copun </a>

                </div>
            </div>
        </div>

        <!-- Manage copun -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Manage Copun</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th class="text-center">Copun Name</th>
                                        <th class="text-center">Is Infinite</th>
                                        <th class="text-center">Start From</th>
                                        <th class="text-center">End On</th>
                                        <th class="text-center">Discount Type</th>
                                        <th class="text-center">Discount Value</th>
                                        <th class="text-center">Min Purchase</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($copun_list) {
                                        ?>
                                        {copun_list}
                                        <tr id="{Id}">
                                            <td class="text-center">{sl}</td>
                                            <td class="text-center">{CopunName}</td>
                                            <td class="text-center">{Infinite}</td>
                                            <td class="text-center">{StartFrom}</td>
                                            <td class="text-center">{EndOn}</td>
                                            <td class="text-center">{DiscountType}</td>
                                            <td class="text-center">{DiscountValue}</td>
                                            <td class="text-center">{MinPurchase}</td>
                                            <td>
                                                <center>
                                                    <?php echo form_open() ?>
                                                    <a href="<?php echo base_url() . 'Ccopun/copun_update_form/{CopunId}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="" class="Deletecopun btn btn-danger btn-sm" name="{CopunId}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php echo form_close() ?>
                                                </center>
                                            </td>
                                    </tr>
                                    {/copun_list}
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
<!-- Manage copun End -->

<!-- Delete copun ajax code -->
<script type="text/javascript">
    //Delete copun 
    $(".Deletecopun").click(function ()
    {
        var CopunId = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are You Sure,Want to Delete ?");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Ccopun/copun_delete') ?>',
                        data: {CopunId: CopunId, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {
                            alert(datas);
                        }
                    });
        }
    });
</script>



