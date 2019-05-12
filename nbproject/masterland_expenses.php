
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
						<h3 class="title1">RECORD EXPENSE FOR A MASTER LAND</h3>
                                                <form class="form-horizontal" id="new_employee"  action="save_master_expense.php" name="newproject" method="post"  enctype="multipart/form-data">
						<div class="form-three widget-shadow">
                                                                
                                                        <?php   
                                                        if(isset($_GET['id'])){
                                                       $id = $_GET['id']; 
                                                    }
                                                    
                                                    $qry = "SELECT `name`,`location`,`master_land`.`title_no` FROM `master_land` WHERE master_land_id ='$id'";
                                                    include('dao/connect.php');
                                                    $result = $db->query($qry);
                                                     while($row = $result->fetch_assoc()) {
                                                    
                                                        ?>
                                                        
                                                                 <div class="form-group">
									<label for="masterland" class="col-sm-2 control-label" >Master Land</label>
									<div class="col-sm-8">
                                                                            <input  type="text" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" name = "masterland" class="form-control1" id="holder_phone"    value="<?php echo "Land: ".$row['name'].", Location: ".$row['location'] ?>" >
									</div>
							     </div>
                                                    
								
								<div class="form-group">
									<label for="titleno" align="left" class="col-sm-2 control-label">Title No</label>
									<div class="col-sm-8">
									<input  type="text" name="titleno" id="titleno" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #d8caa9;" disabled="disabled" class="form-control1" id="titleno"   value="<?php echo $row['title_no'] ?>" >
									</div>
								</div>
                                                   
                                                                <div class="form-group">
									<label for="amount" class="col-sm-2 control-label">Amount</label>
									<div class="col-sm-8">
									<input  type="text" name = "amount" class="form-control1" id="amount" required>
									</div>
								</div>
                                                    
                                                                 <div class="form-group">
                                                                        <label for="expensetype" class="col-sm-2 control-label">Expense Type</label>
                                                                        <div class="col-sm-8">


                                                                            <select name="expensetype" id="dealer"    required >
                                                                                <option value="">-----Select Expense Type----</option>
                                                                                <?php
                                                                                include('dao/connect.php');

                                                                                $resultw = $db->query("SELECT * FROM expense_types");
                                                                                while ($roww = $resultw->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $roww['expense_type_id']; ?>"><?php echo $roww['expense_type'] ; ?></option>
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
									<label for="otherdetails" class="col-sm-2 control-label">Other Details</label>
									<div class="col-sm-8">
									<input  type="text" name = "otherdetails" class="form-control1" id="otherdetails"    required>
									</div>
								</div>
                                                    <div class="form-group">
									<label for="saledate" class="col-sm-2 control-label">Transaction Date</label>
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
