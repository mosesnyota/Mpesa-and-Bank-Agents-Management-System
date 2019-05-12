<?php
session_start();
$customer = $_POST['customer'];
$pricetype = $_POST['price'];
$paymethod = $_POST['paymethod'];
$amountpaid = $_POST['amountpaid'];




date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d");
$total_quantity =0;
$total_retail =0;
$total_wholesale =0;
foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["retail"];
        $total_quantity += $item["quantity"];
	$total_retail += ($item["retail"]*$item["quantity"]);
        $total_wholesale += ($item["wholesale"]*$item["quantity"]);
		      
    }//end foreach

  if($pricetype == 'retail'){
      $total_amount = $total_retail;
      $pricetype = 'Retail';
  }  else{
      $total_amount = $total_wholesale; 
      $pricetype = 'Wholesale';
  }
  
  $change = 0;

  if($amountpaid > $total_amount){
      $change = $amountpaid - $total_amount;
      
      $amountpaid = $total_amount;
  }
  $statuss = 'Paid';
  if($amountpaid < $total_amount){
      $statuss = 'Unpaid';
  }
    include('dao/connect.php');
  
/*
customer 5
price retail
paymethod cash
amountpaid 150
id Array
 * 
 */

$qed = "INSERT INTO `sales`
            (`sales_date`,`total_amount`,`amount_paid`,`customer_id`,`statuss`,mode_of_pay,pricetype)
VALUES ('$today','$total_amount','$amountpaid','$customer','$statuss','$paymethod','$pricetype')";
 $result = $db->query($qed);
 



if($result){
    
    include('dao/connect.php');
    if($paymethod =='cash'){
    $lpd ="UPDATE `cashsettings` SET `cash_amount` = `cash_amount` + $amountpaid";
    $result667 = $db->query($lpd);
}
//Get Sales id
$resultDD = $db->query("SELECT max(sales_id) as id from sales");
$saleid =0;
 while ($getID = $resultDD->fetch_assoc()) {
    $saleid =  $getID['id'];
 }


foreach ($_SESSION["cart_item"] as $item){
    
    $product_id = $item["id"];
    
    if($pricetype == 'retail' || $pricetype == 'Retail'){
      $price = $item["retail"];
  }  else{
      $price = $item["wholesale"];
  }
    
  $id = $item["id"];
  $qntyy = $item["quantity"];
  
  $pdf = "INSERT INTO `items_sold`
            (`qnty`,`sale_id`,`product_id`,`price`)
VALUES ('$qntyy',
        '$saleid',
        '$id',
        '$price')";
    
     $db->query($pdf); 
     
     
     $updt = "UPDATE `products`
            SET  `qnty` = qnty - $qntyy
            WHERE `product_id` = '$id'";
     $db->query($updt); 	      
    }

    echo "<script type= 'text/javascript'>alert('CHANGE:  Ksh. $change ');</script>";
    echo "<script language=javascript>window.location='shop2.php?action=empty';</script>";
}else{
  echo "<script type= 'text/javascript'>alert('Error Saving transaction');</script>";
   echo "<script language=javascript>window.location='shop2.php?action=empty';</script>";  
}
