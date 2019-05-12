<?php
date_default_timezone_set("Africa/Nairobi");
$trans_id = $_POST['id'];

$trans_date = date("Y-m-d h:i:s",time()); 
$trans_acct = $_POST['phoneaccnt'];
$trans_code = $_POST['transcode'];
$trans_name = $_POST['custname'];
$trans_idno = $_POST['idno'];

$accnt_id  = $_POST['accountT'];
$transtype  = $_POST['transtype'];
include('dao/connect.php');


$statement3 = "UPDATE `transactions`
SET 

  `trans_date` = '$trans_date',
  `trans_acct` = '$trans_acct',
  `trans_code` = '$trans_code',
  `trans_name` = '$trans_name',
  `trans_idno` = '$trans_idno',
  `accnt_id`   =  '$accnt_id',
  `trans_type` = '$transtype'
WHERE `trans_id` = '$trans_id'";

$result = $db->query($statement3);

if ($result) {
            echo "<script language=javascript>window.location='alltransactions.php';</script>";
        } else {
            
            echo "<script type= 'text/javascript'>alert('Error! Update not Recorded.');</script>";
            
           echo "<script language=javascript>window.location='alltransactions.php';</script>";
        }