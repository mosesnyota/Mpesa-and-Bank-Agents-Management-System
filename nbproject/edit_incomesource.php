<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?><!DOCTYPE HTML>
<html>
    <head>
         
          <?php 
          
           if(isset($_GET['id'])){
               $myid = $_GET['id'];
              
           }
          include 'page_header.php'; 
          
          ?>
        
        <script type="text/javascript" language="javascript" src="dtable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="dtable/jquery-3.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="dtable/jquery.dataTables.min.css" />
     
        <script type="text/javascript" language="javascript" class="init">
                        
                        
                        $(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );

function WarningDelete(id) {
        if (confirm("WARNING !!\n\nYou are about to delete this Member\n\nDo you want to continue?")) {
                window.location = "member_delete.php?id=" + id;
            } else {
                    return false;
            }
        }

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
						<h3 class="title1">EDIT INCOME TYPE</h3>
                                                
                                              
                                                
                                                    <form class="form-horizontal" id="new_employee"   action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
                                                    
                                                    <?PHP  
                                                    
                                                   
                                                     include('dao/connect.php');
                            if(isset($_GET['id'])){
                                  $myid = $_GET['id'];
                            $statement = "SELECT * FROM `income_sources` WHERE `source_id` ='$myid' ";
                            $result = $db->query($statement);
                                                    while($row = $result->fetch_assoc()) {
                            
                                                     
                                                   
                                                    
                                                    ?>
							
								<div class="form-group">
									<label for="incomesource" class="col-sm-2 control-label">Income Source</label>
									<div class="col-sm-8">
                                                                            <input type="text" name = "incomesource" class="form-control1" id="firstname" value="<?php echo $row['source_name']?>" required>
									</div>
                                                                        
								</div>
                                                              <div class="form-group">
									<label for="description" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-8">
										<input type="text" name = "description" class="form-control1" id="middlename" value="<?php echo $row['description']?>" required>
									</div>
							      </div>
                                                    <input type="hidden" name = "myid" class="form-control1" id="myid" value="<?php echo $row['source_id']?>" >
                                                    <?php }}?>
                                                                
								<div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Save</button> </div>
								
								</div>
                                                    
							</form></div>
					</div>
           </div>
</div>
            
            <?php
	if(isset($_POST['incomesource'])  &&  isset($_POST['description']) ){
	require_once("dao/dbconnector.php");
	include('dao/connect.php');
	$name=$_POST['incomesource'];
	$acctname=$_POST['description'];
	$myid = $_POST['myid'];
	
	$qury="UPDATE income_sources SET source_name = '$name', description='$acctname' WHERE source_id='$myid'";
	$resultq = $db->query($qury);
        
	if(!$resultq){
	die('Invalid query: ' . mysqli_error($db));
	}else{
	
	
		echo "<script language=javascript>alert('Income Type Updated Successfuly') </script>";
		echo "<script language=javascript>window.location='income_sources.php' </script>";
	}
	}
	
?>
            
    <!--footer-->
    <?php include 'footer.php'; ?>
    <!--//footer-->
</div>
<?php include 'toggle.php'; ?>
</body>
</html>