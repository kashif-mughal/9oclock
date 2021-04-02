<style type="text/css">

    #TagPool a.tag {
        background: #eee;
        border-radius: 3px 0 0 3px;
        color: #999;
        display: inline-block;
        height: 26px;
        line-height: 26px;
        padding: 0 20px 0 23px;
        position: relative;
        margin: 0 10px 10px 0;
        text-decoration: none;
        -webkit-transition: color 0.2s;
    }

    a.tag::before {
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        content: '';
        height: 6px;
        left: 10px;
        position: absolute;
        width: 6px;
        top: 10px;
    }

    a.tag::after {
        background: #fff;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #eee;
        border-top: 13px solid transparent;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
    }

    #TagPool a.tag:hover {
        background-color: crimson;
        color: white;
    }

    #TagPool a.tag:hover::after {
        border-left-color: crimson; 
    }
    .times:hover{
        cursor: pointer;
    }
    .times{
        float: right;
        color: red;
        font-weight: 900;
    }
    .addvarient:hover{
        cursor: pointer;
    }
    .addvarient{
        float: left;
        margin-top: 10px;
    }
    .vicon{
        width: 45px;
    }
</style>
<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Product Edit</h1>
            <small>Product Edit</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Product</a></li>
                <li class="active">Product Edit</li>
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

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Product Edit </h4>
                        </div>
                    </div>
                  <?php echo form_open_multipart('Cproduct/product_update',array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'product_update'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <label for="product_name" class="col-sm-3 col-form-label">Product_name <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="product_name" id="product_name" type="text" placeholder="Products Name"  required="" value="{product_name}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="OriginalPrice" class="col-sm-3 col-form-label">Original Price </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="OriginalPrice" id="OriginalPrice" value="{OriginalPrice}" type="text" placeholder="Original Price" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Price <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="price" id="price" type="text" placeholder="Price"  required="" value="{price}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salePrice" class="col-sm-3 col-form-label">Sale Price</label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="SalePrice" id="SalePrice" type="text" placeholder="Sale Price" value="{sale_price}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="isFeatured" class="col-sm-3 col-form-label">Is Featured <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="isFeatured" id="isFeatured">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isHot" class="col-sm-3 col-form-label">Is Hot <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="isHot" id="isHot">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#isFeatured').val(<?=$is_featured?>);
                                $('#isHot').val(<?=$is_hot?>);
                                $('#isFeatured').trigger('change');
                                $('#isHot').trigger('change');
                            });
                        </script>

                        <div class="form-group row">
                            <label for="CategoryId" class="col-sm-3 col-form-label">Category <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="CategoryId" id="CategoryId" required>
                                    <option value="0">None</option>
                                    {categories}
                                        <option value="{CategoryId}">{CatName}</option>
                                    {/categories}
                                </select>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#CategoryId').val('<?=$category?>');
                        </script>

                        <div class="form-group row">
                            <label for="BrandId" class="col-sm-3 col-form-label">Brand <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="BrandId" id="BrandId">
                                    <option value="0">None</option>
                                    {brands}
                                        <option value="{BrandId}">{BrandName}</option>
                                    {/brands}
                                </select>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#BrandId').val('<?=$brand?>');
                        </script>

                        <div class="form-group row">
                            <label for="Unit" class="col-sm-3 col-form-label">Unit <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="Unit" id="Unit" required>
                                    <option value="0">None</option>
                                    {units}
                                        <option value="{UnitId}">{UnitName}</option>
                                    {/units}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="SaleUnitQty" class="col-sm-3 col-form-label">Sale Unit Quantity </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="SaleUnitQty" id="SaleUnitQty" type="number" value="{sale_unit_qty}" required placeholder="SaleUnitQty">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="SaleUnit" class="col-sm-3 col-form-label">Sale Unit <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="SaleUnit" id="SaleUnit" required>
                                    <option value="0">None</option>
                                    {units}
                                        <option value="{UnitId}">{UnitName}</option>
                                    {/units}
                                </select>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $('#Unit').val(<?=$unit?>);
                            $('#SaleUnit').val(<?=$sale_unit?>);
                        </script>
                        
                        <div class="form-group row">
                            <label for="stock" class="col-sm-3 col-form-label">Stock <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                
                                <select class="form-control" name="stock" id="stock" required>
                                    <option value="1" <?php if($stock=='1') { echo 'selected="selected"'; } ?>>In Stock</option>
                                    <option value="0" <?php if($stock=='0') { echo 'selected="selected"'; } ?> >Out Of Stock</option>
                                    <option value="2" <?php if($stock=='2') { echo 'selected="selected"'; } ?> >Out Of Season</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <!--<div class="form-group row">
                            <label for="season" class="col-sm-3 col-form-label">Season <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                
                                <select class="form-control" name="season" id="season" required>
                                    <option value="1" <?php if($season=='1') { echo 'selected="selected"'; } ?>>In Season</option>
                                    <option value="0" <?php if($season=='0') { echo 'selected="selected"'; } ?> >Out Of Season</option>
                                </select>
                            </div>
                        </div>-->
                        
                        
                        <div class="form-group row">
                            <label for="sort" class="col-sm-3 col-form-label">Sort</label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="sort" id="sort" type="number" value="{sort}">
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status" id="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">Icon </label>
                            <div class="col-sm-6">
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="varient" class="col-sm-3 col-form-label">Varient </label>
                            <div class="col-sm-9">
                                <table id="varientTable">
                                    <tr>
                                        <th>Icon</th>
                                        <th>Varient Name</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php 
                                    if(!is_null($product_varient)){
                                        for ($i=0; $i < count($product_varient); $i++) { ?>
                                        <tr>
                                            <td><img src="<?=base_url($product_varient[$i]["VImage"])?>" class="vicon"></td>
                                            <td><input type='text' value="<?php echo $product_varient[$i]["VName"] ?>" name='vNames[]' class="form-control"></td>
                                            <td><input type="file" value="<?php echo $product_varient[$i]["VImage"] ?>" name="vImage[]" class="form-control"></td>
                                            <td style="width: 15%">
                                                <select name='vType[]' onchange='changeVarientType(this)' class="form-control">
                                                    <option <?php if($product_varient[$i]["VType"] == 'text')
                                                    {
                                                        echo 'selected';
                                                    } ?>>text</option>
                                                    <option <?php if($product_varient[$i]["VType"] == 'color')
                                                    {
                                                        echo 'selected';
                                                    } ?>>color</option>
                                                </select>
                                            </td>
                                            <td class='val'><input type="text" class="form-control" value="<?php echo $product_varient[$i]["VValue"] ?>" name="vValue[]"/></td>
                                            <td><span class='times' onclick='removeVarient(this)'>&times;</span></td>
                                        </tr>
                                    <?php }
                                    }
                                    else{?>
                                        <tr>
                                            <td></td>
                                            <td><input type='text' name='vNames[]' class="form-control"></td>
                                            <td><input type="file" name="vImage[]" class="form-control"></td>
                                            <td style="width: 15%">
                                                <select name='vType[]' onchange='changeVarientType(this)' class="form-control">
                                                    <option>text</option>
                                                    <option>color</option>
                                                </select>
                                            </td>
                                            <td class='val'><input type="text" class="form-control" name="vValue[]"/></td>
                                            <td><span class='times' onclick='removeVarient(this)'>&times;</span></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <div class="addvarient btn btn-success btn-large" onclick="addVarient()">Add Varient</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">&nbsp; </label>
                            <div class="col-sm-6">
                                <img style="background: green; max-width: 100px;" src="<?=base_url()?>{ProductImg}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Tags" class="col-sm-3 col-form-label">Tags </label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input class="form-control" name ="Tags" id="Tags" type="text" placeholder="Tags" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" id="addTag" type="button">Add</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-sm-3 col-form-label">Description </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="Description" rows="5" id="Description" placeholder="Description">{Description}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6" id="TagPool">
                                
                            </div>
                        </div>

                        <input type="hidden" name="allTags" id="allTags" value="{tags}" />

                        <input type="hidden" value="{product_id}" name="product_id">

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="edit-product" class="btn btn-success btn-large" name="edit-product" value="Save Changes" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit customer end -->


<script>
    $(document).ready(function() {
        $('#is_featured').val(<?=$is_featured; ?>);
        $('#is_hot').val(<?=$is_hot; ?>);

        var tagsList = $('#allTags').val();
        if(tagsList) {
            var tagsArrayList = tagsList.split(",");
            for(var i = 0; i < tagsArrayList.length; i++) {
                $('#TagPool').append(`<a href="javascript:void(0)" class="tag" id="tag-${tagsArrayList[i]}" title="Remove Tag">${tagsArrayList[i]}</a>`);
            }
        }

        var tags = '';
        $('#addTag').click(function(e) {
            if($('#Tags').val()) {
                var singleTag = $('#Tags').val();
                if(!isDuplicate(singleTag)) {
                    $('#TagPool').append(`<a href="javascript:void(0)" class="tag" id="tag-${singleTag}" title="Remove Tag">${singleTag}</a>`);
                    $('#Tags').val('');
                }
            }
        });

        $(document).on("click", "a.tag", function (e) { $(this).remove(); });

        $('#product_update').submit(function() {
            var tagsData = $('#TagPool a');
            var tagsDatalength = $('#TagPool a').length;
            var arrayTags = [];
            var arrayList = "";
            for(var i = 0; i < tagsDatalength; i++) {
                arrayTags.push($('#TagPool a')[i].text);
            }
            arrayList = arrayTags.join(',');
            $('#allTags').val(arrayList);
        });

    });

    function isDuplicate(tag) {
        var tagsData = $('#TagPool a');
        var tagsDatalength = $('#TagPool a').length;
        for(var i = 0; i < tagsDatalength; i++) {
            if($('#TagPool a')[i].text == tag) {
                return true;
            }
        }
        return false;
    }
    function addVarient(){
        var varientTable = $('#varientTable');
        varientTable.append(`<tr>
                                <td><img src="" class="vicon"></td>
                                <td><input type='text' name='vNames[]' class="form-control"></td>
                                <td><input type="file" name="vImage[]" class="form-control"></td>
                                <td style="width: 15%">
                                    <select name='vType[]' onchange='changeVarientType(this)' class="form-control">
                                        <option>text</option>
                                        <option>color</option>
                                    </select>
                                </td>
                                <td class='val'><input type="text" class="form-control" name="vValue[]"/></td>
                                <td><span class='times' onclick='removeVarient(this)'>&times;</span></td>
                            </tr>`);
    }
    function removeVarient(currentElem){
        $(currentElem).closest('tr').remove();
    }
    function changeVarientType(currentElem){
        var currentVarientVal = $(currentElem).val();
        if(currentVarientVal == 'text'){
            $(currentElem).closest('tr').find('.val').html('<input type="text" class="form-control" name="vValue[]"/>');
        }
        else if(currentVarientVal == 'color'){
            $(currentElem).closest('tr').find('.val').html('<input type="color" class="form-control" name="vValue[]"/>');
        }
    }
</script>


