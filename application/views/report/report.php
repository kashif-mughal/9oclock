<!-- Manage Category Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Daily Reports</h1>
            <small>View Daily Report</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="#">Report</a></li>
                <li class="active">Daily Report</li>
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

        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="pull-left" style="margin-top: 6px;">Daily Report</h4>
                            <a href="javascript:void(0)" class="btn btn-success text-white pull-right" onclick="printDiv('receipt-content');"><i class="fa fa-print"></i>
                                &nbsp; Print Report
                            </a>
                            <a href="javascript:void(0)" class="btn btn-info pull-right text-white" id="ExportReport" style="margin-right: 10px;">
                                <i class="fas fa-file-export"></i>
                                Export CSV
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div>
                                    <div class="form-group form-inline pull-left">
                                        <label for="reportBy">Range :</label>
                                        <?php 
                                            $todays_date = date("d/m/Y");
                                         ?>
                                        <input type="text" name="daterange" id="daterange" class="form-control form-inline" 
                                            value="<?php echo $todays_date. ' - ' .$todays_date ?>" style="width: 300px;" />
                                    </div>
                                </div>    
                                <div class="pull-right">
                                    <div class="form-group form-inline pull-left">
                                      <label for="reportBy">Report By:</label>
                                      <select class="form-control" id="reportBy" style="width:150px;">
                                        <option>Products</option>
                                        <option>Orders</option>
                                      </select>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary pull-left" id="generateReport" style="margin-left: 10px; margin-bottom: 14px;">
                                        <i class="fas fa-sync"></i>
                                        Generate
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                        <div class="table-responsive">
                            <table id="DailyReportsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th class="text-left" id="headerCol1">Product Id</th>
                                        <th class="text-center" id="headerCol2">Product Name</th>
                                        <th class="text-right" id="headerCol3">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody id="daily_report_body">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Area -->

        <div class="row" style="display: none;">
            <div class="col-md-12">
                <div id="receipt-content">
                    <div style="width: 60%; margin: 0 auto; margin-top: 100px;">
                        <style type="text/css">
                            .styl-center {
                                text-align: center;
                                width: 40%;
                            }
                            .styl-ten {
                                width: 10% !important;
                            }
                            .styl-fifty {
                                width: 40% !important;
                            }
                            .styl-left {
                                text-align: left;
                                width: 25%;
                            }
                            .styl-right {
                                text-align: right;
                                width: 25%;
                            }
                            .styl-inline {
                                display: table-cell;
                                vertical-align: top;
                            }
                        </style>
                        <div>
                            <div class="styl-inline" style="width: 20%;">
                                <p style="font-size: 12px;">
                                    <script>
                                        var siteInfo = `<?php if (isset($Web_settings[0]['footer_text'])) { echo $Web_settings[0]['footer_text']; }?>`;
                                        var elem = document.createElement('div');
                                        elem.innerHTML = siteInfo;
                                        document.write(elem.innerText.trim());
                                    </script>
                                </p>
                            </div>
                            <div class="styl-inline" style="width: 60%;text-align: center;font-weight: 500;font-size: 30px;">
                                DAILY REPORT
                            </div>
                            <div class="styl-inline" style="width: 20%; text-align: right;">
                                <img style="background-color: #25bfa9;border-radius: 200px;" src="<?php echo base_url() ?>assets/img/logo.png">
                            </div>
                        </div>
                        <div style="width: 70%;">
                            <h3 style="font-size: 17px;" id="printReportType">Products</h3> 
                            <h3 style="font-size: 17px;" id="printReportDate">
                                Date: (<span class="reportStartDate">Start Date</span>) to (<span class="reportEndDate">End Date</span>)
                            </h3>
                        </div>
                        <div style="min-height: 400px;">
                            <table style="width: 100%;" id="printReportTable">
                                <thead>
                                    <tr style="border-top: 2px solid #008000;border-bottom: 2px solid #008000;font-weight: 500;">
                                        <td class="styl-left styl-ten">SL#</td>
                                        <td class="styl-left styl-fifty" id="printhead1">Product Id</td>
                                        <td class="styl-center" id="printhead2">Product Name</td>
                                        <td class="styl-right" id="printhead3">Total Price</td>
                                    </tr>
                                </thead>
                                <tbody id="printReportTableBody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Area End -->

    </section>
</div>
<!-- Manage Category End -->

<!-- Delete Category ajax code -->
<script type="text/javascript">
    var startDate = "";
    var endDate = "";
    var haveData = false;
    // Date Range
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }
      }, function(start, end, label) {
        startDate = start.format('YYYY-MM-DD');
        endDate = end.format('YYYY-MM-DD');
      });
    });

    $('#daterange').on('apply.daterangepicker',function(ev, picker) {
        startDate = picker.startDate.format('YYYY-MM-DD');
        endDate = picker.endDate.format('YYYY-MM-DD');

        $('.reportStartDate').text(startDate);
        $('.reportEndDate').text(endDate);
    });

    $(document).ready(function() { // Document Ready Start
        var today = new Date();
        startDate = today.getDate() + '-' + (today.getMonth()+1) + '-' + today.getFullYear();
        endDate = today.getDate() + '-' + (today.getMonth()+1) + '-' + today.getFullYear();

        filltable('Products');

        $('#ExportReport').click(function() {
            if(haveData) {
                exportTableToCSV.apply(this, [$('#DailyReportsTable'), 'export.csv']);
                windows.location.reload();
            }
        });

        function exportTableToCSV($table, filename) {
    
            var $rows = $table.find('tr:has(td),tr:has(th)'),
        
                // Temporary delimiter characters unlikely to be typed by keyboard
                // This is to avoid accidentally splitting the actual contents
                tmpColDelim = String.fromCharCode(11), // vertical tab character
                tmpRowDelim = String.fromCharCode(0), // null character
        
                // actual delimiter characters for CSV format
                colDelim = '","',
                rowDelim = '"\r\n"',
        
                // Grab text from table into CSV formatted string
                csv = '"' + $rows.map(function (i, row) {
                    var $row = jQuery(row), $cols = $row.find('td,th');
        
                    return $cols.map(function (j, col) {
                        var $col = jQuery(col), text = $col.text();
        
                        return text.replace(/"/g, '""'); // escape double quotes
        
                    }).get().join(tmpColDelim);
        
                }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"',
        
                // Data URI
                csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                
                
              if (window.navigator.msSaveBlob) { // IE 10+
                //alert('IE' + csv);
                window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
              } 
              else {
                jQuery(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
              }
        }
    }); // Document Ready Ends

    // Get Data by product
    $("#generateReport").click(function(e) {
        e.preventDefault();
        var reportType = $("#reportBy").val();
        $("#daily_report_body").empty();
        $('#printReportTableBody').empty();

        filltable(reportType);
    });

    function filltable(reportType) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('Creport/generate_report') ?>',
            data: {Report_Type: reportType, start_date: startDate, end_date: endDate},
            dataType: "json",
            cache: false,
            success: function(data) {
                var content = "";
                var reportContent = "";
                var grand_total = 0;
                $('#printReportType').text(reportType);
                if(reportType == 'Products') {
                    $('#headerCol1').text('Product Id');
                    $('#headerCol2').text('Product Name');
                    $('#headerCol3').text('Total Price');
                    $('#printhead1').text('Product Id');
                    $('#printhead2').text('Product Name');
                    $('#printhead3').text('Total Price');   
                    for(i = 0; i < data.length; i++) {
                        grand_total += parseInt(data[i].total_price);
                        content += `<tr>
                                        <td>${i+1}</td>
                                        <td class="text-left">${data[i].ItemId}</td>
                                        <td class="text-center">${data[i].ProductName}</td>
                                        <td class="text-right">${data[i].total_price}</td>
                                    </tr>`;
                    }
                    reportContent = content;
                    content += `<tr>
                                <td colspan="3" class="text-right"><b>Grand Total</b></td>
                                <td class="text-right"><b>${grand_total}</b></td>
                            </tr>`;
                    reportContent += `<tr style="border-top: 2px solid #008000">
                                        <td colspan="3" class="text-right"><b>Grand Total</b></td>
                                        <td class="text-right"><b>${grand_total}</b></td>
                                    </tr>`;
                    haveData = true;
                }
                else if(reportType == 'Orders') {
                    $('#headerCol1').text('Order Id');
                    $('#headerCol2').text('Customer');
                    $('#headerCol3').text('Total Amount');
                    $('#printhead1').text('Order Id');
                    $('#printhead2').text('Customer');
                    $('#printhead3').text('Total Amount');
                    for(i = 0; i < data.length; i++) {
                        grand_total += parseInt(data[i].OrderValue);
                        content += `<tr>
                                        <td>${i+1}</td>
                                        <td class="text-center">${data[i].OrderId}</td>
									    <td class="text-center">${data[i].email +" Phone :"+ data[i].phone + " Add :" + data[i].address} </td>
                                        <td class="text-right">${data[i].OrderValue}</td>
                                    </tr>`;
                    }
                    reportContent = content;
                    content += `<tr>
                                <td colspan="3" class="text-right"><b>Grand Total</b></td>
                                <td class="text-right"><b>${grand_total}</b></td>
                            </tr>`;                    
                    reportContent += `<tr style="border-top: 2px solid #008000">
                                    <td colspan="3" class="text-right"><b>Grand Total</b></td>
                                    <td class="text-right"><b>${grand_total}</b></td>
                                </tr>`;
                    haveData = true;
                }
                else {
                    haveData = false;
                    content = "No Record Found";
                }
                
                // Final Append
                $('#DailyReportsTable').append(content);
                $('#printReportTable').append(reportContent);
                content = "";
            },
            error: function(data) {
                console.log(error);
            }
        });

    }


    // Print Report
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        var tempTitle = document.title;
        document.title = "Daily_Report_"+startDate+"-"+endDate;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        document.title = tempTitle;
    }

</script>
