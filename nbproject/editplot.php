<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?>
<!DOCTYPE HTML>
<html>
    <head></head>
    <?php include 'page_header.php'; ?>
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
					
					<div class="activity_box activity_box2">
						<h3 class="title1">Plot Details</h3>
                                                <form class="form-horizontal" id="new_employee"  action="plot_update.php" name="newproject" method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
                                                                
                                                        <?php   
                                                        if(isset($_GET['id'])){
                                                       $id = $_GET['id']; 
                                                    }
                                                    
                                                    $qry = "SELECT `name`,`location`,`master_land`.`title_no` , plots.* FROM `master_land` JOIN plots ON `master_land`.`master_land_id` = plots.`master_land_id` WHERE plots.plot_id ='$id'";
                                                    include('dao/connect.php');
                                                    $result = $db->query($qry);
                                                     while($row = $result->fetch_assoc()) {
                                                    
                                                        ?>
                                                        
                                                                 <div class="form-group">
									<label for="masterland" class="col-sm-2 control-label" >Master Land</label>
									<div class="col-sm-8">
                                                                            <input  type="text" style="font-size: 100%" disabled="disabled" name = "masterland" class="form-control1" id="holder_phone"    value="<?php echo "Land: ".$row['name'].", Location: ".$row['location'].", Master Title: ".$row['title_no'] ?>" >
									</div>
							     </div>
                                                    
								<div class="form-group">
									<label for="plot_num" align="left" class="col-sm-2 control-label">Plot Number</label>
									<div class="col-sm-8">
                                                                        <input type="text" name = "plot_num" class="form-control1" id="landname" value="<?php echo $row['plot_num'] ?>" required>
									</div>
									
								</div>
                                                              <div class="form-group">
									<label for="size" align="left" class="col-sm-2 control-label">Size</label>
									<div class="col-sm-8">
									<input type="text" name = "size" class="form-control1" id="location"  value="<?php echo $row['size'] ?>"  required>
									</div>
							      </div>
								<div class="form-group">
									<label for="titleno" align="left" class="col-sm-2 control-label">Title No</label>
									<div class="col-sm-8">
									<input  type="text" name = "titleno" class="form-control1" id="titleno"   value="<?php echo $row['title_no'] ?>" >
									</div>
								</div>
                                                                <div class="form-group">
									<label for="set_price" class="col-sm-2 control-label">Selling Price</label>
									<div class="col-sm-8">
									<input  type="text" name = "set_price" class="form-control1" id="size"   value="<?php echo $row['set_price'] ?>"  required>
									</div>
								</div>
                                                            
                                                     <?php  } ?>
                                                    <input  hidden="hidden" type="text" name = "id" class="form-control1" id="id"    value="<?php echo $id ?>" >
								<div class="col-sm-offset-4"> <button type="submit" class="btn btn-success">Save</button> </div>
								
								</div>
                                                    
							</form>
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
