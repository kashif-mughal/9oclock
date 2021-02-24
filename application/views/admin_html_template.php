<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo (isset($title)) ? $title : "Online & Offline Inventory System" ?></title>
        <?php
        $CI = & get_instance();
        $CI->load->model('Web_settings');
        $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
        ?>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php
        if (isset($Web_settings[0]['logo'])) {
            echo $Web_settings[0]['favicon'];
        }
        ?>" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url() ?>assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url() ?>assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url() ?>assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url() ?>assets/dist/img/ico/apple-touch-icon-144-precomposed.png">
        <!-- Start Global Mandatory Style-->

        <!-- jquery-ui css -->
        <link href="<?php echo base_url() ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

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
        <!-- Font Awesome -->
        <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>assets/css/cmxform.css" rel="stylesheet" type="text/css"/>
        <!-- Themify icons -->
        <link href="<?php echo base_url() ?>assets/themify-icons/themify-icons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url() ?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- Data Tables -->
        <link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/dist/css/styleBD.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="<?php echo base_url() ?>assets/css/select2.sortable.css" rel="stylesheet" type="text/css"/>-->

        <?php
        if ($Web_settings[0]['rtr'] == 1) {
            ?>
            <!-- Theme style rtl -->
            <link href="<?php echo base_url() ?>assets/dist/css/styleBD-rtl.css" rel="stylesheet" type="text/css"/>
            <?php
        }
        ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>

        <!-- CKEditor 4 -->
        <script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>


        <!-- Date Time Picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/dateRangePicker/daterangepicker.css" />
        <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/dateRangePicker/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/dateRangePicker/daterangepicker.min.js"></script>
        

    </head>
    <body class="hold-transition sidebar-mini">



        <div class="se-pre-con"></div>

        <!-- Site wrapper -->
        <div class="wrapper">
            <?php
            $url = $this->uri->segment(2);
            if ($url != "login") {
                $this->load->view('include/admin_header');
            }
            ?>
            {content}
            <?php
            if ($url != "login") {
                $this->load->view('include/admin_footer');
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
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <!-- AdminBD frame -->
        <script src="<?php echo base_url() ?>assets/dist/js/frame.min.js" type="text/javascript"></script>
        <!-- Sparkline js -->
        <script src="<?php echo base_url() ?>assets/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
        <!-- Counter js -->
        <script src="<?php echo base_url() ?>assets/plugins/counterup/waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- dataTables js -->
        <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>

        <!-- Modal js -->
        <script src="<?php echo base_url() ?>assets/plugins/modals/classie.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/plugins/modals/modalEffects.js" type="text/javascript"></script>

        <!-- Dashboard js -->
        <script src="<?php echo base_url() ?>assets/dist/js/dashboard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url() ?>assets/js/html.sortable.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/select2.sortable.js" type="text/javascript"></script>-->
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>-->
        

        <script type="text/javascript">
            $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});

            $(document).ready(function() {
                $('.banner_image_list').sortable({
                    update: function() {
                        $(this).children().each(function(index) {
                            if($(this).attr('data-position') != (index)) {
                                $(this).attr('data-position', (index)).attr('updated');
                            }
                        });
                        UpdateNewPosition();
                    } // update
                }); // sortable

                CKEDITOR.replace('Description');

                $('.image_delete').click(function() {
                    var image_id = $(this).attr('data-index');
                    var x = confirm("Are You Sure,Want to Delete ?");
                    if (x == true) {
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url('Cbanner/image_delete'); ?>',
                            data: {id: image_id},
                            dataType: 'json',
                            // cache: false,
                            success: function (datas) {
                                console.log(datas);
                            },
                            error: function(error) {
                                console.log(error)
                            }
                        });
                    }
                }); 
            });

            function EditBannerImage(image_id) {debugger;
                var url= '<?php echo base_url('Cbanner/edit_image/'); ?>' + image_id;
                window.location = url;
            }

            function UpdateNewPosition() {
                var position = [];
                $('.banner_image_list img').each(function(index) { 
                    position.push({ 'image_id': $(this).attr('data-index'), 'image_order': index+1 });
                });

                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('Cbanner/update_image_list'); ?>',
                    data: {position: JSON.stringify(position)},
                    dataType: 'json',
                    // cache: false,
                    success: function (datas) {
                        console.log(datas);
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }

            document.querySelectorAll('.dropzone-input').forEach(inputElement => {
                const dropZoneElement = inputElement.closest('.dropzone');

                dropZoneElement.addEventListener("dragover", e => {
                    e.preventDefault();
                    dropZoneElement.classList.add("dropzone-over");
                });

                ["dragleave", "dragend"].forEach(type => {
                    dropZoneElement.addEventListener(type, e => {
                        dropZoneElement.classList.remove('dropzone-over');
                    });
                });

                dropZoneElement.addEventListener("drop", e => {
                    e.preventDefault();
                    if(e.dataTransfer.files.length) {
                        inputElement.files = e.dataTransfer.files;
                        console.log(inputElement.files);
                    }
                });
            });

            // -------------------------------

            $( function() {
                $( "#sortable-sss" ).sortable({
                    axis: 'y'
                });
                $('.uisort').on('listData', function() {
                    $('.llhome_page_cat_sss').find('option').remove();
                    $('.uisort').each(function() {
                        
                        $('.llhome_page_cat_sss').append($('<option>', { 
                            value: $(this).attr('data-id'),
                            text : $(this).attr('data-name')
                        }));
                        //$('.llhome_page_cat_sss').val($(this).attr('data-id'));
                        console.log($(this).attr('data-id')); 
                    });
                });
                                
                //$( "#sortable-sss" ).disableSelection();
              });
            
            
            

            $("#home_page_cat").select2({
                placeholder: 'Select a Category'
            }).on("select2:select", function (evt) {
                    var id = evt.params.data.id;
            
                    var element = $(this).children("option[value="+id+"]");
            
                    moveElementToEndOfParent(element);
            
                    $(this).trigger("change");
                });
            var ele=$("#home_page_cat").parent().find("ul.select2-selection__rendered");
            ele.sortable({
                containment: 'parent',
                update: function() {
                    orderSortedValues();
                    console.log(""+$("#home_page_cat").val())
                }
            });

            
            
            orderSortedValues = function() {
            var value = ''
                $("#home_page_cat").parent().find("ul.select2-selection__rendered").children("li[title]").each(function(i, obj){
            
                    var element = $("#home_page_cat").children('option').filter(function () { return $(this).html() == obj.title });
                    moveElementToEndOfParent(element)
                });
            };
            
            moveElementToEndOfParent = function(element) {
                var parent = element.parent();
            
                element.detach();
            
                parent.append(element);
            };
            /*$(function() {
            $('select#home_page_cat').select2Sortable();
            });*/
            
            
            // select 2 dropdown 
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });

            //Insert supplier
            $("#insert_supplier").validate();
            $("#validate").validate();

            //Update supplier
            $("#supplier_update").validate();

            //Update customer
            $("#customer_update").validate();

            //Insert customer
            $("#insert_customer").validate();

            //Update product
            $("#product_update").validate();

            //Insert product
            $("#insert_product").validate();

            //Insert pos invoice
            $("#insert_pos_invoice").validate();

            //Insert invoice
            $("#insert_invoice").validate();

            //Update invoice
            $("#invoice_update").validate();

            //Insert purchase
            $("#insert_purchase").validate();

            //Update purchase
            $("#purchase_update").validate();

            //Add category
            $("#insert_category").validate();

            //Update category
            $("#category_update").validate();

            //Stock report
            $("#stock_report").validate();

            //Stock report
            $("#stock_report_supplier_wise").validate();
            //Stock report
            $("#stock_report_product_wise").validate();

            //Create account
            $("#create_account_data").validate();

            //Update account
            $("#update_account_data").validate();

            //Inflow entry
            $("#inflow_entry").validate();

            //Outflow entry
            $("#outflow_entry").validate();

            //Tax entry
            $("#tax_entry").validate();

            //Update tax
            $("#update_tax").validate();

            //Account summary
            $("#summary_datewise").validate();
            //Comission generate
            $("#commission_generate").validate();

            $("#insert_sale_order").validate();
            
        </script>

    </body>
</html>