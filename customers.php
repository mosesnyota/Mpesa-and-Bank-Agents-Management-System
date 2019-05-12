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

                            if (confirm("WARNING !!\n\nYou are about to delete this Customer\n\nDo you want to continue?")) {

                                window.location = "delete_customer.php?id=" + id;
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
        All Customers
        <small>Past and Present</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Customers</a></li>
        <li class="active">All Customers</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            
          <div class="box">
            
           <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success btn-lg pull-left"  data-toggle="modal" data-target="#modal_new_customer"> ADD CUSTOMER</button>
              <a href="pdf_customers.php" target="_blank" class="success pull-right"><i class='glyphicon glyphicon-print'></i>&nbsp;Print PDF</a>
           </div>
          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
           <?php 
           
           include('dao/connect.php');
                            $statement = "select * from customer";
                            $result = $connection->query($statement);
                        
           
           $num = 0;
              while($row = $result->fetch_assoc()) {
                  $num++;
           ?>    
               <tr>
                  <td> <?php echo $num; ?></td>
                  <td> <?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?> </td>
                  <td> <?php echo $row['phone']; ?></td>
                 
     
                 
                <td><a href="customer_edit.php?id=<?php echo $row['cust_id'] ?>" title="Click to Edit Customer Details"><i  <button type="button" class="btn btn-success hvr-icon-float-away btn-sm btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a></td>
                <td> <a href="#" onclick="return WarningDelete(<?php echo $row['cust_id'] ?>);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></i></a></td>		
                                                 
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


<div class="modal modal-primary fade" id="modal_new_customer">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ADD NEW CUSTOMER</h4>
              </div>
              <div class="modal-body">
                  
                  
                  <form role="form" action="save_customer.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
                <div class="form-group">
                  <label for="fname">First Name:</label>
                  <input name="fname" type="text" class="form-control" id="fname" name="fname" required placeholder="First Name">
                </div>
                  
                <div class="form-group">
                  <label for="mname">Middle Name:</label>
                  <input name="mname" type="text" class="form-control" id="mname"    placeholder="Middle Name">
                </div>
                  
                <div class="form-group">
                  <label for="lname">Last Name:</label>
                  <input type="text" class="form-control" id="lname" name="lname"  placeholder="Last Name">
                </div>
               
              
                  
               <div class="form-group">
                  <label for="idno">ID No.</label>
                  <input type="text" class="form-control" id="idno"   name="idno"   placeholder="ID Number">
               </div>
              
               <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" class="form-control" id="phone"  name="phone"   placeholder="Phone No">
               </div>
               
                <div class="form-group">
                  <label for="emailadd">Email Address</label>
                  <input type="text" class="form-control" id="emailadd"  name="emailadd"  placeholder="Enter Email">
                </div>
                  
              
                  
              </div>
              <!-- /.box-body -->

              <div class="box-footer" align="center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
                  
          
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>

</body>
</html>

</body>
</html>
