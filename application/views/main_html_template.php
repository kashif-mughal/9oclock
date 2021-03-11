<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo (isset($title)) ? $title : "9o'Clock" ?></title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css"> -->
        <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"> -->
        
        <!-- Custom Styles -->
        <link href="<?php echo base_url() ?>assets/css/style.css?v=2" rel="stylesheet" type="text/css"/>
        <!-- <link rel="stylesheet" href="css/style.css"> -->

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link href="<?php echo base_url() ?>assets/css/slick.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>assets/css/slick-theme.css" rel="stylesheet" type="text/css"/>
        <?php
        $CI = & get_instance();
        $CI->load->model('Web_settings');
        $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
        $data['Web_settings'] = $Web_settings;
        $data['BannerImages'] = $BannerImages;
        if(isset($Page)) {
            $data['PageName'] = $Page;
        }
        else {
            $data['PageName'] = '';
        }
        ?>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php
        if (isset($Web_settings[0]['logo'])) {
            echo $Web_settings[0]['favicon'];
        }
        ?>" type="image/x-icon">
        
        <!-- jquery-ui css -->
        <link href="<?php echo base_url() ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

        <!-- modals css -->
        <link href="<?php echo base_url() ?>assets/plugins/modals/component.css" rel="stylesheet" type="text/css"/>
        <?php
        if ($Web_settings[0]['rtr'] == 1) {
            ?>
            <!-- Bootstrap rtl -->
            <link href="<?php echo base_url() ?>assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <?php
        }
        ?>
        <!-- Themify icons -->
        <link href="<?php echo base_url() ?>assets/themify-icons/themify-icons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url() ?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- Data Tables -->
        <link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-3.5.1.min.js" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script> -->
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/notify.min.js" type="text/javascript"></script>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="se-pre-con"></div>

        <!-- Site wrapper -->
        <div class="wrapper">
            <?php
            $url = $this->uri->segment(2);
            if ($url != "login") {
                $this->load->view('include/header', $data);
            }
            
            ?>
            {content}
            <?php
            if ($url != "login") {
                $this->load->view('include/footer', $data);
            }
            ?>
        </div>
        <!-- ./wrapper -->

        <!-- Start Core Plugins-->
        <!-- jquery-ui --> 
        <script src="<?php echo base_url() ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url() ?>assets/js/popper.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- dataTables js -->
        <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables4.min.js" type="text/javascript"></script>

        <!-- Modal js -->
        <script src="<?php echo base_url() ?>assets/plugins/modals/classie.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/plugins/modals/modalEffects.js" type="text/javascript"></script>

        <!-- Dashboard js -->
        <script src="<?php echo base_url() ?>assets/dist/js/dashboard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/js/silck.js" type="text/javascript"></script>
        <!-- Custom Script -->
        <script src="<?php echo base_url() ?>assets/js/script.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});

            // select 2 dropdown 
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });

            // $("#insert_sale_order").validate();
            $("img").on("error", function() {
             $(this).attr(
               "src",
               "<?=base_url('assets/img/product.png')?>"
             );
           });
        </script>
        <style type="text/css">
            #toTop{
                width: 44px;
                background: green;
                padding: 10px;
                border-radius: 100%;
                color: white;
                font-weight: bolder;
                position: fixed;
                bottom: 0px;
                right: 0px;
                margin-bottom: 20px;
                margin-right: 20px;
            }
        </style>
    </body>
</html>