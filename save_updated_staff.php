<?php

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$member_id = $_POST['id'];
$idno = $_POST['idno'];
$phone = $_POST['phone'];
$category =  $_POST['category'];



$qry = "UPDATE `staff`
SET 
  `idno` = '$idno',
  `first_name` = '$fname',
  `middle_name` = '$mname',
  `phone` = '$phone',
  `category` = '$category'
WHERE `member_id` = '$member_id'";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {

            echo "<script language=javascript>window.location='staffs.php';</script>";
          
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Staff not saved');</script>";
            echo "<script language=javascript>window.location='staffs.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




