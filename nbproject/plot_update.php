<?php

include("AuditTrail.php");
require_once("dao/SaveData.php");

$plot_num = str_replace("'","&",$_POST['plot_num']);  
$size = str_replace("'","&",$_POST['size']);
$titleno = str_replace("'","&",$_POST['titleno']);
$set_price = strip_tags($_POST['set_price']);


$plot_id = strip_tags($_POST['id']);




$query ="UPDATE `plots`
SET 
  `plot_num` = '$plot_num',
  `size` = '$size',
  `title_no` = '$titleno',
  `set_price` = '$set_price'
WHERE `plot_id` = '$plot_id'";


      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('Plot details Updated');</script>";
            echo "<script language=javascript>window.location='availableplots.php';</script>";
            new AuditTrail('Updated plot details: id '.$plot_num,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Error updating the details.');</script>";
        }

