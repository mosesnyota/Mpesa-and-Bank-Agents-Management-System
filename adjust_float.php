<?php
require 'auth.php';
$role_id = $_SESSION['SESS_CATEGORY_'];
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'header.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
       <header class="main-header">
           <?php include 'top_nav.php'; ?>
       </header>
    
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <?php include 'left_nav.php'; ?>
    <!-- /.sidebar -->
  </aside>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include 'adjust.php'; ?>
    <!-- Main content -->
  </div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include 'footer.php'; ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
        <?php include 'asidemenu.php'; ?>
  </aside>
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
 <?php include 'jquery.php'; ?>
</body>
</html>
