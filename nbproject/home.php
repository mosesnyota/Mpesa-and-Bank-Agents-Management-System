<?php 
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];


?>

<!DOCTYPE HTML>
<html>
    <head>
    <?php include 'page_header.php'; ?>
    </head>
    <body class="cbp-spmenu-push">
        <div class="main-content">
            <!--left-fixed -navigation-->
            <?php include 'left_nav.php'; ?>
            
            <!-- header-starts -->
            <?php include 'top_panel.php'; ?>
            <!-- //header-ends -->
            
            
            <?php 
            function getPlotsAvailable(){
                $qyd ="SELECT COUNT(*) AS total FROM `plots` WHERE `cur_status` ='Available'";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return "000".$row['total'];
                 }
                 
            }
            
            function totalPlotsSold(){
                $qyd ="SELECT COUNT(*) AS total FROM `plots` WHERE `cur_status` ='Sold'";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return "00".$row['total'];
                 }
                 
            }
            
            
            function totalMembers(){
                $qyd ="SELECT COUNT(*) AS total FROM member ";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return "00".$row['total'];
                 }
                 
            }
            
            
            function thisMonthSales(){
                $qyd ="SELECT  SUM(amount) as total FROM `payments`  WHERE MONTH(date_of_pay)= MONTH(CURDATE())";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return number_format($row['total'],0);
                 }
                 
            }
            
            
            function getPlots($id){
                $qyd ="SELECT COUNT(*) as total FROM `plots` WHERE `master_land_id` = '$id'";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return number_format($row['total'],0);
                 }
                 
            }
            
            function getAvailablePlots($id){
                $qyd ="SELECT COUNT(*) as total FROM `plots` WHERE `master_land_id` = '$id' and cur_status ='Available'";
                 include('dao/connect.php');
                 $result = $db->query($qyd);
                 
                 while($row = $result->fetch_assoc()) {
                     return number_format($row['total'],0);
                 }
                 
            }
            
            ?>
            <!-- main content start-->
            <div id="page-wrapper">
                <div class="main-page">
                    
                    <div class="col_3">
                        
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-bank icon-rounded" ></i>
                                <div class="stats">
                                    <h5 ><strong>  <?php echo getPlotsAvailable();?></strong></h5>
                                    <span href="avaiableplots.php">Plots Available</span>
                                </div>
                            </div>
                        </div>
                       
                        
                        
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-bank dollar2 icon-rounded"></i>
                                <div class="stats">
                                    <h5><strong><?php echo totalPlotsSold();?></strong></h5>
                                    <span>Total Sold</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                                <div class="stats">
                                    <h5><strong><?php echo thisMonthSales();?></strong></h5>
                                    <span>This Month</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-user icon-rounded"></i>
                                <div class="stats">
                                    <h5><strong><?php echo totalMembers();?></strong></h5>
                                    <span>Members</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-3 widget">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                                <div class="stats">
                                    <h5><strong><?php echo totalMembers();?></strong></h5>
                                    <span>Total Active</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix"> </div>
                    </div>

                    <div class="chit-chat-layer1">
                    <div class="clearfix"> </div>
</div>
  </div>
<!-- mainpage-chit -->
 <div class="chit-chat-layer1">
	<div class="col-md-12 chit-chat-layer1-left">
               <div class="work-progres">
                                        <header class="widget-header">
                                            <h4 class="widget-title">Ongoing Projects</h4>
                                        </header>
			<hr class="widget-separator">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Parcel</th>
                                      <th>Total Plots</th>                                   
                                      <th>Available Plots</th>                          
                                      <th>Status</th>
                                      <th>Progress</th>
                                  </tr>
                              </thead>
                              <tbody>
                                
                                    <?php
                                    $num = 0;
                                    include('dao/connect.php');
                            $statement = "SELECT * FROM master_land order by purchase_date DESC limit 10";
                            $result = $db->query($statement);
                            while($row = $result->fetch_assoc()) {?>
                                <tr>
                                  <td><?php echo ++$num ?></td>
                                  <td> <?php echo str_replace("&", "'", $row['name']) ?></td>
                                  <?php 
                                   $available = getAvailablePlots($row['master_land_id']);
                                   $total = getPlots($row['master_land_id']);
                                   if($total == 0){
                                       $total = 1;
                                   }
                                   
                                   $percentSold = (100 - number_format(($available/$total)*100,1));
                                   
                                   if($percentSold < 10){
                                       $label = 'label label-danger';
                                       $badge = 'badge badge-info';
                                       $msg = 'In Progress';
                                   }else  if($percentSold > 10 && $percentSold < 50){
                                       $label = 'label label-warning';
                                       $badge = 'badge badge-warning';
                                        $msg = 'In Progress';
                                   }else if($percentSold >= 50 && $percentSold < 100){
                                       $label = 'label label-success';
                                       $badge = 'badge badge-success';
                                        $msg = 'In Progress';
                                   }else if($percentSold == 100){
                                       $label = 'label label-success';
                                       $badge = 'badge badge-success';
                                       $msg = 'Sold';
                                   }
                                  
                                  ?>
                                  <td><?php echo $total?></td>     
                                  <td><?php echo $available?></td>                      
                                  <td><span class="<?php echo $label?>"><?php echo $msg?></span></td>
                                  <td><span class="<?php echo $badge?>"> <?php echo $percentSold." %"?> </span></td>
                                  
                                </tr>
                                
                                
                            <?php }   ?>
                                
                              
                             
                             
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
      
     
     
     
     
     <div class="clearfix"> </div>
</div>
	
 

                    <!-- for amcharts js -->
                    <script src="js/amcharts.js"></script>
                    <script src="js/serial.js"></script>
                    <script src="js/export.min.js"></script>
                    <link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
                    <script src="js/light.js"></script>
                    <!-- for amcharts js -->

                    <script  src="js/index1.js"></script>
                    <div class="col_1">
                   <div class="clearfix"> </div>

                    </div>

              
            </div>
            <!--footer-->
<?php include 'footer.php'; ?>
            <!--//footer-->
        </div>
<?php include 'toggle.php'; ?>
    </body>
</html>