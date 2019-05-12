
<!DOCTYPE HTML>
<html>
    <head></head>
    <?php include 'page_header.php'; require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];?>
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
						<h3 class="title1">Master Land Details</h3>
                                                <form class="form-horizontal" id="new_employee"  action="master_land_update.php" name="newproject" method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
                                                                
                                                        <?php   
                                                        if(isset($_GET['id'])){
                                                       $id = $_GET['id']; 
                                                    }
                                                    
                                                    $qry = "SELECT * FROM master_land WHERE master_land_id ='$id'";
                                                    include('dao/connect.php');
                                                    $result = $db->query($qry);
                                                    
                                                     while($row = $result->fetch_assoc()) {
                                                    
                                                        ?>
                                                        
                                                    
                                                    
								<div class="form-group">
									<label for="landname" align="left" class="col-sm-2 control-label">Land Name</label>
									<div class="col-sm-8">
                                                                        <input type="text" name = "landname" class="form-control1" id="landname" value="<?php echo $row['name'] ?>" required>
									</div>
									
								</div>
                                                              <div class="form-group">
									<label for="location" align="left" class="col-sm-2 control-label">Location</label>
									<div class="col-sm-8">
									<input type="text" name = "location" class="form-control1" id="location"  value="<?php echo $row['location'] ?>"  required>
									</div>
									
							      </div>
								<div class="form-group">
									<label for="titleno" align="left" class="col-sm-2 control-label">Title No</label>
									<div class="col-sm-8">
									<input  type="text" name = "titleno" class="form-control1" id="titleno"   value="<?php echo $row['title_no'] ?>" >
									</div>
								</div>
                                                                <div class="form-group">
									<label for="size" class="col-sm-2 control-label">Land Size</label>
									<div class="col-sm-8">
									<input  type="text" name = "size" class="form-control1" id="size"   value="<?php echo $row['size'] ?>"  required>
									</div>
								</div>
                                                            
								 
                                                            
                                                             <div class="form-group">
									<label for="holder" class="col-sm-2 control-label">Holder Name</label>
									<div class="col-sm-8">
									<input  type="text" name = "holder" class="form-control1" id="holder"    value="<?php echo $row['registered_holder'] ?>" >
									</div>
							     </div>
                                                    
                                                            <div class="form-group">
									<label for="holder_id" class="col-sm-2 control-label">Holder ID</label>
									<div class="col-sm-8">
									<input  type="text" name = "holder_id" class="form-control1" id="holder_id"    value="<?php echo $row['holder_id'] ?>" >
									</div>
							     </div>
                                                             <div class="form-group">
									<label for="holder_kra" class="col-sm-2 control-label">Holder KRA</label>
									<div class="col-sm-8">
									<input  type="text" name = "holder_kra" class="form-control1" id="holder"    value="<?php echo $row['holder_kra'] ?>" >
									</div>
							     </div>
                                                    
                                                             <div class="form-group">
									<label for="holder_phone" class="col-sm-2 control-label" >Holder Phone</label>
									<div class="col-sm-8">
									<input  type="text" name = "holder_phone" class="form-control1" id="holder_phone"    value="<?php echo $row['holder_phone'] ?>" >
									</div>
							     </div>
                                                              
                                                                <div class="form-group">
									<label for="status" class="col-sm-2 control-label">Current Status</label>
									<div class="col-sm-8"><select name="status" id="status" class="dropdown-content">
                                                                                <option value="<?php echo $row['status'] ?>" > <?php echo $row['status'] ?> </option>
                                                                                <option value="pending">Awaiting Subdivision</option>
										<option value="subdivided">Subdivided</option>
										<option value="sold">Fully Sold</option>
									</select></div>
								</div>
                                                  
                                                                
                                                    
                                                                <div class="form-group">
									<label for="purchase_price" class="col-sm-2 control-label">Purchase Price</label>
									<div class="col-sm-8">
										<input  type="text" name = "purchase_price" class="form-control1" id="purchase_price"    value="<?php echo $row['purchase_price'] ?>" >
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
