<!-- Add new customer start -->
<style type="text/css">
    .customCart{
        text-align: center;
        border-radius: 10px 10px 0px 0px !important;
        border: 1px solid #cccccc !important;
        padding: 12px;
        position: relative;
    }
    .customCart i.fa-times {
        float: right;
        cursor: pointer;
        background-color: red;
        color: #fff;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        position: absolute;
        right: 7px;
        top: 7px;
        padding-top: 4px;
    }
    .customCart img{
        width: 120px;
        height: 120px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Add Value</h1>
            <small>Add New Value</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Value</a></li>
                <li class="active">Add Value</li>
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

                    <a href="<?php echo base_url('Cvalue/manage_value') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Value </a>

                </div>
            </div>
        </div>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Add Value </h4>
                        </div>
                    </div>
                    <?php echo form_open('Cvalue/insert_value', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_value')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="ValueName" class="col-sm-3 col-form-label">Value Name <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" autofocus id="select-grocery">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3">&nbsp;</div>
                            <dir class="col-sm-9" id="product-area"></dir>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6" style="float: right;">
                                <input style="float: right;width: 100px;" type="submit" id="add-value" class="btn btn-success btn-large" name="add-value" value="Save" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new grocery value end -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#select-grocery').select2({
          ajax: {
            url: '<?=base_url('Cvalue/product_select');?>',
            dataType:'json',
            type : 'GET',
            data: function (params) {
              var query = {
                search: params.term
              }
              return query;
            },
            processResults: function (data, params) {
                return {results: data};
            }
          },
          escapeMarkup: function(markup) {
            return markup;
          },
          templateResult: function(data) {
            return data.html;
          },
          templateSelection: function(data) {
            return data.text;
          }
        });
        $('#select-grocery').on('select2:select', function (e) {
            var productJson = JSON.parse(e.params.data.jsonObj);
            var baseUrl = '<?=base_url();?>';
            var productArea = $('#product-area');
            var cartMarkup = `<div class="col-md-3 col-lg-3 col-sm-6">
                                <div class="card customCart">
                                    <i class='fa fa-times' style='float:right;cursor:pointer;'></i>
                                    <img src="{productImg}">
                                    <h5>{productName}</h5>
                                    <h6>in {productCategory}</h6>
                                </div>
                                <input type="hidden" name="productId[]" value="{productId}">
                            </div>`;
            cartMarkup = cartMarkup.replace(/{productImg}/g, baseUrl + productJson.ProductImg);
            cartMarkup = cartMarkup.replace(/{productName}/g, productJson.ProductName);
            cartMarkup = cartMarkup.replace(/{productCategory}/g, productJson.CatName);
            cartMarkup = cartMarkup.replace(/{productId}/g, productJson.ProductId);
            productArea.append(cartMarkup);
        });

        $(document).ready(function(){
            $(document).on('click', '.fa-times', function () {
                $(this).closest('.col-sm-6').remove();
            });
        });
    });
</script>



