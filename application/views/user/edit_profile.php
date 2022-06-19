<!-- Edit Profile Page Start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon"><i class="pe-7s-user-female"></i></div>
        <div class="header-title">
            <h1>Update Profile</h1>
            <small>Your Profile</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i>Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="active">Update Profile</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-4">
            </div>
            <div class="col-sm-12 col-md-4">

            <?php echo form_open_multipart('Admin_dashboard/update_profile', array('id' => 'insert_product'))?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-menu">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="card-header-headshot" style="background-image: url({logo});"></div>
                    </div>
                    <div class="card-content">
                        <div class="card-content-member">
                            <h4 class="m-t-0">{first_name} {last_name}</h4>
                        </div>
                        <div class="card-content-languages">
                            <div class="card-content-languages-group">
                                <div>
                                    <h4>First Name:</h4>
                                </div>
                                <div>
                                    <ul>
                                        <input type="text" placeholder="First Name" class="form-control" id="first_name" name="first_name" value="{first_name}" required />
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content-languages-group">
                                <div>
                                    <h4>Last Name:</h4>
                                </div>
                                <div>
                                    <ul>
                                        <li><input type="text" placeholder="Last Name" class="form-control" id="last_name" name="last_name" value="{last_name}" required  /></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content-languages-group">
                                <div>
                                    <h4>Email:</h4>
                                </div>
                                <div>
                                    <ul>
                                        <li><input type="email" placeholder="User Name" class="form-control" id="user_name" name="user_name" value="{user_name}" required /></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content-languages-group">
                                <div>
                                    <h4>Image:</h4>
                                </div>
                                <div>
                                    <ul>
                                        <li><input type="file" id="logo" name="logo" value="{logo}" /></li>
                                        <input type="hidden" name="old_logo" value="{logo}" />
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-stats">
                          <button type="submit" class="btn btn-success" style="margin-left: 90px;"><?php echo display('update_profile') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close()?>
            </div>
        </div> 
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<!-- Edit Profile Page End -->