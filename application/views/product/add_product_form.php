<!-- Add new customer start -->
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
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Add Product</h1>
            <small>Add New Product</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Product</a></li>
                <li class="active">Add Product</li>
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

                    <a href="<?php echo base_url('Cproduct/manage_product') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Product </a>

                </div>
            </div>
        </div>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Add Product</h4>
                        </div>
                    </div>
                    <?php echo form_open('Cproduct/insert_product', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_product')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="ProductName" class="col-sm-3 col-form-label">Product Name <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="ProductName" id="ProductName" type="text" placeholder="Product Name"  required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="OriginalPrice" class="col-sm-3 col-form-label">Original Price </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="OriginalPrice" id="OriginalPrice" type="text" placeholder="Original Price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Price" class="col-sm-3 col-form-label">Price </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="Price" id="Price" type="text" placeholder="Price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="SalePrice" class="col-sm-3 col-form-label">Sale Price </label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="SalePrice" id="SalePrice" type="text" placeholder="Sale Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="IsFeatured" class="col-sm-3 col-form-label">IsFeatured </label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="IsFeatured" name="IsFeatured">
                                </div>
                            </div>
                            <label for="IsHot" class="col-sm-3 col-form-label">IsHot </label>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="IsHot" name="IsHot">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CategoryId" class="col-sm-3 col-form-label">Category </label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="CategoryId" id="CategoryId" required>
                                    <option value="0">None</option>
                                    {categories}
                                        <option value="{CategoryId}">{CatName}</option>
                                    {/categories}
                                </select>
                            </div>
                        </div>

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
                                <input class="form-control" name ="SaleUnitQty" id="SaleUnitQty" type="number" required placeholder="SaleUnitQty">
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
                        
                        <div class="form-group row">
                            <label for="stock" class="col-sm-3 col-form-label">Stock <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="stock" id="stock" required>
                                    <option value="1" selected="selected">In Stock</option>
                                    <option value="0">Out Of Stock</option>
                                    <option value="2">Out Of Season</option>
                                </select>
                            </div>
                        </div>
                        
                        <!--<div class="form-group row">
                            <label for="season" class="col-sm-3 col-form-label">Season <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="season" id="season" required>
                                    <option value="1" selected="selected">In Season</option>
                                    <option value="0">Out Of Season</option>
                                </select>
                            </div>
                        </div>-->
                        
                        <div class="form-group row">
                            <label for="Img" class="col-sm-3 col-form-label">Product Image </label>
                            <div class="col-sm-6">
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="varient" class="col-sm-3 col-form-label">Varient </label>
                            <div class="col-sm-9">
                                <table id="varientTable">
                                    <tr>
                                        <th>Varient Name</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
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
                                </table>
                                <div style="float: left;margin-top: 10px;" class="addvarient btn btn-success btn-large" onclick="addVarient()">Add Varient</div>
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
                                <textarea class="form-control" name="Description" rows="5" id="Description" placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6" id="TagPool">
                                
                            </div>
                        </div>

                        <input type="hidden" name="allTags" id="allTags" />

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="Save Product" />
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

<script type="text/javascript">
    $(document).ready(function() {

        var tagsList = $('#allTags').val();
        if(tagsList) {
            var tagsArrayList = tagsList.split(",");
            for(var i = 0; i < tagsArrayList.length; i++) {
                $('#TagPool').append(`<a href="javascript:void(0)" class="tag" id="tag-${tagsArrayList[i]}" title="Remove Tag">${tagsArrayList[i]}</a>`);
            }
        }

        var tags = '';
        $('#addTag').click(function(e) {
            if($('#Tags').val() != '' || $('#Tags').val() != 'undefined') {
                var singleTag = $('#Tags').val();
                if(!isDuplicate(singleTag)) {
                    $('#TagPool').append(`<a href="javascript:void(0)" class="tag" id="tag-${singleTag}" title="Remove Tag">${singleTag}</a>`);
                    $('#Tags').val('');
                }
            }
        });

        $(document).on("click", "a.tag", function (e) { $(this).remove(); });

        $('#insert_product').submit(function() {
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









