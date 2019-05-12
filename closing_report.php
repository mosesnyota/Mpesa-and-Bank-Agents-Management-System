<?php 
function getCashBalance(){
    include('dao/connect.php');
    $statement = "SELECT `cash_amount` FROM `cashsettings` ";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['cash_amount'];
      }
    return $deposits;
}
function getAllSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`total_amount`) AS total FROM `sales` WHERE `sales_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function getPaidSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount_paid`) AS total FROM `sales` WHERE `sales_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}


function getCreditSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(total_amount - amount_paid) AS total FROM sales WHERE sales_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}


function cashAdditions(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) AS total FROM `cash_additions` WHERE `amount` > 0 AND `cash_ad_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function payouts(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) AS total FROM `cash_additions` WHERE `amount` < 0 AND `cash_ad_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return abs($deposits);
}




function floatAdditions(){
    include('dao/connect.php');
    $statement = "SELECT SUM(amount) AS total FROM float_additions WHERE amount > 0 AND float_ad_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function creditPayments(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) as total FROM `credit_sale_payments` WHERE pay_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}



?>

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
        Closing Report
        <small><?php echo date("M,d,Y h:i a"); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Transactions</a></li>
        <li class="active">Closing Report</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            
          <div class="box">
            <div class="box-header" align="right">
                <a href="pdf_endday.php" target="_blank" class="success"><i class='glyphicon glyphicon-print'></i>&nbsp;Print PDF</a>
            </div>
          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Account</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Amount</th>
                  
                </tr>
                </thead>
                <tbody>
           <?php 
           $totalWithdrawal = 0;
           $totalDeposits =0 ;
           include('dao/connect.php');
            $statement = "SELECT `account_type`,`account_name` , `trans_type`, SUM(`trans_amount`) AS total FROM `accounts` 
JOIN `transactions` ON accounts.`accnt_id` = `transactions`.`accnt_id`  WHERE DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE() GROUP BY `account_type`,`account_name` , `trans_type`";
            $result = $connection->query($statement);
            $num = 0;
            while($row = $result->fetch_assoc()) {
                  $num++;
                  $type = $row['trans_type'];
                if($type == 'W'){
                    $totalWithdrawal += $row['total'];
                }else{
                    $totalDeposits += $row['total'];
                }
           ?>    
               <tr>
                  <td> <?php echo $num; ?></td>
                  <td> <?php echo $row['account_type']; ?> </td>
                  <td> <?php echo $row['account_name']; ?></td>
                  <td> <?php echo $row['trans_type']; ?></td>
                  <td> <?php echo $row['total']; ?></td>
                </tr>
              <?php }  ?>    
                
                </tbody>
                <tfoot>
                <tr>
                 
                  <th></th>
                  <th></th>
                  <th colspan="2">Total Withdrawals</th>
                  <th><?php echo "Ksh. ".number_format($totalWithdrawal,2) ?></th>
                </tr>
                
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="2">Total Deposits</th>
                  <th><?php echo "Ksh. ".number_format($totalDeposits,2) ?></th>
                </tr>
                
               <tr>
                  <th></th>
                  <th></th>
                  <th colspan="2">Cash Addition</th>
                  <th><?php echo "Ksh. ".number_format(cashAdditions(),2) ?></th>
                </tr>
                
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="2">Float Addition</th>
                  <th><?php echo "Ksh. ".number_format(floatAdditions(),2) ?></th>
                </tr>
                
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="2">Paid Out</th>
                  <th><?php echo "Ksh. ".number_format(payouts(),2) ?></th>
                </tr>
               
                <tr>
                   
                  <th></th>
                  <th></th>
                  <th colspan="2">Cash Sales</th>
                  <th><?php echo "Ksh. ".number_format(getPaidSales(),2) ?></th>
                </tr>
                
                <tr>
                    
                   <th></th>
                  <th></th>
                  <th colspan="2">Sales on Credit</th>
                  <th><?php echo "Ksh. ".number_format(getCreditSales(),2) ?></th>
                </tr>
                
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th colspan="1">Total Sales</th>
                  <th><?php echo "Ksh. ".number_format(getAllSales(),2) ?></th>
                </tr>
                
                
                <tr>
                 <th></th>
                  <th></th>
                  <th colspan="2">Payments for Previous Credit Sales</th>
                  <th><?php echo "Ksh. ".number_format(creditPayments(),2) ?></th>
                </tr>
                
                
                
                 <tr>
                 <th></th>
                  <th></th>
                  <th colspan="2">Expected Cash</th>
                  <th><?php echo "Ksh. ".number_format(getCashBalance(),2) ?></th>
                </tr>
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
