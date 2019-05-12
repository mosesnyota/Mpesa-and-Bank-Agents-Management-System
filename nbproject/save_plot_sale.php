<?php
require_once("dao/SaveData.php");



$set_price = strip_tags($_POST['set_price']);
$plot_id = strip_tags($_POST['id']);
$dealer = strip_tags($_POST['dealer']);
$customer = strip_tags($_POST['customer']);
$saledate = strip_tags($_POST['saledate']);
$otherdetails = strip_tags($_POST['otherdetails']);
$payment_mode = strip_tags($_POST['paymode']);
$reference = strip_tags($_POST['payreference']);

$master_land = strip_tags($_POST['master_land_id']);




$query = "INSERT INTO `sold_plots`
            (`plot_id`,
             `member_id`,
             `date_sold`,
             `sale_price`,
             `broker_id`,
             `other_details`,`payment_mode`,`reference`)
VALUES ('$plot_id',
        '$customer',
        '$saledate',
        '$set_price',
        '$dealer',
        '$otherdetails','$payment_mode','$reference')";

 if(new SaveData($query)){
     $updplot = "UPDATE `plots` SET `cur_status` = 'Sold' WHERE `plot_id` = '$plot_id'";
 new SaveData($updplot);
 
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
        '$otherdetails','$master_land','3')";
 new SaveData($query);
 


echo "<script type= 'text/javascript'>alert('Sales Record Saved Successfully');</script>";
echo "<script language=javascript>window.location='sales_receipt.php?set_price=".$set_price.
        "&plot_id=".$plot_id.
        "&dealer=".$dealer.
        "&customer=".$customer.
        "&saledate=".$saledate.
        "&otherdetails=".$otherdetails.
          "&payment_mode=".$payment_mode.
          "&reference=".$reference.
        "';</script>";
new AuditTrail('Sold Plot id = '.$plot_id,'Admin');
 }else{
      echo "Error Saving";
 }

 

