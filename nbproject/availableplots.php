<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
       
         <?php include 'header2.php'; ?>
        
        
        
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

                            if (confirm("WARNING !!\n\nYou are about to delete this Plot's Record\n\nDo you want to continue?")) {

                                window.location = "delete_plot.php?id=" + id;
                                
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
            <?php include 'left_nav.php'; ?>

            <!-- header-starts -->
            <?php include 'top_panel.php'; ?>
            <!-- //header-ends -->
            <!-- main content start-->
            
            <div id="page-wrapper">
                 <div id="blocker">
                            <div><img src="images/loading.gif" />Loading...</div>
                        </div>
             <div class="main-page">  
                 <div  class="activity_box activity_box2">
                    
                        <h3 class="title1">All Available Plots</h3>
                       

                        <?php
                             include('dao/connect.php');
                            $statement = "SELECT plots.*, master_land.`name`,master_land.`location` FROM `plots`
JOIN master_land ON plots.`master_land_id` = master_land.`master_land_id`
 WHERE `cur_status` ='Available' ORDER BY `master_land_id` ASC,`plot_num` ASC";
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
                                                        <td><a href="pdf_available_plots.php" target="_blank"class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print PDF</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th> No.</th>
                                                    <th> Parcel </th>
                                                    <th> Location </th>
                                                    <th> Plot No. </th>
                                                    <th> Beacon No. </th>
                                                    <th> Size</th>
                                                    <th> Price </th>
                                                    <th> Edit </th>
                                                    <th> Delete </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 0;
                                              
                                                

                                                 while($row = $result->fetch_assoc()) {
                                                    $num++;
                                                    $master_land_id = $row['master_land_id'];
                                                    
                                                    
                                                    
                                                    echo "<tr class='record'>";
                                                    echo '<td align="right">' . $num . '</td>';
                                                    echo '<td>' . str_replace("&", "'", $row['name'])  . '</td>';
                                                    echo '<td>' . str_replace("&", "'", $row['location'])  . '</td>';
                                                    echo '<td>' . $row['plot_num'] . '</td>';
                                                    echo '<td>' . $row['beacon_no'] . '</td>';
                                                    echo '<td>' . $row['size'] . '</td>';
                                                    echo '<td>' . "Ksh. ".number_format($row['set_price'],2,".",",") . '</td>';
            
                                                    ?>
                                               
                                                 <td><a href="editplot.php?id=<?php echo $row['plot_id'] ?>" title="Click to Edit Plot Details"><i  <button type="button" class="btn btn-success  btn-sm"><i class="fa fa-edit" ></i> Edit</button></a></td>
                                                 <td> <a href="#" onclick="return WarningDelete(<?php echo $row['plot_id'] ?>);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"> Delete</button></i></a></td>		
                                                 
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
           <?php include 'footer.php'; ?>
<?php include 'toggle.php'; ?>
    </body>
                    </html>
