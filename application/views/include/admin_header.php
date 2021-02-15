<?php
$CI = & get_instance();
$CI->load->model('Web_settings');

$CI->load->model('Users');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
$users = $CI->Users->profile_edit_data();
?>
<!-- Admin header end -->
<style type="text/css">
    .navbar .btn-success{
        margin: 13px 2px;
    }
</style>
<header class="main-header"> 
    <!-- Logo -->
    <a href="<?php echo base_url() ?>" class="logo"> 
        <span class="logo-mini">
            <img src="<?php
            if (isset($Web_settings[0]['favicon'])) {
                echo $Web_settings[0]['favicon'];
            }
            ?>" alt="">
        </span>

        <span class="logo-lg">

            <img src="<?php
            if (isset($Web_settings[0]['logo'])) {
                echo $Web_settings[0]['logo'];
            }
            ?>" alt="">
        </span>
    </a>
    <!-- Logo End -->
    <!-- Header Navbar -->


    <nav class="navbar navbar-static-top text-center">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>

            <span class="pe-7s-keypad"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- settings -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i><?php echo display('user_profile') ?></a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php echo display('change_password') ?></a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="pe-7s-key"></i><?php echo display('logout') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel text-center">
            <div class="image">
                <img src="<?php echo $users[0]['logo'] ?>" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <p><?php echo $this->session->userdata('user_name') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo display('online') ?></a>
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">

            <li class="<?php
            if ($this->uri->segment('1') == ("")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="<?php echo base_url() ?>" target="_blank"><i class="ti-dashboard"></i> <span>LIVE WEBSITE</span>
                    <span class="pull-right-container">
                        <span class="label label-success pull-right"></span>
                    </span>
                </a>
            </li>

            <!-- Category menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccategory")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="ti-tag"></i><span><?php echo display('category') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Ccategory') ?>"><?php echo display('add_category') ?></a></li>
                    <li><a href="<?php echo base_url('Ccategory/manage_category') ?>"><?php echo display('manage_category') ?></a></li>
                </ul>
            </li>
            <!-- Category menu end -->
            
            <!-- Product menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cproduct")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="ti-bag"></i><span><?php echo display('product') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cproduct') ?>"><?php echo display('add_product') ?></a></li>
                    <li><a href="<?php echo base_url('Cproduct/manage_product') ?>"><?php echo display('manage_product') ?></a></li>

                </ul>
            </li>
            <!-- Product menu end -->

            <!-- Brand menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cbrand")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="ti-bag"></i><span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cbrand') ?>">Add Brand</a></li>
                    <li><a href="<?php echo base_url('Cbrand/manage_brand') ?>">Manage Brand</a></li>

                </ul>
            </li>
            <!-- Brand menu end -->

            <!-- Brand menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccopun")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="ti-bag"></i><span>Copun</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Ccopun') ?>">Add Copun</a></li>
                    <li><a href="<?php echo base_url('Ccopun/manage_copun') ?>">Manage Copun</a></li>

                </ul>
            </li>
            <!-- Brand menu end -->

            <!-- Order menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Corder")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="ti-bag"></i><span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Corder') ?>">Manage Orders</a></li>

                </ul>
            </li>
            <!-- ORder menu end -->

            <!-- Asssistant menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Casssitant")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="fa fa-hands-helping"></i><span>Assistant</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cassistant') ?>">Add Asssitant</a></li>
                    <li><a href="<?php echo base_url('Cassistant/manage_assistant') ?>">Manage Assistant</a></li>

                </ul>
            </li>
            <!-- Asssitant menu end -->

            <!-- Asssistant menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cvalue")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="fa fa-cart-plus"></i><span>Value Cart</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cvalue') ?>">Add Value Cart</a></li>
                    <li><a href="<?php echo base_url('Cvalue/manage_value') ?>">Manage Value Cart</a></li>

                </ul>
            </li>
            <!-- Asssitant menu end -->

            <!-- Unit menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cunit")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="fa fa-balance-scale "></i><span>Unit</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cunit') ?>">Add Unit</a></li>
                    <li><a href="<?php echo base_url('Cunit/manage_unit') ?>">Manage Unit</a></li>

                </ul>
            </li>
            <!-- Unit menu end -->

            <!-- Unit menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Creport")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="#">
                    <i class="fas fa-file-contract"></i><span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Creport') ?>">Daily Report</a></li>

                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Creport/profit_margin_form') ?>">Profit Margin</a></li>

                </ul>
            </li>
            <!-- Unit menu end -->
            <!-- Site Setting menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Csettings")) {
                echo "active";
                } else {
                    echo " ";
                }
                ?>">
                <a href="javascript:void(0)">
                    <i class="fas fa-cog"></i><span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Csettings') ?>">Site Settings</a></li>

                </ul>
            </li>
            <!-- Site Setting menu end -->
    </ul>
</div> <!-- /.sidebar -->
</aside>
<script type="text/javascript">
    function getUrlVars(){
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }
</script>