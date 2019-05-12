<?php

$fname = $_POST['fname'];
$mname = $_POST['mname'];

$idno = $_POST['idno'];
$phone = $_POST['phone'];

$category =  $_POST['category'];

$qry = "INSERT INTO `staff`
            (`idno`,
             `first_name`,
             `middle_name`,
             `phone`,
             `category`)
VALUES (
        '$idno',
        '$fname',
        '$mname',
        '$phone',
        '$category')";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
           
            echo "<script language=javascript>window.location='staffs.php';</script>";
          
        } else {
       
            echo "<script type= 'text/javascript'>alert('Error! Staff not saved');</script>";
            echo "<script language=javascript>window.location='staffs.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




