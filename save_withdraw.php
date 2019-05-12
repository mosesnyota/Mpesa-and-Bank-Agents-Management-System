<?php
date_default_timezone_set("Africa/Nairobi");

$trans_amount = $_POST['depoamount'];
$trans_date = date("Y-m-d H:i:s",time()); 
$trans_acct = $_POST['phoneaccnt'];
$trans_code = $_POST['transcode'];
$trans_name = $_POST['custname'];
$trans_idno = $_POST['idno'];





$accnt_id  = $_POST['accountT'];
include('dao/connect.php');
$statement = "INSERT INTO `transactions`
            (
             `trans_amount`,
             `trans_date`,
             `trans_acct`,
             `trans_code`,
             `trans_name`,
             `trans_idno`,
             `accnt_id`,
             `trans_type`)
VALUES (
        '$trans_amount',
        '$trans_date',
        '$trans_acct',
        '$trans_code',
        '$trans_name',
        '$trans_idno',
        '$accnt_id',
        'W')";
$result = $db->query($statement);

$stat = "UPDATE `cashsettings`
SET `cash_amount` =cash_amount - $trans_amount";
$result2 = $db->query($stat);


$stat2 = "UPDATE `float_settings`
SET `float_amount` = float_amount + $trans_amount
WHERE `accnt_id` = '$accnt_id'";
$result22 = $db->query($stat2);



if ($result) {
            echo "<script language=javascript>window.location='transact.php';</script>";
    } else {
        echo "<script type= 'text/javascript'>alert('Error! Withdraw not Recorded.');</script>";
        echo "<script language=javascript>window.location='transact.php';</script>";
    }