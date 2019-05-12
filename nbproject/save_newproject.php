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

$purchase_date= strip_tags($_POST['purchase_date']);
$purchase_price = strip_tags($_POST['purchase_price']);


$query = "INSERT INTO `master_land`
            (`name`,
             `location`,
             `title_no`,
             `size`,
             `registered_holder`,
             `holder_id`,
             `holder_kra`,
             `holder_phone`,
             `purchase_price`,
             `status`,
             `purchase_date`)
VALUES ('$landname',
        '$location',
        '$titleno',
        '$size',
        '$holder',
        '$holder_id',
        '$holder_kra',
        '$holder_phone',
        '$purchase_price',
        '$status',
        '$purchase_date')";

      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('Master Land Recorded Successfully');</script>";
            echo "<script language=javascript>window.location='newproject.php';</script>";
            new AuditTrail('Added New Master Land: '.$landname,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
        }

