<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?><!DOCTYPE HTML>
<html>
    <?php include 'page_header.php'; ?>

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

                                            <?php
                                            $id ='';
                                            
                                            if(isset($_GET['id'])){
                                          
                                            $id = $_GET['id'];
                                            }
                                            function getRole($id1) {
                                                include('dao/connect.php');
                                                $statement = "SELECT * FROM staff_category where role_id = '$id1'";
                                                $result = $db->query($statement);

                                                while ($row = $result->fetch_assoc()) {
                                                    $roled = $row['role'];
                                                }
                                                return $roled;
                                            }
                                            
                                            function getApprovalStatus($id,$fileid){
                                                 include('dao/connect.php');
                                                $qry = "SELECT `approved` FROM `file_rights` WHERE `role_id` ='$id'  AND `file_id` ='$fileid' ";
                                                $result = $db->query($qry);
                                                $approval = 'notapproved';
                                                while ($row = $result->fetch_assoc()) {
                                                    $approval = $row['approved'];
                                                }
                                                return $approval;
                                            }
                                            
                                            ?>
						<h3 class="title1">Assign Rights to : <?php echo getRole($id); ?></h3>
                                                <form class="form-horizontal" id="new_employee"  action="rights.php"  method="post" name="assignrights"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
                                                    
                                                    
							<?php 
                                                        
                                                        
                                                        include('dao/connect.php');
                                                $statement = "SELECT * FROM system_files ORDER BY `file_id` ASC";
                                                $result = $db->query($statement);

                                                while ($row = $result->fetch_assoc()) {
                                                    $fileid= $row['file_id'];
                                                    $filename = $row['file_id'];
                                                    $description = $row['description'];
                                                
                                                        ?>
								<div class="form-group">
									<label  class="col-sm-2 control-label"><?php echo $description ?></label>
									<div class="col-sm-8">
                                                                           <?php $approved =getApprovalStatus($id,$fileid);  ?>
                                                                          <?php if($approved == 'approved'){?>
                                                                            <input type="radio" name="<?php echo $fileid ?>" checked  value="approved">Allow
                                                                            <input type="radio" name="<?php echo $fileid ?>"  value="notapproved">Not allowable
                                                                            <?php }   ?> 
                                                                            
                                                                            
                                                                             <?php if($approved == 'notapproved'){ ?>
                                                                             <input type="radio" name="<?php echo $fileid ?>"   value="approved">Allow
                                                                             <input type="radio" name="<?php echo $fileid ?>" checked value="notapproved">Not allowable
                                                                             <?php } ?>
                                                                              
                                                                           
									</div>
                                                                        
								</div>
                                                     
                                                <?php } ?>
                                                    
                                                                <input type="hidden" name = "myid" class="form-control1" id="myid" value="<?php echo $id; ?>" >
								<div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Save</button> </div>
								
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