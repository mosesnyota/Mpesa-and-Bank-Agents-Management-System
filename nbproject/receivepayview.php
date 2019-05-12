
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
						<h3 class="title1">SELL PLOT</h3>
                                                <form class="form-horizontal" id="new_employee"  action="save_plot_sale.php" name="newproject" method="post"  enctype="multipart/form-data">
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
                                                                            <input  type="text" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" name = "masterland" class="form-control1" id="holder_phone"    value="<?php echo "Land: ".$row['name'].", Location: ".$row['location'].", Master Title: ".$row['title_no'] ?>" >
									</div>
							     </div>
                                                    
								<div class="form-group">
									<label for="plot_num" align="left" class="col-sm-2 control-label">Plot Number</label>
									<div class="col-sm-8">
                                                                        <input type="text" name = "plot_num" id = "plot_num" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" class="form-control1" id="landname" value="<?php echo $row['plot_num'] ?>" required>
									</div>
								</div>
                                                              <div class="form-group">
									<label for="size" align="left" class="col-sm-2 control-label">Size</label>
									<div class="col-sm-8">
									<input type="text" name="size" id="size" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" class="form-control1" id="location"  value="<?php echo $row['size'] ?>"  required>
									</div>
							      </div>
								<div class="form-group">
									<label for="titleno" align="left" class="col-sm-2 control-label">Title No</label>
									<div class="col-sm-8">
									<input  type="text" name="titleno" id="titleno" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" class="form-control1" id="titleno"   value="<?php echo $row['title_no'] ?>" >
									</div>
								</div>
                                                                <div class="form-group">
									<label for="set_price" class="col-sm-2 control-label">Selling Price</label>
									<div class="col-sm-8">
									<input  type="text" name = "set_price" class="form-control1" id="set_price"   value="<?php echo $row['set_price'] ?>"  required>
									</div>
								</div>
                                                    
                                                            <div class="form-group">
                                                                        <label for="dealer" class="col-sm-2 control-label">Broker</label>
                                                                        <div class="col-sm-8">


                                                                            <select name="dealer" id="dealer"    required >
                                                                                <option value="">-----Select Dealer----</option>
                                                                                <?php
                                                                                include('dao/connect.php');

                                                                                $resultw = $db->query("SELECT * FROM brokers");
                                                                                while ($roww = $resultw->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $roww['broker_id']; ?>"><?php echo $roww['first_name'] . " " . $roww['middle_name'] . " " . $roww['last_name']; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?> 
                                                                            </select></div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="customer" class="col-sm-2 control-label">Customer/Member</label>
                                                                        <div class="col-sm-8">


                                                                            <select name="customer" id="customer"    required >
                                                                                <option value="">-----Select Customer/Member----</option>
                                                                                <?php
                                                                                include('dao/connect.php');

                                                                                $resultf = $db->query("SELECT * FROM member");
                                                                                while ($rowf = $resultf->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $rowf['member_id']; ?>"><?php echo $rowf['first_name'] . " " . $rowf['middle_name'] . " " . $rowf['last_name']; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?> 
                                                                            </select></div>
                                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                                        <label for="paymode" class="col-sm-2 control-label">Mode of Pay</label>
                                                                        <div class="col-sm-8">


                                                                                <select name="paymode" id="paymode"    required >
                                                                                <option value="">-------------Select Mode of Pay -------------</option>
                                                                                <option value="cash">Cash</option>
                                                                                <option value="mpesa">Mpesa</option>
                                                                                <option value="cheque">Cheque</option>
                                                                                <option value="transfer">Bank Transfer</option>
                                                                                <option value="deposit">Direct Deposit</option>
                                                                                <option value="others">Other Payment Modes</option>
                                                                                
                                                                            </select></div>
                                                                    </div>

                                                  <div class="form-group">
									<label for="payreference" class="col-sm-2 control-label">Payment Reference</label>
									<div class="col-sm-8">
									<input  type="text" name = "payreference" class="form-control1" id="payreference"     required>
									</div>
								</div>
                                                    
                                                    <div class="form-group">
									<label for="saledate" class="col-sm-2 control-label">Sales Date</label>
									<div class="col-sm-8">
										<?php
					require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("saledate", true, false);
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
									<label for="otherdetails" class="col-sm-2 control-label">Other Details</label>
									<div class="col-sm-8">
									<input  type="text" name = "otherdetails" class="form-control1" id="otherdetails"    required>
									</div>
								</div>
                                                            
                                                     <?php  } ?>
                                                    <input  hidden="hidden" type="text" name = "id" class="form-control1" id="id"    value="<?php echo $id ?>" >
								<div class="col-sm-offset-4"> <button type="submit" class="btn btn-large btn-success">Save</button> </div>
								
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