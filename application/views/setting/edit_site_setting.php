<!-- Add new customer start -->

<style type="text/css">
    .sort-category{
        padding-left: 0px;
    }
    .sort-category li{
        padding: 5px;
        margin-bottom: 3px;
    }
    .sort-category li:hover{
        background-color: #95d295;
    }
    .overlay-loading{
        width: 97%;
        height:100%;
        position: absolute;
        background-color: #00000033; 
        background-image: url(https://cdn.lowgif.com/small/b7daf07f7e8293bd-buy-manfrotto-pro-light-camera-backpack-3n1-36-af-marcotec.gif);
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Update Setting</h1>
            <small>Update New Setting</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Setting</a></li>
                <li class="active">Update Setting</li>
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
                <div class="alert alert-danger" style="display: none;"></div>
                <div class="alert alert-success" style="display: none;"></div>
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Update Settings Here</h4>
                        </div>
                    </div>
                    <?php echo form_open('Csettings/update_site_settings', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_setting')) ?>
                    <input type="hidden" name="setting_id" value="<?=$SettingData['setting_id']?>">
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="delivery_charges" class="col-sm-3 col-form-label">Delivery Charges <i class="text-danger">*</i></label>
                            <div class="col-sm-9">
                                <input class="form-control" name ="delivery_charges" id="delivery_charges" type="number" value="<?=$SettingData['delivery_charges']?>" placeholder="Delivery Charges"  required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="footer_text" class="col-sm-3 col-form-label">Footer Text </label>
                            <div class="col-sm-9">
                                <textarea rows="10" class="form-control" name ="footer_text" id="footer_text" placeholder="Footer Text">
                                    <?=$SettingData['footer_text']?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_text" class="col-sm-3 col-form-label">Promotion Text </label>
                            <div class="col-sm-9">
                                <input class="form-control" name ="promotion_text" id="promotion_text" type="text" value="<?=$SettingData['promotion_text']?>" placeholder="Promotion Text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-12">
                                <input type="submit" style="float: right;width: 10%;" class="btn btn-success btn-large" value="Save" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <?php echo form_open('Ccategory/update_category_order', array('class' => 'form-vertical', 'method' => 'post', 'id' => 'update_category_order')) ?>
                    <input type="hidden" name="setting_id" value="<?=$SettingData['setting_id']?>">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="homecat" class="col-sm-3 col-form-label">Home Categories</label>
                            <div class="col-sm-9">
                                <div class="overlay-loading" style="display: none;"></div>
                                <ul id="sortable-sss" class="sort-category">
                                    <?php $counter = 0; foreach($categories as $category){?>
                                        <li class="list-unstyled ui-state-default uisort" 
                                        data-uisort="<?=++$counter?>" 
                                        data-originalsort="<?=$category['sort']?>" 
                                        data-id="<?=$category['CategoryId']?>" 
                                        data-name="<?=$category['CatName']?>"><?=$category['CatName']?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-12">
                                <input type="submit" style="float: right;width: 10%;" class="btn btn-success btn-large" value="Save Order" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>

                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="delivery_charges" class="col-sm-3 col-form-label">Choose category for sub category sorting</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cat-for-sub-cat">
                                    <?php $counter = 0; foreach($categories as $category){?>
                                        <option value="<?=$category['CategoryId']?>"><?=$category['CatName']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php echo form_open('Ccategory/update_category_order', array('class' => 'form-vertical', 'method' => 'post', 'id' => 'update_sub_category_order')) ?>
                    <input type="hidden" name="setting_id" value="<?=$SettingData['setting_id']?>">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="homecat" class="col-sm-3 col-form-label">Sub Categories</label>
                            <div class="col-sm-9">
                                <div class="overlay-loading" style="display: none;"></div>
                                <ul id="sortable-sss2" class="sort-category">
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-12">
                                <input type="submit" style="float: right;width: 10%;" class="btn btn-success btn-large" value="Save Order" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#update_category_order, #update_sub_category_order').on('submit', function(){
            event.preventDefault();
            var currentElem = $(this);
            var all_lis = $("#" + currentElem.attr("id") + " .sort-category li");
            var payload = [];
            var currentLiObj = null;
            for (var i = 0; i < all_lis.length; i++) {
                var tempCatSortObj = {};
                currentLiObj = $(all_lis[i]);
                tempCatSortObj.id = currentLiObj.data("id");
                tempCatSortObj.pso = currentLiObj.data("originalsort");
                // var uisortorder = currentLiObj.data("uisort");
                // var findElem = all_lis.filter(function(index, obj){
                //     return $(obj).data("uisort") == i+1;
                // });
                // if(findElem.length > 0){
                //     tempCatSortObj.nso = findElem.data("originalsort");
                // }

                tempCatSortObj.nso = i+1;
                payload.push(tempCatSortObj);
            }
            postData(payload, currentElem.attr("action"), currentElem.attr("method"))
        });

        function postData(data, url, method){
            $('.overlay-loading').show();
            $.ajax({
               type: method,
               url: url,
               data: {"catData": JSON.stringify(data)},
               // dataType: "JSON",
               success: function(success)
               {
                if(success){
                    $('.alert-success').html("Category order saved successfully");
                    $('.alert-success').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-success').hide();
                    }, 5000);
                }
                else{
                    $('.alert-danger').html("Something went wrong!!!");
                    $('.alert-danger').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-danger').hide();
                    }, 5000);
                }
               },
               error: function(a,b){console.log(a);
                    $('.alert-danger').html("Something went wrong!!!");
                    $('.alert-danger').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-danger').hide();
                    }, 5000);
               },
               complete: function(){
                $('.overlay-loading').hide();
                window.location.href = "#";
               }
            });
        }

        $("#cat-for-sub-cat").change(function(){
            var targetElem = $('#update_sub_category_order #sortable-sss2');
            targetElem.empty();
            var selectElem = $(this);
            $.ajax({
               type: 'GET',
               url: '<?=base_url("Ccategory/child_cats")?>',
               data: {"catId": selectElem.val()},
               dataType: "JSON",
               success: function(resultCats)
               {debugger;
                if(resultCats){
                    var counter = 0
                    for (var i = 0; i < resultCats.length; i++) {
                        targetElem.append(`<li class="list-unstyled ui-state-default uisort ui-sortable-handle" 
                        data-uisort="${++counter}" 
                        data-originalsort="${resultCats[i].sort}" 
                        data-id="${resultCats[i].CategoryId}" 
                        data-name="${resultCats[i].CatName}">${resultCats[i].CatName}</li>`);
                    }
                }
               },
               error: function(a,b){console.log(a);}
            });
            
            
        });
        $( "#sortable-sss2" ).sortable({
            axis: 'y'
        });
    });
</script>
<!-- Site Setting end -->




