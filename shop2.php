<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT products.*,`category` FROM `products` JOIN `product_category` ON products.`product_category` = `product_category`.`category_id`  WHERE product_value='" . $_GET["code"] . "'");
                        
			$itemArray = array($productByCode[0]["product_value"]=>array('name'=>$productByCode[0]["category"], 'code'=>$productByCode[0]["product_value"],'id'=>$productByCode[0]["product_id"], 'quantity'=>$_POST["quantity"], 'retail'=>$productByCode[0]["retail_price"], 'wholesale'=>$productByCode[0]["wholesale_price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["product_value"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["product_value"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
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

                            if (confirm("WARNING !!\n\nYou are about to delete this Product\n\nDo you want to continue?")) {

                                window.location = "delete_product.php?id=" + id;
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
                        
                        
                        
                        var x = 0;
var array = Array();

function add_element_to_array()
{
 array[x] = document.getElementById("text1").value;
 alert("Element: " + array[x] + " Added at index " + x);
 x++;
 document.getElementById("text1").value = "";
 
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
        Sell Product
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Sell</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    
            
          <div class="row">
   
            
            
              
              
              <section class="col-lg-10 connectedSortable">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Wholesale Price</th>
                  <th>Retail Price</th>
                  <th>Qnty</th>
                  <th>Add</th>
                  
                </tr>
                </thead>
                <tbody>
           <?php 
           $numm = 0;
           $product_array = $db_handle->runQuery("SELECT products.*,`category` FROM `products` JOIN `product_category` ON products.`product_category` = `product_category`.`category_id` ORDER BY product_category ASC");
           if (!empty($product_array)) { 
               foreach($product_array as $key=>$value){  $numm++; ?>
                    <tr>
                        <form method="post" action="shop2.php?action=add&code=<?php echo $product_array[$key]["product_value"]; ?>">
                            <td><?php echo $numm; ?></td>
                            <td><?php echo $product_array[$key]["category"]." : ".$product_array[$key]["product_value"]; ?></td>
                            <td><?php echo "Ksh. ".$product_array[$key]["wholesale_price"]; ?></td>
                            <td><?php echo "Ksh. ".$product_array[$key]["retail_price"]; ?></td>
                            <td><input type="number" class="product-quantity" name="quantity" value="1" size="1" /></td>
                            <td><input type="submit" value="Add to Cart" class="btnAddAction" /></td>
                               
			
			
			
			
			</form>
                        
                    </tr>
               <?php  }
           }
            ?>    
                
                  
                
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
          </section>
              
            
              
              
                     
           <section class="col-lg-10 connectedSortable">
               <h3>  </h3>
               <h3>  </h3>
             
           <!-- /.box-header -->
            <div class="box-body">
              <table id="table33" class="table table-bordered table-striped">
             <thead>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
             </thead>
                <tbody>
           <?php
           
           if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["wholesale"];
		?>
				<tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["code"]; ?></td>
                                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                    <td  style="text-align:right;"><?php echo "".$item["wholesale"]; ?></td>
                                    <td  style="text-align:right;"><?php echo "". number_format($item_price,2); ?></td>
                                    <td style="text-align:center;"><a href="shop2.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["wholesale"]*$item["quantity"]);
           }}
           else{?>
               <tr>
              <td>No Selected Items</td>
              <td></td>
               <td></td>
                <td></td>
                 <td></td>
                  <td></td>
                   <td></td>
               </tr>
          <?php }
		?>
           
           
                
                  
                
                </tbody>
                <tfoot>
                <td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "Ksh. ".number_format($total_price, 2); ?></strong></td>

                </tfoot>
              </table>
                <button onclick="window.location.href = 'pay.php';" class="btn btn-success btn-lg pull-right"> <i class='glyphicon glyphicon-shopping-cart'></i>&nbsp;PROCEED TO PAY</button>
                <button onclick="window.location.href = 'shop2.php?action=empty';" class="btn btn-danger btn-lg pull-left"> <i class='fa fa-remove'></i>&nbsp;CLEAR ALL</button>          
     
            </div>
             </section>
              
              
          </div>
          <!-- /.box -->
    
      
      <!-- /.row -->
    </section>
    
     <section class="col-lg-5 connectedSortable">
  <div class="box-footer clearfix no-border">
      <h3> </h3>
 <form method="get" action="transact.php">
    <button type="submit" class="btn btn-warning btn-lg  btn-large"><i class="fa fa-arrow-circle-right"></i> BACK TO MPESA</button>
</form>
            
 </div>
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

<div class="modal modal-primary fade" id="modal_new_product">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ADD NEW PRODUCT</h4>
              </div>
              <div class="modal-body">
                  
                  
                  <form role="form" action="save_product.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
                <div class="form-group">
                  <label for="product_category">Category:</label>
                  <select class="form-control" id="product_category" name="product_category" required >
                      <option value="">--------Select Category----------</option>
                      <?php 
                      include('dao/connect.php');
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
                  <input name="product_name" type="text" class="form-control" id="product_name"   required placeholder="eg Safcom 100">
                </div>
                  
                <div class="form-group">
                  <label for="purchase_price">Purchase Price:</label>
                  <input type="text" class="form-control" id="purchase_price" name="purchase_price" autocomplete="off" placeholder="Purchase Price per Unit">
                </div>
               
               <div class="form-group">
                  <label for="wholesale_price">Wholesale Price.</label>
                  <input type="text" class="form-control" id="wholesale_price"  autocomplete="off" name="wholesale_price"  required placeholder="Wholesale Price">
               </div>
                  
               <div class="form-group">
                  <label for="retail_price">Retail Price:</label>
                  <input type="text" class="form-control" id="retail_price"  autocomplete="off" name="retail_price"  placeholder="Retail Price per unit">
               </div>
               <div class="form-group">
                  <label for="qnty">Quantity on Hand:</label>
                  <input type="text" class="form-control" id="qnty"  name="qnty" autocomplete="off" required placeholder="Quantity on Hand">
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
