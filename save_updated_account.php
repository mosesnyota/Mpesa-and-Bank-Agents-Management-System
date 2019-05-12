<?php
$accntinfo = $_POST['accntinfo'];
$accntname = $_POST['accntname'];
$otherinfo = $_POST["otherinfo"]; 
$id = $_POST["id"]; 
include('dao/connect.php');
$statement = "UPDATE `accounts`
SET 
  `account_type` = '$accntinfo',
  `account_name` = '$accntname',
  `other_info` = '$otherinfo'
WHERE `accnt_id` = '$id'";
$result = $db->query($statement);

if ($result) {
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Account not updated.');</script>";
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        }