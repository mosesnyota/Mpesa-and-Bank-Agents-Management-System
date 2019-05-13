<?php


$paymethod = $_POST['paymethod'];
$amountpaid = $_POST['amountpaid'];
$idd = $_POST['idd'];
$total_amount =  $_POST['total_amount'];


date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d");
$total_quantity = 0;
$total_retail = 0;
$total_wholesale = 0;


  
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

$qed = "UPDATE `sales`
SET 
  `amount_paid` = amount_paid + $amountpaid,
  `statuss` = '$statuss',
  `mode_of_pay` = '$paymethod'
WHERE `sales_id` = '$idd'";

 $result = $db->query($qed);
 
 
if($result){
    
    include('dao/connect.php');

    $lpd ="UPDATE `cashsettings` SET `cash_amount` = `cash_amount` + $amountpaid";
    $result667 = $db->query($lpd);
    
    
    $podd = "INSERT INTO `credit_sale_payments`
            (`pay_date`,`amount`,`sale_id`)
VALUES ('$today','$amountpaid','$idd')";
     $podd2 = $db->query($podd);



     echo "<script type= 'text/javascript'>alert('CHANGE:  Ksh. $change ');</script>";
     echo "<script language=javascript>window.location='unpaid_sales.php';</script>";
}else{
     echo "<script type= 'text/javascript'>alert('Error Saving transaction');</script>";
     echo "<script language=javascript>window.location='unpaid_sales.php';</script>";  
}
