<!-- Manage Category Start -->
<style type="text/css">
    .in-circle{
        box-shadow: 1px 1px 1px 1px #10ff0061;
        background-color: #cdffcc !important;
    }
    .pending-action{
        box-shadow: 1px 1px 1px 1px #fbff0061;
        background-color: #fff1aa !important;
    }
    .canceled{
        box-shadow: 1px 1px 1px 1px #ff000061;
        background-color: #ffdbdb !important;
    }
    .info-box{
        display: inline-block;
        float: right;
        width: 85px;
        height: 30px;
        text-align: center;
        margin: 1px;
        border-radius: 5px;
        color: indigo;
        padding: 5px;
    }
    .green{
        background-color: #cdffcc;
    }
    .red{
        background-color: #ffdbdb;
    }
    .yellow{
        background-color: #fff1aa;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Manage Orders</h1>
            <small>Manage Orders</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Order</a></li>
                <li class="active">Manage Order</li>
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
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo base_url('Corder/index')?>" class="form-inline" method="get" ccept-charset="utf-8">
                            <label for="order_no">Order No</label>
                            <input type="text" class="form-control" name="on" id="on" placeholder="Order No">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="up" id="up" placeholder="Phone">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </form>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var urlVals = getUrlVars();
                                document.getElementById("on").value = urlVals["on"] ? urlVals["on"] : "";
                                document.getElementById("up").value = urlVals["up"] ? urlVals["up"] : "";
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title" style="display: inline-block;">
                            <h4>Manage Order</h4>
                        </div>
                        <div style="display: inline-block; float: right;">
                            <div class="info-box green">In Process</div>
                            <div class="info-box yellow">Pending</div>
                            <div class="info-box red">Canceled</div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">

                            <table id="ordersdt" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Order No</th>
                                        <th>(OV + DC) Total Amount</th>
                                        <th>Customer Phone</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($orderData) {
                                        foreach ($orderData as $key => $value) {?>
                                            <tr class="<?= $value['OrderStep'] == 7 ? 'canceled' : ($value['OrderStep'] == 1 ? 'in-circle' : 'pending-action')?>">
                                                <td><?=$value['sl']?></td>
                                                <td><?= $value['OrderId']?></td>
                                                <td>
                                                    <?= $value['OrderValue']?> + <?= $value['DeliveryCharges'] ? $value['DeliveryCharges'] : 0 ?>
                                                </td>
                                                <td><?= $value['email'] ? "("+ $value['email'] +") " + $value['phone'] : $value['phone']?></td>
                                                <td><?= $value['ModifiedOn']?></td>
                                                <td>
                                                    <center>
                                                        <?php echo form_open()?>
                                                            <a href="<?php echo base_url("Corder/admin_order_detail_form/").$value['OrderId']; ?>" class="btn btn-info btn-sm" data-title="Order Detail" data-toggle="tooltip" data-placement="left" title="Order Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                        <?php echo form_close()?>
                                                    </center>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                                <div class="text-right"><?php echo $links?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>