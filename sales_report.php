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


  
  
   <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

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
        Sales Report
        <small><?php echo date("M,d,Y h:i a"); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Transactions</a></li>
        <li class="active">Sales Report</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-10">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
            <table class="col-xs-10">
                <tr>
                <div>
                 <td> 
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control pull-right" id="reservation" autocomplete="off" name="mydate">
                   
                </div></td> </div> 
                <td> <button type="submit" class="btn btn-primary pull-right">Submit</button></td>
                
                </tr>
                <tr><div>
                    
                </div></tr>
             
           </table>
               
              
            </form>
        </div>
        
        <?php 
        
        if(isset($_POST['mydate'])){
            $mydate = $_POST['mydate'];
            //echo $mydate;
            $from  = date("Y-m-d",strtotime(substr($mydate, 0, 10))); 
            $to  = date("Y-m-d",strtotime(substr($mydate, 13, 22))); 
            
        }else{
           
             $to  = date("Y-m-d");
             $from   =  date("Y-m-d", strtotime("-5 days", strtotime($to)));
              echo  "Date Range Not Selected:";
        }
        
        ?>
        
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" align="right">
                <a href="pdf_sales_report.php?from=<?php echo $from;?>&to=<?php echo $to;?>" target="_blank" class="success"><i class='glyphicon glyphicon-print'></i>&nbsp;Print PDF</a>
            </div>
          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Category</th>
                  <th>Product</th>
                  <th>Sale Price</th>
                  <th>Sale Type</th>
                  <th>Date</th>
                  <th>Qty</th>
                  <th>Total</th>
                  
               
                  
                </tr>
                </thead>
                <tbody>
           <?php 
           
           include('dao/connect.php');
            $statement = "SELECT `category`,`product_value`,`price`,pricetype, SUM(`items_sold`.`qnty`) AS totalunits , 
SUM(`price` *`items_sold`.`qnty`) AS totalamount , DATE_FORMAT(`sales_date`,\"%d-%m-%Y\") 
AS salesdate FROM sales
JOIN `items_sold` ON SALES.`sales_id` = items_sold.`sale_id`
JOIN `products` ON `items_sold`.`product_id` = `products`.`product_id`
JOIN `product_category` ON `products`.`product_category` = `product_category`.`category_id` 
WHERE  sales_date >= '$from' AND sales_date <= '$to'
GROUP BY category, product_value, pricetype, sales_date
ORDER BY `sales_date` DESC, category DESC, product_value DESC";
            $result = $connection->query($statement);
            $num = 0;
            
            $totalSale = 0;
            $totalPaid = 0;
            $totalUnits = 0;
            while($row = $result->fetch_assoc()) {
                  $num++;
                  $totalSale += $row['totalamount'];
                  $totalUnits += $row['totalunits'];
           ?>    
               <tr>
                  <td> <?php echo $num; ?></td>
                  <td><b> <?php echo $row['category']; ?> </b></td>
                  <td><b> <?php echo $row['product_value']; ?></b></td>
                  <td><b> <?php echo $row['price']; ?></b></td>
                  <td><b> <?php echo $row['pricetype']; ?></b></td>
                   <td> <b><?php echo $row['salesdate']; ?></b></td>
                  <td> <b><?php echo $row['totalunits']; ?></b></td>
                  <td> <b><?php echo "Ksh. ".number_format($row['totalamount'],2); ?></b></td>
                 
                </tr>
              <?php }  ?>    
                
                  
                
                </tbody>
                <tfoot>
                    <td >  </td>
                    <td >  </td>
                    <td >  </td>
                    <td >  </td>
                    <td >  </td>
                    <td span="5"> Totals </td>
                    <td><b> <?php echo $totalUnits; ?></b></td>
                    <td><b> <?php echo "Ksh. ".number_format($totalSale,2); ?></b></td>
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
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



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
