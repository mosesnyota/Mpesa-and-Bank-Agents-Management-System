<?php



$id = $_POST['id'];
$qnty = $_POST['added'];
$todate = $_POST['todate'];

function getprice($id){
    include('dao/connect.php');
        $result = $db->query("select * from products where product_id = '$id'");
        $price = 0;
        while ($de = $result->fetch_assoc()) {
            $price = $de['purchase_price'];        
}

return $price;
        }

$supplier =  $_POST['supplier'];


$getprice = getprice($id) * $qnty;

include('dao/connect.php');
//generate invoice
$invoice = "INSERT INTO `invoice`(`invoice_date`,`amount`,`supplier_id`,`pay_status`)
VALUES ('$todate','$getprice','$supplier','Unpaid')";



$qry = "UPDATE `products`
SET 
  `qnty` = qnty + $qnty
WHERE `product_id` = '$id'";



$qry2 = "INSERT INTO `stock_additions`(`product_id`,`date_added`,`qnty_added`)
VALUES ('$id','$todate','$qnty')";

 $state = $connection->query($qry);
 $state2 = $connection->query($qry2);
 $state = $connection->query($invoice);
 
         if ($state) {
            echo "<script language=javascript>window.location='invoices.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Stock  not saved');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
        }