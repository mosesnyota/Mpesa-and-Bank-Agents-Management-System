
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <?php include 'header3.php'; ?>
        <script type="text/javascript" language="javascript" class="init">
                        $(document).ready(function () {
                            $('#example').dataTable({
                                "columnDefs": [
                                    {
                                    },
                                ]
                            });
                        });
                        String.prototype.parseURL = function () {
                            return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function (url) {
                                return url.link(url);
                            });
                        };

                        printDivCSS = new String('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
                        function printDiv(divId) {
                            window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById(divId).innerHTML
                            window.frames["print_frame"].document.body.style.fontSize = "11px";
                            window.frames["print_frame"].window.focus()
                            window.frames["print_frame"].window.print()
                        }
                        
                        function WarningDelete(id) {

                            if (confirm("WARNING !!\n\nYou are about to delete this Land Record\n\nDo you want to continue?")) {

                                window.location = "delete_master_land.php?id=" + id;
                                
                            } else {
                                return false;
                            }
                        }

                    </script>
                    <script type='text/javascript'>//<![CDATA[ 
                        $(window).load(function () {
                            setTimeout(function () {
                                $("#blocker").hide();
                            }, 1000);

                        });//]]>  

                    </script>
        
       
                    </head>
    
    
       <body class="cbp-spmenu-push">
        <div class="main-content">
      
            <!--left-fixed -navigation-->
           <?php
                             include('dao/connect.php');
                             
                             function getTypePay($id){
                                 include('dao/connect.php');
                                 $qey = "SELECT `expense_type` FROM `expense_types` WHERE `expense_type_id` = '$id'";
                             $result = $db->query($qey);
                                  while ($row = $result->fetch_assoc()) {
                                      return $row['expense_type'];
                                  }
                             }
                             ?>

            <!-- header-starts -->
            
            <!-- //header-ends -->
            <!-- main content start-->
            
            <div id="page-wrapper">
                 <div id="blocker">
                            <div><img src="images/loading.gif" />Loading...</div>
                        </div>
             <div class="main-page">  
                 <div  class="activity_box activity_box2">
                    
                        <?php
                             include('dao/connect.php');
                             
                            
                            
                             if(isset($_GET['masterland']) ){
                                 $master = $_GET['masterland'];
                                 $statement = "SELECT payment_type, `name`,`location`,`plot_num`,`others`,`reference`,`mode`,`amount`,`date_of_pay`, `idno`,`first_name`,`middle_name` FROM `member`
JOIN `payments` ON member.`member_id` = payments.`member_id` JOIN `plots` ON `payments`.`plot_id` = plots.`plot_id` 
JOIN `master_land` ON plots.`master_land_id` = `master_land`.`master_land_id` where  `master_land`.`master_land_id`='$master' order by date_of_pay";
                             
                             }else{
                                 $statement = "SELECT payment_type, `name`,`location`,`plot_num`,`others`,`reference`,`mode`,`amount`,`date_of_pay`, `idno`,`first_name`,`middle_name` FROM `member`
JOIN `payments` ON member.`member_id` = payments.`member_id` JOIN `plots` ON `payments`.`plot_id` = plots.`plot_id` 
JOIN `master_land` ON plots.`master_land_id` = `master_land`.`master_land_id` order by date_of_pay";
                                 }
                             
                            $result = $db->query($statement);
                            $count = mysqli_num_rows ( $result );
                            if ($count > 0) {
                                ?>
                                <table class="borders" cellpadding="5" cellspacing="0" width="100%">
                                    <tr style="height:30px;">
                                        <td class="dataListHeader">
                                            <div style="float:right; margin-right:20px; width:10%">

                                                <table align="right" width="100%" >
                                                    <tr>
                                                        <?php 
                                                            if(isset($_GET['masterland']) ){
                                                            ?>
                                                        <td><a href="pdf_payment_report.php?id= <?php echo $master; ?>" target="_blank"class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print PDF</a></td>
                                                            <?php } else { ?>
                                                    <td><a href="pdf_payment_report.php" target="_blank"class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print PDF</a></td>
                                                          <?php }  ?> 
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                     <tr style="height:10px;"></tr>
                                    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" height="100%">
                                            <thead>
                                                <tr>
                                                    <th> No.</th>
                                                    <th> Expense Type </th>
                                                    <th> Parcel </th>
                                                    <th> Date</th>
                                                    <th> Amount </th>
                                                    <th> Mode </th>
                                                    <th> Reference </th>
                                                    <th> Paid By </th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <?php
                                                    $num = 0;

                                                    while ($row = $result->fetch_assoc()) {
                                                        $num++;
                                                        $payment_mode = $row['mode'];
                                                        if ($payment_mode == 'cash') {
                                                            $payment_mode = "Cash";
                                                        } else if ($payment_mode == 'mpesa') {
                                                            $payment_mode = "Mpesa";
                                                        } else if ($payment_mode == 'cheque') {
                                                            $payment_mode = "Cheque";
                                                        } else if ($payment_mode == 'transfer') {
                                                            $payment_mode = "Bank Transfer";
                                                        } else if ($payment_mode == 'deposit') {
                                                            $payment_mode = "Direct Deposit";
                                                        } else if ($payment_mode == 'others') {
                                                            $payment_mode = "Other Means";
                                                        }

                                                        echo "<tr class='record'>";
                                                        echo '<td align="right">' . $num . '</td>';
                                                        echo '<td>' . str_replace("&", "'", getTypePay($row['payment_type'])) . '</td>';
                                                        echo '<td>' . str_replace("&", "'", $row['name'].", Plot No: ". $row['plot_num']) . '</td>';
                                                     
                                                    echo '<td>' . date_format(date_create($row['date_of_pay']),"d-m-Y") . '</td>';
                                                    echo '<td>' . number_format($row['amount'],2) . '</td>';
                                                    echo '<td>' . $payment_mode . '</td>';
                                                    echo '<td>' . $row['reference'] . '</td>';
                                                     echo '<td>' . $row['first_name'] ."  ".$row['middle_name']. '</td>';
                                                    ?>
                                               
                                                
                                                
                                                    <?php
                                                        }
                                                        ?>
                                            </tbody>

                                        </table></td>
                                    </tr>
                                </table>
        <?php
    } else {
        echo 'No Master Land Registered';
    }

?>

                        <!--end of display area. 
                        This area changes when a user searches for an item-->
                        <script type="text/javascript">
                            $(function () {


                                $(".delbutton").click(function () {

                        //Save the link in a variable called element
                                    var element = $(this);

                        //Find the id of the link that was clicked
                                    var del_id = element.attr("id");

                        //Built a url to send
                                    var info = 'id=' + del_id;
                                    if (confirm("You are about to delete this Student Details.\n\n Do you Want to Continue?"))
                                    {

                                        $.ajax({
                                            type: "GET",
                                            url: "delete_student_trans.php",
                                            data: info,
                                            success: function () {

                                            }
                                        });
                                        $(this).parents(".record").animate({backgroundColor: "#fbc7c7"}, "fast")
                                                .animate({opacity: "hide"}, "slow");
                                        //alert('Deletion Successful');

                                    }

                                    return false;

                                });

                            });
                        </script>
                       </div> 
             </div>        
    </div>
                        <!--footer-->

            <!--//footer-->
        </div>
          
<?php include 'toggle.php'; ?>
    </body>
                    </html>
