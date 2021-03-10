<style>
.banner_image_list {
    padding: 20px;
}
.banner_image_list img {
   max-width: 600px !important;
   max-height: 600px !important;
   margin: 4px;
   border-radius: 4px;
}
.banner_image_list .image-container {
    display: inline-block;
}
.dropzone-image-url {
    width: 97%;
    margin-bottom: 20px;
    margin-left: 25px;
}
.image_delete{
    right:0px;
    position: absolute;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    border: transparent;
    background-color: #c0392b;
    color: #fff;
}
.image_edit {
    left: 0px;
    position: absolute;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    border: transparent;
    background-color: #2980b9;
    color: #fff;
}
.image-container button {
    font-size: 10px;
    font-weight: 100;
}

.dropzone {
    width: 97%;
    height: 100px !important;
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

<!-- Manage Category Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Banner</h1>
            <small>Edit Banner</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Edit Banner</a></li>
            </ol>
        </div>
    </section>

    <section class="upload_area">
        <?php echo form_open('Cbanner/update_edited_banner_image', array('class' => 'form-vertical', 'enctype' => 'multipart/form-data', 'id' => 'edit_banner_image')) ?>
            <input type="text" name="image_url" class="dropzone-image-url form-control" placeholder="Image Redirect Url Here" value="<?php echo $bannerImage[0]['image_url'] ?>">
            <div class="dropzone">    
                <span class="dropzone_text">Drop banner image here or click to upload</span>
                <input type="file" name="image" class="dropzone-input" ?>">
                <input type="hidden" id="imageId" name="imageId" value="<?php echo $bannerImage[0]['id']  ?>">
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <input type="submit" id="edit-banner" class="btn btn-success btn-large" name="edit-banner" value="Click to Upload" />
                    </div>
                </div>
            </div>
        <?php echo form_close() ?>
    </section>

    <section>
        <div>
            <h3 class="container-fluid mt-4">Banner Image</h3>
        </div>
        <div class="banner_image_list d-flex flex-column justify-content-center align-item-center">
            <div class="image-container" style="position:relative;">
               <img data-index="<?php echo $bannerImage[0]['id'] ?>" data-position="<?php echo $bannerImage[0]['image_order'] ?>" src="<?php echo base_url() . $bannerImage[0]['image_path'] ?>" alt="">
            </div>
        </div>

    </section>

</div>
<!-- Manage Category End -->

<!-- Delete Category ajax code -->

