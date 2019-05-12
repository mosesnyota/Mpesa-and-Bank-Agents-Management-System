<?php
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];


function isApproved($filename, $usercategory) {

    $qry = "SELECT `approved` FROM `file_rights` JOIN `system_files` ON  file_rights.`file_id` = system_files.`file_id`
  WHERE `role_id` = '$usercategory' AND `filename` = '$filename'";
    include('dao/connect.php');
    $result = $db->query($qry);
    $approved = 'notapproved';
    while ($row = $result->fetch_assoc()) {
        $approved = $row['approved'];
    }
    return $approved;
}
?>


<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
              <h1><a class="navbar-brand" href="index.php"><span class="fa fa-area-chart"></span>ERP<span class="dashboard_text">Dashboard</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="home.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                  <ul class="treeview-menu">
                    <li><a href="home.php"><i class="fa fa-angle-right"></i>HOME</a></li>
                    
                    <?php  
                    $approval = isApproved('user_rights.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"user_rights.php\"><i class=\"fa fa-angle-right\"></i>Users Rights</a></li>";
                        
                     } 
                     
                     
                     ?>
                    
                </ul>
              </li>
	<li class="treeview">
                <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Land Parcels</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php  
                    $approval = isApproved('newproject.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"newproject.php\"><i class=\"fa fa-angle-right\"></i>New Master Land</a></li>";
                        
                     } ?>
                    
                    <?php  
                    $approval = isApproved('master_lands.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"master_lands.php\"><i class=\"fa fa-angle-right\"></i>All Lands</a></li>";
                        
                     } ?>
                    
                    
                    <?php  
                    $approval = isApproved('subdivide_land.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"subdivide_land.php\"><i class=\"fa fa-angle-right\"></i>Sub Divide</a></li>";
                        
                     } ?>
                    
                    
                    
                    
                    
                </ul>
              </li>
               <li class="treeview">
                <a href="#">
                <i class="fa fa-home"></i> <span>Plots</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php  
                    $approval = isApproved('availableplots.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"availableplots.php\"><i class=\"fa fa-angle-right\"></i>Available Plots</a></li>";
                        
                     } ?>
                    
                    
                    <?php  
                    $approval = isApproved('transact.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"transact.php\"><i class=\"fa fa-angle-right\"></i>Transact</a></li>";
                        echo "<li><a href=\"elfinder.html\" target =\"_blank\" ><i class=\"fa fa-angle-right\"></i>Files Manager</a></li>";
                        
                     } ?>
                    
                    
                    
                    <?php  
                    $approval = isApproved('soldplots.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo " <li><a href=\"soldplots.php\"><i class=\"fa fa-angle-right\"></i>Sold Plots</a></li>";
                        
                     } ?>
                    
                    
                  
                  
                 
                  
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                   
                 <i class="fa fa-pie-chart"></i><span>Finance</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                     <?php  
                    $approval = isApproved('paymentreport.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"paymentreport.php\"><i class=\"fa fa-angle-right\"></i>Income Report</a></li>";
                        
                     } ?>
                    
                    
                     <?php  
                    $approval = isApproved('expenses_top.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"expenses_top.php\"><i class=\"fa fa-angle-right\"></i>Expenses Report</a></li>";
                        
                     } ?>
                    
                    
                     <?php  
                    $approval = isApproved('income_sources.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"income_sources.php\"><i class=\"fa fa-angle-right\"></i>Income Types</a></li>";
                        
                     } ?>
                   
                    
                     <?php  
                    $approval = isApproved('expense_types.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"expense_types.php\"><i class=\"fa fa-angle-right\"></i>Expense Types</a></li>";
                        
                     } ?>
                    
                    
                    
                </ul>
              </li>
              
              <li class="treeview">
              <li class="treeview">
                <a href="#">
                <i class="fa fa-users"></i>
                <span>Members</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php  
                    $approval = isApproved('member_new.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"member_new.php\"><i class=\"fa fa-angle-right\"></i>New Member</a></li>";
                        
                     } ?>
                    
                    <?php  
                    $approval = isApproved('member_list.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo " <li><a href=\"member_list.php\"><i class=\"fa fa-angle-right\"></i>All Members</a></li>";
                        
                     } ?>
                    
                   
                 
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Brokers&Marketers</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php  
                    $approval = isApproved('broker_new.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo " <li><a href=\"broker_new.php\"><i class=\"fa fa-angle-right\"></i>New Broker</a></li>";
                        
                     } ?>
                    
                    <?php  
                    $approval = isApproved('brokers.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"brokers.php\"><i class=\"fa fa-angle-right\"></i>All Brokers</a></li>";
                        
                     } ?>
                    
                   
                    
                 
                </ul>
              </li>
              
             
               <li class="treeview">
                <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Staff</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php  
                    $approval = isApproved('user_new.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo " <li><a href=\"user_new.php\"><i class=\"fa fa-angle-right\"></i>New Staff</a></li>";
                        
                     } ?>
                    
                    <?php  
                    $approval = isApproved('all_users.php', $usercat);
                    if( $approval == 'approved') { 
                    
                        echo "<li><a href=\"all_users.php\"><i class=\"fa fa-angle-right\"></i>All Staff</a></li>";
                        
                     } ?>
                   
                    
                 
                </ul>
              </li>
             
              
              
              
             
              <li class="treeview">
                <a href="#">
                <i class="fa fa-envelope"></i> <span>SMS</span>
                <i class="fa fa-angle-left pull-right"></i><small class="label pull-right label-info1">08</small><span class="label label-primary1 pull-right">02</span></a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-angle-right"></i> Send SMS </a></li>
                  
                </ul>
              </li>
              
              <li class="treeview">
                <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <span class="label label-primary pull-right">new</span>
                </a>
              </li>
		<li>
                <a href="#">
                <i class="fa fa-th"></i> <span>Widgets</span>
                <small class="label pull-right label-info">08</small>
                </a>
              </li>
              
             
              
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>