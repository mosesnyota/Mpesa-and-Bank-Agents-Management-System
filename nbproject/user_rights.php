
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
       
         <?php 
         
         include 'header2.php'; 
         require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];
         
         
         ?>
        
        
        
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

                            if (confirm("WARNING !!\n\nYou are about to delete this Staff\n\nDo you want to continue?")) {

                                window.location = "user_delete.php?id=" + id;
                                /* $.ajax({
                                 type: "GET",
                                 url: "delete_student_trans.php",
                                 data: info,
                                 success: function(){
             
                                 }
                                 });*/
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
                    
                        <h3 class="title1">Assign Rights to a given role</h3>
                       

                        <?php
                             include('dao/connect.php');
                            $statement = "SELECT * FROM staff_category";
                            $result = $db->query($statement);
                            $count  =1;
                            if ($count == 1 || $count > 1) {
                                ?>
                                <table class="borders" cellpadding="5" cellspacing="0" width="100%">
                                    <tr style="height:10px;">
                                        
                                    </tr>
                                    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th> No.</th>
                                                    <th> Role </th>
                                                    
                                                    <th> Assign Rights </th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 0;

                                                 while($row = $result->fetch_assoc()) {
                                                    $num++;
                                                    
                                                    echo "<tr class='record'>";
                                                    echo '<td align="right">' . $num . '</td>';

                                                    echo '<td>' . str_replace("&", "'", $row['role'])  . '</td>';
                                                    ?>
                                                    
                                                    <?php
                                                    
                                                   
                                                  
                                                    ?>
                                                <td><a href="assign_rights.php?id=<?php echo $row['role_id'] ?>" title="Assign rights"><i  <button type="button" class="btn btn-success btn-sm btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Assign Rights</button></a></td>
                                               
                                                
                                                    <?php
                                                        }
                                                        ?>
                                            </tbody>

                                        </table></td>
                                    </tr>
                                </table>
        <?php
    } else {
        echo 'There are no Registered Members';
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
