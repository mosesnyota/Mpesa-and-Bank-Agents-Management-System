<!DOCTYPE HTML>
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
						<h3 class="title1">New Staff</h3>
                                                <form class="form-horizontal" id="new_employee"  action="save_user.php" name="newstaff" method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
							
								<div class="form-group">
									<label for="firstname" class="col-sm-2 control-label">First Name</label>
									<div class="col-sm-8">
                                                                            <input type="text" name = "firstname" class="form-control1" id="firstname" placeholder="First Name" required>
									</div>
                                                                        
								</div>
                                                              <div class="form-group">
									<label for="middlename" class="col-sm-2 control-label">Other Name</label>
									<div class="col-sm-8">
										<input type="text" name = "middlename" class="form-control1" id="middlename" placeholder="Middle Name" required>
									</div>
									
							      </div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Surname</label>
									<div class="col-sm-8">
										<input  type="text" name = "lastname" class="form-control1" id="lastname"  placeholder="Last Names">
									</div>
								</div>
                                                                <div class="form-group">
									<label for="idno" class="col-sm-2 control-label">ID No.</label>
									<div  class="col-sm-8">
										<input  type="text" name = "idno" class="form-control1" id="idno"   placeholder="ID Number" required>
									</div>
								</div>
                                                            
								 <div class="form-group">
									<label for="gender" class="col-sm-2 control-label">Gender</label>
									<div class="col-sm-8">
                                                                           <input type="radio" name="gender" value="Male" checked>Male<br>
                                                                           <input type="radio" name="gender" value="Female">Female<br>
									</div>
								</div>
                                                    
                                                    
                                                              <div class="form-group">
                                                                        <label for="category" class="col-sm-2 control-label">Staff Category</label>
                                                                        <div class="col-sm-8">


                                                                            <select name="category" id="category"    required >
                                                                                <option value="">---------Select Staff Category---------</option>
                                                                                <?php
                                                                                include('dao/connect.php');

                                                                                $resultw = $db->query("SELECT * FROM staff_category");
                                                                                while ($roww = $resultw->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $roww['role_id']; ?>"><?php echo $roww['role']; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?> 
                                                                            </select></div>
                                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                                  <div class="form-group">
									<label for="dob" class="col-sm-2 control-label">DOB</label>
									<div class="col-sm-8">
										<?php
					  require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("dob", true, false);
					  $myCalendar->setIcon("images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(1930, date("Y"));
					  $myCalendar->setDateFormat('j F Y');
					  $myCalendar->setAlignment('right', 'bottom');
					  $myCalendar->getDate();
					  $myCalendar->writeScript();
					?>
									</div>
								  </div>
                                                    
                                                                 <div class="form-group">
									<label for="kra" class="col-sm-2 control-label">KRA Pin.</label>
									<div class="col-sm-8">
										<input  type="text"name = "kra" class="form-control1" id="kra"   placeholder="KRA PIN">
									</div>
								 </div>
                                                               <div class="form-group">
									<label for="phone" class="col-sm-2 control-label">Tell.</label>
									<div class="col-sm-8">
										<input  type="text" name = "phone" class="form-control1" id="phone"   placeholder="Phone Number" required>
									</div>
								</div>
                                                            
                                                    
                                                                <div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-8">
										<input  type="text" name = "email" class="form-control1" id="email"   placeholder="Email">
									</div>
								</div>
                                                     <div class="form-group">
									<label for="datejoined" class="col-sm-2 control-label">Date Joined</label>
									<div class="col-sm-8">
										<?php
					require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("datejoined", true, false);
					  $myCalendar->setIcon("images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(1930, date("Y"));
					  $myCalendar->setDateFormat('j F Y');
					  $myCalendar->setAlignment('right', 'bottom');
					  $myCalendar->getDate();
					  $myCalendar->writeScript();
					?>
									</div>
								  </div>
                                                            
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