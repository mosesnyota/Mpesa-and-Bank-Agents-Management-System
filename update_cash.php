<?php

$floatAmnt = $_POST['floatAmnt'];
date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d"); 
$accountT = $_POST['accountT'];
include('dao/connect.php');

$statement = "update `cashsettings` set `cash_amount` = cash_amount + $floatAmnt";

$statement2 = "UPDATE `float_settings` SET float_amount = float_amount - $floatAmnt where accnt_id = $accountT";

$ds ="INSERT INTO `cash_additions`(`amount`,`cash_ad_date`,trans_type)
VALUES ('$floatAmnt','$today','Float withdrawal')";

$result = $db->query($statement);
$result2 = $db->query($statement2);
$result3 = $db->query($ds);

if ($result) {
     echo "<script language=javascript>window.location='home.php';</script>";
} else {
    echo "<script type= 'text/javascript'>alert('Error! Cash not Added.');</script>";
    echo "<script language=javascript>window.location='home.php';</script>";
}