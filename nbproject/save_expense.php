<?php
require_once("dao/SaveData.php");



$set_price = strip_tags($_POST['amount']);
$plot_id = strip_tags($_POST['id']);

$expensetype= strip_tags($_POST['expensetype']);

$master_land = strip_tags($_POST['master_land_id']);

$saledate = strip_tags($_POST['saledate']);
$otherdetails = strip_tags($_POST['otherdetails']);
$payment_mode = strip_tags($_POST['paymode']);
$reference = strip_tags($_POST['payreference']);






$query = "INSERT INTO `expenses`
            (
             `expense_date`,
             `expense_type_id`,
             `amount`,
             `expense_mode`,
             `details`,
             `status`,plot_id,master_land)
VALUES (
        '$saledate',
        '$expensetype',
        '$set_price',
        '$payment_mode',
        '$reference',
        '$otherdetails','$plot_id','$master_land')";

include('dao/connect.php');
$state = $db->query($query);

 if($state){
     

echo "<script type= 'text/javascript'>alert('Sales Record Saved Successfully');</script>";
echo "<script language=javascript>window.location='availableplots.php';</script>";
//new AuditTrail('Sold Plot id = '.$plot_id,'Admin');
 }else{
      echo "Error Saving";
 }

 

