<?php
$accountT = $_POST['accountT'];
$floatAmnt = $_POST['floatAmnt'];
date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d"); 
$today2  = date("Y-m-d H:i:s",time()); 



include('dao/connect.php');

$ds ="INSERT INTO `float_additions`(`amount`,`float_ad_date`,trans_type,accnt_id)
VALUES ('$floatAmnt','$today2','Cash Bank Deposit','$accountT')";



$qry33 = "INSERT INTO `float_settings`
            (`float_amount`,`accnt_id`)VALUES ('$floatAmnt','$accountT') on duplicate key update  `float_amount` = float_amount + $floatAmnt";




$statement2 = "update `cashsettings` set cash_amount = cash_amount - $floatAmnt";


$result = $db->query($qry33);
$result3 = $db->query($ds);
$result4 = $db->query($statement2);

if ($result) {
            echo "<script language=javascript>window.location='home.php';</script>";
        } else {
            
            echo "<script type= 'text/javascript'>alert('Error! Float not Added.');</script>";
         
            echo "<script language=javascript>window.location='home.php';</script>";
        }