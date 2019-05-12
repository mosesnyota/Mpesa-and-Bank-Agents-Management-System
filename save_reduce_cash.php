<?php

$floatAmnt = $_POST['floatAmnt'];
date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d"); 

include('dao/connect.php');

$statement = "update `cashsettings` set `cash_amount` = cash_amount - $floatAmnt";
$newcash = -$floatAmnt;
$ds ="INSERT INTO `cash_additions`(`amount`,`cash_ad_date`,trans_type)
VALUES ('$newcash','$today','Cash Reduction')";

$result = $db->query($statement);
$result2 = $db->query($ds);

if ($result) {
            echo "<script language=javascript>window.location='home.php';</script>";
        } else {
            
            echo "<script type= 'text/javascript'>alert('Error! Cash not Added.');</script>";
            echo "<script language=javascript>window.location='home.php';</script>";
        }