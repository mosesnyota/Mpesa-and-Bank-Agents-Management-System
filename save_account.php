<?php
$accntinfo = $_POST['accntinfo'];
$accntname = $_POST['accntname'];
$otherinfo = $_POST["otherinfo"]; 

include('dao/connect.php');
$statement = "INSERT INTO `accounts`
            (
             `account_name`,
             `account_type`,
             `other_info`)
VALUES (
        '$accntname',
        '$accntinfo',
        '$otherinfo')";
$result = $db->query($statement);

if ($result) {
    
    
    
    
    
    
    
    
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Account not Added.');</script>";
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        }