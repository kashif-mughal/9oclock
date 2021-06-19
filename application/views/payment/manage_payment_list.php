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
            <h1>Payment List</h1>
            <small>Payment List</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Payment</a></li>
                <li class="active">Payment List</li>
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
        
        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title" style="display: inline-block;">
                            <h4>Payment List</h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">

                            <table id="ordersdt" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>TransactionId</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>StatusCode</th>
                                        <th>TransactionDate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($Payments) {
                                        foreach ($Payments as $key => $value) {?>
                                            <tr>
                                                <td><?=$value['transaction_id']?></td>
                                                <td><?= $value['a'] ?></td>
                                                <td><?= $value['b'] ?></td>
                                                <td><?= $value['c'] ?></td>
                                                <td><?= $value['d']?></td>
                                            </tr>
                                <?php
                                        }
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