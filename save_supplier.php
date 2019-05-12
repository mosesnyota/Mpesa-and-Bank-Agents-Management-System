<?php

$company = $_POST['fname'];
$contactperson = $_POST['mname'];

$phone = $_POST['phone'];
$emailadd = $_POST['emailadd'];


$qry = "INSERT INTO `suppliers`
            (`company_name`,
             `contact_person`,
             `phone`,
             `emailadd`)
VALUES ('$company',
        '$contactperson',
        '$phone',
        '$emailadd')";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
           
            echo "<script language=javascript>window.location='suppliers.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Supplier not saved');</script>";
            echo "<script language=javascript>window.location='suppliers.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




