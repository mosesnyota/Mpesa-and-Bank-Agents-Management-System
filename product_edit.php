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
        EDIT PRODUCT DETAILS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>
      
      
      
    <section class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="box box-primary">
           
              
              <form role="form" action="save_updated_product.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
        <?php 
            $id = $_GET['id'];
            include('dao/connect.php');
            $statement = "SELECT * FROM `products` WHERE `product_id` = '$id'";
            $result = $connection->query($statement);
           $num = 0;
              while($row = $result->fetch_assoc()) { $num++; ?>        
                <div class="form-group">
                  <label for="product_category">Category:</label>
                  <select class="form-control" id="product_category" name="product_category" required >
                    <?php 
                    
                      include('dao/connect.php');
                      $cat = $row['product_category'];
                      $result2 = $db->query("select * from product_category where category_id ='$cat'");
                      
                  
                      
                      while ($de1 = $result2->fetch_assoc()) {
                           $catid1 = $de1['category_id'];
                           $cat1 = $de1['category'];  
                      }
                      ?>
                      <option value="<?php echo $catid1 ?>" selected> <?php echo $cat1 ?></option>
        <?php 
        $result = $db->query("select * from product_category");
        while ($de = $result->fetch_assoc()) {
            $catid = $de['category_id'];
            $cat = $de['category'];?>  
                      <option value="<?php echo $catid;  ?>"><?php echo $cat; ?></option>    
         <?php } ?>
                  </select>
                </div>
                  
                <div class="form-group">
                  <label for="product_name">Product Name:</label>
                  <input name="product_name" type="text" class="form-control" id="product_name"    value="<?php  echo $row['product_value'] ?>">
                </div>
                  
                <div class="form-group">
                  <label for="purchase_price">Purchase Price:</label>
                  <input type="number" class="form-control" id="purchase_price" name="purchase_price"  value="<?php echo $row['purchase_price'] ?>">
                </div>
               
               <div class="form-group">
                  <label for="wholesale_price">Wholesale Price.</label>
                  <input type="number" class="form-control" id="wholesale_price"  autocomplete="off" name="wholesale_price"   value="<?php echo $row['wholesale_price'] ?>">
               </div>
                  
               <div class="form-group">
                  <label for="retail_price">Retail Price:</label>
                  <input type="number" class="form-control" id="retail_price"  autocomplete="off" name="retail_price"   value="<?php echo $row['retail_price'] ?>">
               </div>
               <div class="form-group">
                  <label for="qnty">Quantity on Hand:</label>
                  <input type="number" class="form-control" id="qnty"  name="qnty" autocomplete="off"   value="<?php echo $row['qnty'] ?>">
               </div>
                  <input type="hidden" class="form-control" id="id"  name="id" value ="<?php echo $row['product_id'] ;?>">
                <?php }  ?>        
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
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
