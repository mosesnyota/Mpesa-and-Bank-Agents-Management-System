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
					
					
                                            <?php 
                                                    
                                                    if(isset($_GET['id'])){
                                                       $id = $_GET['id']; 
                                                    }
                                                    
                                                    $qry = "SELECT * FROM brokers WHERE broker_id ='$id'";
                                                    include('dao/connect.php');
                                                    $result = $db->query($qry);
                                                    
                                                     while($row = $result->fetch_assoc()) {
                                                    
                                                    
                                                    ?>
                                            
                                            <div  class="activity_box activity_box2">
						<h3 class="title1">Update Broker Details: <?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?></h3>
                                                <form class="form-horizontal" id="new_employee"  action="broker_update.php" name="newstaff" method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
							
                                                    
                                                    <div class="form-group">
									<label for="firstname" class="col-sm-2 control-label">First Name</label>
									<div class="col-sm-8">
                                                                            <input type="text" name = "firstname" class="form-control1" id="firstname" value="<?php echo $row['first_name'] ?>" required>
									</div>
                                                    </div>
                                                              <div class="form-group">
									<label for="middlename" class="col-sm-2 control-label">Other Name</label>
									<div class="col-sm-8">
										<input type="text" name = "middlename" class="form-control1" id="middlename" value="<?php  echo $row['middle_name'] ?>" required>
									</div>
									
							      </div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Surname</label>
									<div class="col-sm-8">
										<input  type="text" name = "lastname" class="form-control1" id="lastname"  value="<?php  echo $row['last_name'] ?>">
									</div>
								</div>
                                                                <div class="form-group">
									<label for="idno" class="col-sm-2 control-label">ID No.</label>
									<div  class="col-sm-8">
										<input  type="text" name = "idno" class="form-control1" id="idno"   value="<?php  echo $row['idno'] ?>" required>
									</div>
								</div>
                                                            
								 <div class="form-group">
									<label for="gender" class="col-sm-2 control-label">Gender</label>
									<div class="col-sm-8">
                                                                            <?php if($row['gender'] == 'Male'){?>
                                                                           <input type="radio" name="gender" value="Male" checked>Male<br>
                                                                           <input type="radio" name="gender" value="Female">Female<br>
                                                                            <?php } else{?>
                                                                            <input type="radio" name="gender" value="Male" >Male<br>
                                                                           <input type="radio" name="gender" value="Female" checked>Female<br>
                                                                            <?php } ?>
									</div>
								</div>
                                                                  
                                                    
                                                                 <div class="form-group">
									<label for="kra" class="col-sm-2 control-label">KRA Pin.</label>
									<div class="col-sm-8">
										<input  type="text"name = "kra" class="form-control1" id="kra"   value="<?php  echo $row['kra_pin'] ?>">
									</div>
								 </div>
                                                               <div class="form-group">
									<label for="phone" class="col-sm-2 control-label">Tell.</label>
									<div class="col-sm-8">
										<input  type="text" name = "phone" class="form-control1" id="phone"   value="<?php  echo $row['phone'] ?>" required>
									</div>
								</div>
                                                            
                                                    
                                                                <div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-8">
										<input  type="text" name = "email" class="form-control1" id="email"   value="<?php  echo $row['email'] ?>">
									</div>
								</div>
                                                     <?php }  ?>
                                                            <input  type="hidden" name = "id" class="form-control1" id="id"   value="<?php  echo $id; ?>">
							
								<div class="col-sm-offset-2"> <button type="submit" class="btn btn-success">Update Details</button> </div>
								
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