<!-- Bread Crumb -->

<div class="bread_crumb">
    <div class="container">
        <div class="row d-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="https://saudaexpress.com/">Home</a></li>
                    <!--<li class="breadcrumb-item"><a href="javascript:void(0);">Order</a></li>-->
                    <li class="breadcrumb-item">User Edit Profile</li>
                </ol>
                <h3 class="mb-0">User Profile</h3>
            </nav>
            <h3 class="mb-0"><?php echo $SelectOrder['SubOrder']; ?></h3>
        </div>
    </div>
</div>

<!-- Bread Crumb -->


<section class="main-content">
    <div class="container">
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
            <div class="col-xl-3 col-lg-3 col-md-12 pr-0 hidden-sm-down mt-4">
                <div class="sidenav" style="position: relative;width: 100%;z-index: 0;height: auto;">
                    <div>
                        <?php 
                            if(empty($CatList))
                                $CatList = Array();
                            $data['CatList'] = $CatList;
                            $this->load->view('include/user_left_menu_2', $data);
                        ?> 
                    </div>
                </div>
            </div> 
            <div class="col-xl-9 col-lg-9 col-md-12 my-3 pr-0">
                <div class="card content-box my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center text-uppercase">Email: "<span>{email}</span>"</h5>
                        <h5 class="card-title text-center text-uppercase">Phone: "<span>{phone}</span>"</h5>
                        <?php echo form_open_multipart('User/update_profile', array('id' => 'update_profile_form'))?>
                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <img class="card-header-headshot img-fluid" style="border-radius: 100%;" width="150" src="{logo}">
                            </div>
                            <div class="card-body">
                                <div class="form-label-group mb-3">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{first_name}" autocomplete="off" required>
                                </div>
                                <div class="form-label-group mb-3">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{last_name}" autocomplete="off" required>
                                </div>
                                <div class="form-label-group mb-3">
                                    <input type="text" id="user_name" name="user_name" class="form-control" placeholder="User Name" value="{user_name}" autocomplete="off" required>
                                </div>
                                <div class="form-label-group mb-3">
                                    <input type="file" id="logo" name="logo" class="form-control">
                                    <input type="hidden" name="old_logo" value="{logo}" />
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <div class="card-footer-stats">
                                  <input type="submit" class="btn btn-info button-secondary text-white p-2 text-dec-none btn-block text-uppercase">
                                </div>
                            </div>
                        </div>
                        <?php echo form_close()?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>