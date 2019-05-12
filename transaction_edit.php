<!DOCTYPE html>
<html>
<head>
    <?php include 'formheader.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
       <?php include 'top_nav.php'; ?>
  </header>
  <aside class="main-sidebar">
        <?php include 'left_nav.php'; ?>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        EDIT TRANSACTION DETAILS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Accounts</a></li>
        <li class="active">Edit Transaction</li>
      </ol>
    </section>
      
      
      
    <section class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="box box-primary">
           
              
    <form role="form" action="save_updated_transaction.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
        <?php 
            $id = $_GET['id'];
            include('dao/connect.php');
            $statement = "SELECT `transactions`.*, accounts.accnt_id, account_type,account_name FROM transactions JOIN accounts ON transactions.accnt_id = accounts.accnt_id where  trans_id='$id'";
            
            $result = $connection->query($statement);
           $num = 0;
              while($row = $result->fetch_assoc()) { $num++; 
              
              $accnid1 = $row['accnt_id'];
              $account_name = $row['account_type']." ".$row['account_name'];
              $amn = $row['trans_amount'];
              $accnt = $row['trans_acct'];
              $tname = $row['trans_name'];
              $tidno = $row['trans_idno'];
              $tcode = $row['trans_code'];
              $tdate = $row['trans_date'];
              $tid = $row['trans_id'] ;
              $trans_type = $row['trans_type'] ;
              
                      ?>        
                <div class="form-group">
                  <label>Select Account </label>
                  <select class="form-control" name="accountT" required>
                  <option value ="<?php echo $accnid1; ?>"> <?php echo $account_name; ?></option>
                      
                    <?php  
                    
                     $statement = "SELECT accounts.`accnt_id`,`account_name`,account_type FROM `accounts`";
                     $result = $db->query($statement);
                      while($row = $result->fetch_assoc()) {
                          $accnid = $row['accnt_id'];
                          $account_name = $row['account_type']." : ".$row['account_name'];
                           
                          if($accnid == $accnid1){
                              
                          }else{
                             echo "<option value =\"$accnid\"><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                          }
                         }
                    
                    ?>
                   
                  </select>
                </div>
                  
                
            <div class="form-group">
                  <label>Transaction Type:</label>
                  <select class="form-control" name="transtype" required>
                      
                    <?php
                    if($trans_type == 'W'){ 
                          echo "<option value =\"W\" selected> Withdraw</option>";
                          echo "<option value =\"D\" > Deposit</option>"; 
                    }else{
                          echo "<option value =\"W\" > Withdraw</option>";
                          echo "<option value =\"D\" selected> Deposit</option>"; 
                   }?>
                      
                  
                    
                  </select>
            </div>
                  
              
                  
                <div class="form-group">
                  <label for="depoamount">Amount Amount:</label>
                  <input name="depoamount" type="text"  class="form-control" id="depoamount" disabled="true" value="<?php  echo $amn; ?>">
                </div>
                <div class="form-group">
                  <label for="phoneaccnt">Phone No. / Accnt No.:</label>
                  <input name="phoneaccnt" type="number" autocomplete="off" class="form-control" id="phoneaccnt" required value="<?php echo  $accnt; ?>">
                </div>
                <div class="form-group">
                  <label for="custname">Customer Name:</label>
                  <input name="custname" type="text" autocomplete="off" class="form-control" id="custname" required value="<?php echo  $tname ; ?>">
                </div>
                <div class="form-group">
                  <label for="idno">ID No.:</label>
                  <input name="idno" type="text" autocomplete="off" class="form-control" id="idno" required value="<?php echo  $tidno; ?>">
                </div>
                <div class="form-group">
                  <label for="transcode">Transaction Code:</label>
                  <input name="transcode" type="text" autocomplete="off" class="form-control" id="transcode" required value="<?php echo  $tcode ; ?>">
                </div>
                <div class="form-group">
                  <label for="tdate">Transaction Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo  $tdate ; ?>" >
                </div>
                  <input type="hidden" class="form-control" id="id"  name="id" value ="<?php echo $tid ;?>">
                <?php }  ?>        
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
    </form></div>
              
        </div>
          
           
        </div> 
    
    
    </section>
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
</body>
</html>
