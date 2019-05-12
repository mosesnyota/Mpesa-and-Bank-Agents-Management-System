<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?>

<!DOCTYPE HTML>
<html>
    <head>
         
          <?php include 'page_header.php'; ?>
        
        <script type="text/javascript" language="javascript" src="dtable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="dtable/jquery-3.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="dtable/jquery.dataTables.min.css" />
     
        <script type="text/javascript" language="javascript" class="init">
                        
                        
                        $(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );

                    </script>
       
        
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

                                window.location = "delete_expense_type.php?id=" + id;
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
            <div class="main-page">
            <div class="forms">
					
					<div class="row">
						<h3 class="title1">DEFINE EXPENSES TYPES</h3>
                                                
                                              
                                                
                                                    <form class="form-horizontal" id="new_employee"   action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
							
								<div class="form-group">
									<label for="incomesource" class="col-sm-2 control-label">Expense Type</label>
									<div class="col-sm-8">
                                                                            <input type="text" name = "incomesource" class="form-control1" id="firstname" required>
									</div>
                                                                        
								</div>
                                                              <div class="form-group">
									<label for="description" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-8">
										<input type="text" name = "description" class="form-control1" id="middlename"  required>
									</div>
							      </div>
								
								<div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Save</button> </div>
								
								</div>
                                                    
							</form>
                                                    
                                                        <?php
	if(isset($_POST['incomesource'])  &&  isset($_POST['description']) ){
	require_once("dao/dbconnector.php");
	include('dao/connect.php');
	
        $expense_type= str_replace("'","&",$_POST['incomesource']); 
	$description= str_replace("'","&",$_POST['description']); 

	$qury="INSERT INTO `expense_types`(`expense_type`,`description`)VALUES ('$expense_type','$description')";
        
        
	$resultq = $db->query($qury);
        
	if(!$resultq){
	die('Invalid query: ' . mysqli_error($db));
	}else{
	
	
		echo "<script language=javascript>alert('Expense Type Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='expense_types.php' </script>";
	}
	}
	
?>
                                                        <?php
                             include('dao/connect.php');
                            $statement = "Select * from expense_types order by expense_type asc";
                            $result = $db->query($statement);
                            $count  =1;
                            
                                ?>
                                <table class="borders" cellpadding="5" cellspacing="0" width="100%">
                                    <tr style="height:10px;">
                                        
                                    </tr>
                                    <td><table id="example"  name="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th> No.</th>
                                                    <th> Expense Type </th>
                                                    <th> Description </th>
                                                   
                                                    <th> Edit </th>
                                                    <th> Delete </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 0;

                                                 while($row = $result->fetch_assoc()) {
                                                    $num++;
                                                    
                                                    echo "<tr class='record'>";
                                                    echo '<td align="right">' . $num . '</td>';

                                                    echo '<td>' . str_replace("&", "'", $row['expense_type'])   . '</td>';
                                                    
                                                    echo '<td>' . str_replace("&", "'", $row['description']) . '</td>';
                                                  
                                                   
                                                  
                                                    ?>
                                               <td><a href="edit_expensetype.php?id=<?php echo $row['expense_type_id'] ?>" title="Click to edit expense type"><i  <button type="button" class="btn btn-success hvr-icon-float-away btn-sm btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Edit</button></a></td>
                                                <td> <a href="#" onclick="return WarningDelete(<?php echo $row['expense_type_id'] ?>);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"><i class="fa fa-plus" aria-hidden="true"></i> Delete</button></i></a></td>		
                                                    
                                                
                                                    <?php
                                                        }
                                                        ?>
                                            </tbody>

                                        </table></td>
                                    </tr>
                                </table>
						</div>
					</div>
           </div>
</div>
    <!--footer-->
    <?php include 'footer.php'; ?>
    <!--//footer-->
</div>
<?php include 'toggle.php'; ?>
</body>
</html>