
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
                    
                        <h3 class="title1">LANDS TO SUBDIVIDED</h3>
                       

                        <?php
                             include('dao/connect.php');
                            $statement = "SELECT * FROM `master_land` WHERE `master_land_id` NOT IN (SELECT DISTINCT (master_land.`master_land_id`) AS masters FROM `plots` LEFT OUTER JOIN master_land ON plots.`master_land_id`  = master_land.`master_land_id` 
ORDER BY purchase_date DESC) ORDER BY purchase_date DESC";
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
                                                        <td><a href="pdf_master_land.php" target="_blank"class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print PDF</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th> No.</th>
                                                    <th> Name </th>
                                                    <th> Location </th>
                                                    <th> Title No </th>
                                                    <th> Size</th>
                                                    <th> Purchase Date </th>
                                                    <th> Sub Divide </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 0;

                                                 while($row = $result->fetch_assoc()) {
                                                    $num++;
                                                    
                                                    echo "<tr class='record'>";
                                                    echo '<td align="right">' . $num . '</td>';
                                                    echo '<td style="font-family:Times; font-size: 80%;" >' . strtoupper(str_replace("&", "'", $row['name']))  . '</td>';
                                                    echo '<td style="font-family:Times; font-size: 80%;">' . strtoupper(str_replace("&", "'", $row['location']))  . '</td>';
                                                    echo '<td style="font-family:Times; font-size: 80%;">' . strtoupper($row['title_no']) . '</td>';
                                                    echo '<td style="font-family:Times; font-size: 80%;">' . strtoupper($row['size']) . '</td>';
                                                   
                                                    
                                                  
                                                    echo '<td style="font-family:georgia; font-size: 80%;">' . strtoupper($row['purchase_date']) . '</td>';
                                                    ?>
                                               
                                        <td>
                                           <div class="col-md-4 modal-grids">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal<?php echo $row['master_land_id'] ?>" data-whatever="@mdo">SUB DIVIDE</button>
						<div class="modal fade" id="exampleModal<?php echo $row['master_land_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="exampleModalLabel">SUB DIVIDE <?php echo strtoupper($row['name']) ?></h4>
                                                                        </div>
									<div class="modal-body">
                                                                            <form id="contact-form" action="save_subdivisions.php" name="catsform" method="post">
                                                                            <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="80%">
                                                                                
                                                                                <tr>
                                                                                    <td  width="50%">NO. OF UNITS</td>
                                                                                    <td  ><input type="text" id="newunits" name="newunits" class="inputFields" tabindex="5"  required autofocus />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  width="50%">DEFAULT SIZES</td>
                                                                                    <td  ><input type="text" id="newsize" name="newsize" class="inputFields"  required tabindex="5"  />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  width="50%">DEFAULT PRICE</td>
                                                                                    <td  ><input type="text" id="defaultprice" name="defaultprice" class="inputFields"  required tabindex="5"  />
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="alterCell">&nbsp&nbsp;</td>
                                                                                    <input type="text" hidden = "hidden" id="master_id" name="master_id" value="<?php echo $row['master_land_id'] ?>"  required tabindex="5"  />
                                                                                    <td  class="alterCell2"><input class="btn btn-primary" type="submit" value="Submit"/></td>
                                                                                </tr>
                                                                            </table>
                                                                           
                                                                        </form>
									</div>
									
								</div>
							</div>
						</div>
					</div> 
                                     </td>
                                                
                  
                                               
                                                    <?php
                                                        }
                                                        ?>
                                            </tbody>

                                        </table></td>
                                    </tr>
                                </table>
        <?php
    } else {
        echo 'No Un-Subdivided Master Land ';
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
