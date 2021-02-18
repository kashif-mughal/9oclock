<style>
.banner_image_list {
    padding: 20px;
}
.banner_image_list img {
   max-width: 200px !important;
   max-height: 200px !important;
   margin: 4px;
   border-radius: 4px;
   height: 120px !important;
   width: 180px !important;
}
.banner_image_list .image-container {
    display: inline-block;
}
.AClass{
    right:0px;
    position: absolute;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    border: transparent;
    background-color: #c0392b;
    color: #fff;
}

.dropzone {
    width: 97%;
    height: 200px;
    padding: 20px;
    display: flex;
    align-items:center;
    justify-content: center;
    text-align:center;
    cursor:pointer;
    color: #cccccc;
    border: 1px dashed #333;
    margin-left: 25px;
    margin-right: 25px;
    margin-bottom: 20px;
    border-radius: 6px;
}
.dropzone-over {
    border-style: solid;
}
.dropzone-input {
    display: none;
}

</style>

<script type="text/javascript">
    // $(document).ready(funciton() {
    //     alert('Hello World');
    //     $('table tbody').sortable();
    // });
</script>

<!-- Manage Category Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Banner</h1>
            <small>Manage Banner</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Manage Banner</a></li>
            </ol>
        </div>
    </section>

    <section class="upload_area">
        <?php echo form_open('Cbanner/insert_banner_image', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'insert_banner_image')) ?>
            <div class="dropzone">
                <span class="dropzone_text">Drop banner image here or click to upload</span>
                <input type="file" name="image" class="dropzone-input">
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <input type="submit" id="add-banner" class="btn btn-success btn-large" name="add-banner" value="Click to Upload" />
                    </div>
                </div>
            </div>
        <?php echo form_close() ?>
    </section>

    <section>
        <div>
            <h3 class="container-fluid mt-4">Banner Images in Order</h3>
        </div>
        <div class="banner_image_list d-flex flex-column justify-content-center align-item-center">
            <?php 
                if($banner) {
                    ?>
            {banner}
                <div class="image-container" style="position:relative;">
                    <button data-index="{id}" class="close-{id} AClass">
                        <span>&times;</span>
                    </button>
                    <img data-index="{id}" data-position="{image_order}" src="<?php echo base_url() ?>{image_path}" alt="">
                </div>
            {/banner}
            <?php } ?>
        </div>

    </section>

</div>
<!-- Manage Category End -->

<!-- Delete Category ajax code -->

