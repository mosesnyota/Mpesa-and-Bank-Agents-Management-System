<?php
$accountT = $_POST['accountT'];
$floatAmnt = $_POST['floatAmnt'];
date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d"); 

include('dao/connect.php');

$qry33 = "INSERT INTO `float_settings`
            (`float_amount`,`accnt_id`)VALUES ('$floatAmnt','$accountT') on duplicate key update  `float_amount` = float_amount + $floatAmnt";



$ds ="INSERT INTO `float_additions`(`amount`,`float_ad_date`,trans_type,accnt_id)
VALUES ('$floatAmnt','$today','External Float','$accountT')";



$result = $db->query($qry33);
$result3 = $db->query($ds);

if ($result) {
            echo "<script language=javascript>window.location='home.php';</script>";
        } else {
            
            echo "<script type= 'text/javascript'>alert('Error! Float not Added.');</script>";
           
            echo "<script language=javascript>window.location='home.php';</script>";
        }