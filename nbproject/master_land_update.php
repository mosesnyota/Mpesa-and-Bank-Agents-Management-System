<?php

include("AuditTrail.php");
require_once("dao/SaveData.php");

$landname = str_replace("'","&",$_POST['landname']);  
$location = str_replace("'","&",$_POST['location']);
$titleno = str_replace("'","&",$_POST['titleno']);
$size = strip_tags($_POST['size']);
$holder=strip_tags($_POST['holder']);
$status = strip_tags($_POST['status']);
$holder_id = strip_tags($_POST['holder_id']);
$holder_kra= strip_tags($_POST['holder_kra']);
$holder_phone = strip_tags($_POST['holder_phone']);
$master_land_id = strip_tags($_POST['id']);

$purchase_price = strip_tags($_POST['purchase_price']);


$query ="UPDATE `master_land`
SET 
  `name` = '$landname',
  `location` = '$location',
  `title_no` = '$titleno',
  `size` = '$size',
  `registered_holder` = '$holder',
  `holder_id` = '$holder_id',
  `holder_kra` = '$holder_kra',
  `holder_phone` = '$holder_phone',
  `purchase_price` = '$purchase_price',
  `status` = '$status'
WHERE `master_land_id` = '$master_land_id'";


      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('Master Land Recorded Updated');</script>";
            echo "<script language=javascript>window.location='master_lands.php';</script>";
            new AuditTrail('Updated Master Land: '.$landname,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Data not successfully Updated.');</script>";
        }

