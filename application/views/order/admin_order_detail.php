<!-- Manage Category Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Order Details</h1>
            <small>Order Details</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Order</a></li>
                <li class="active">Order Details</li>
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
                        <form id="trackForm" action="<?php echo base_url('Corder/update_traking')?>" class="form-inline" ccept-charset="utf-8">
                            <label for="order_no">Traking Step</label>
                            <select class="form-control" name="OrderStep" id="OrderStep" required>
                                <?php for ($i=0; $i < count($OrderData['TrakingSteps']); $i++) {?>
                                    <option value="<?=$OrderData['TrakingSteps'][$i]['StepId']?>"
                                        <?php if($OrderData['TrakingSteps'][$i]['StepId'] == $OrderData['OrderDetail'][0]['OrderStep']){echo 'selected';}?>
                                        ><?=$OrderData['TrakingSteps'][$i]['StepName']?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="orderId" value="<?=$OrderId?>">
                            <button type="submit" class="btn btn-primary btn-sm">Update Traking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Customer Name</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["first_name"] . ' ' . $OrderData["OrderDetail"][0]["last_name"]?></span>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Address</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["DAddress"]?></span>
                            </div>							
                        </div>
						<div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Town</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["town"]?></span>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">City</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["city"]?></span>
                            </div>							
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Email</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["email"]?></span>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="delivery-slot">Delivery Slot</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["DeliverySlot"]?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Phone</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["phone"]?></span>
                            </div>
							<div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Zip Code</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$OrderData["OrderDetail"][0]["zip_code"]?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-2">
                                <label for="order_no">Total Price</label>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <span><?=$TotalValue?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 style="display: inline-block;">Order Details</h4>
                            <button style="display: inline-block;float: right;background: green;color: white;padding: 2px 20px;border-radius: 3px;" id="stepName"><script type="text/javascript">var elem = $('#OrderStep')[0];
                            
                            var txt = elem.options[elem.selectedIndex].text;
                            document.write(txt);

                            if(txt.toLowerCase() == 'canceled'){
                                $('#stepName').css("background", "red");    
                            }
                            else{
                                $('#stepName').css("background", "green");
                            }
                        </script></button>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">

                            <table id="ordersdt" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($OrderData['OrderDetail'] as $key => $value) {?>
                                    <tr>
                                        <td><?=$value['sl']?></td>
                                        <td><img src="<?=base_url($value['ProductImg'])?>" style="width: 50px;"></td>
                                        <td><?=$value['ProductName']?></td>
                                        <td><?=$value['ItemQuantity']?>&nbsp;<?=$value['UnitName']?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $("#trackForm").submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
           type: "POST",
           url: form.attr('action'),
           data: form.serialize(),
           dataType: "JSON",
           success: function(data)
           {
                if(data.status == 0){
                    alert(data.message);
                    console.log(data);
                    return false;
                }else if(data.status == 1){
                    alert(data.message);
                    $('#stepName').html($('#OrderStep').val());

                    var elem = $('#OrderStep')[0];
                    var txt = elem.options[elem.selectedIndex].text;
                    $('#stepName').html(txt);
                    if(txt.toLowerCase() == 'canceled'){
                        $('#stepName').css("background", "red");    
                    }
                    else{
                        $('#stepName').css("background", "green");
                    }

                    console.log(data);
                    return false;
                }
           },
           error: function(a,b){
                $.notify("Something went wrong!!!", "error");
           }
        });
    });
</script>