<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PronetERP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


<script type="text/javascript" language="javascript" class="init">
                      
                        
                        function WarningDelete(id) {

                            if (confirm("WARNING !!\n\nYou are about to delete this Transaction\n\nDo you want to continue?")) {

                                window.location = "delete_transaction.php?id=" + id;
                                /* $.ajax({
                                 type: "POST",
                                 url: "delete_customer.php",
                                 data: info,id
                                 success: function(){
             
                                 }
                                 });*/
                            } else {
                                return false;
                            }
                        }

                    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
       <?php include 'top_nav.php'; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
        <?php include 'left_nav.php'; ?>
</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Transactions
        <small>Past and Present</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Transactions</a></li>
        <li class="active">All Transactions</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            
          <div class="box">
            <div class="box-header" align="right">
              <a href="pdf_transactions.php" target="_blank" class="success"><i class='glyphicon glyphicon-print'></i>&nbsp;Print PDF</a>
            </div>
          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Account</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Phone</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
           <?php 
           
           include('dao/connect.php');
            $statement = "SELECT `transactions`.*, `account_type`,`account_name` FROM `transactions` JOIN `accounts` ON `transactions`.`accnt_id` = accounts.`accnt_id` ORDER BY `trans_date` DESC";
            $result = $connection->query($statement);
            $num = 0;
            while($row = $result->fetch_assoc()) {
                  $num++;
           ?>    
               <tr>
                  <td> <?php echo $num; ?></td>
                  <td> <?php echo $row['account_type']; ?> </td>
                  <td> <?php echo $row['account_name']; ?></td>
                  <td> <?php echo $row['trans_code']; ?></td>
                  <td> <?php echo $row['trans_acct']; ?></td>
                  <td> <?php echo $row['trans_type']; ?></td>
                  <td> <?php echo $row['trans_amount']; ?></td>
                  
                <td><a href="transaction_edit.php?id=<?php echo $row['trans_id'] ?>" title="Click to Edit Transaction Details"><i  <button type="button" class="btn btn-success hvr-icon-float-away btn-sm btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a></td>
                <td> <a href="#" onclick="return WarningDelete(<?php echo $row['trans_id'] ?>);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></i></a></td>		
                                                 
                </tr>
              <?php }  ?>    
                
                  
                
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


</body>
</html>
