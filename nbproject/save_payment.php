<?php
require_once("dao/SaveData.php");



$set_price = strip_tags($_POST['set_price']);
$plot_id = strip_tags($_POST['id']);

$expensetype= strip_tags($_POST['expensetype']);

$customer= strip_tags($_POST['customer']);


$saledate = strip_tags($_POST['saledate']);
$otherdetails = strip_tags($_POST['otherdetails']);
$payment_mode = strip_tags($_POST['paymode']);
$reference = strip_tags($_POST['payreference']);



$master_land_id = strip_tags($_POST['master_land_id']);


$query = "INSERT INTO `payments`
            (
             `member_id`,
             `plot_id`,
             `date_of_pay`,
             `mode`,
             `reference`,
             `amount`,
             `others`,master_land_id,payment_type)
VALUES (
        '$customer',
        '$plot_id',
        '$saledate',
        '$payment_mode',
        '$reference',
        '$set_price',
        '$otherdetails','$master_land_id','$expensetype')";

include('dao/connect.php');
$state = $db->query($query);

 if($state){
     

echo "<script type= 'text/javascript'>alert(' Record Saved Successfully');</script>";


echo "<script language=javascript>window.location='receipt.php?set_price=".$set_price.
        "&plot_id=".$plot_id.
        "&incometype=".$expensetype.
        "&customer=".$customer.
        "&saledate=".$saledate.
        "&otherdetails=".$otherdetails.
          "&payment_mode=".$payment_mode.
          "&reference=".$reference.
        "';</script>";
//new AuditTrail('Sold Plot id = '.$plot_id,'Admin');
 }else{
      echo "Error Saving";
 }

 

