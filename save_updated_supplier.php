<?php


$supplier_id = $_POST['id'];
$company = $_POST['fname'];
$contactperson = $_POST['mname'];

$phone = $_POST['phone'];
$emailadd = $_POST['emailadd'];


$qry = "UPDATE `suppliers`
SET 
  `company_name` = '$company',
  `contact_person` = '$contactperson',
  `phone` = '$phone',
  `emailadd` = '$emailadd'
WHERE `supplier_id` = '$supplier_id'";
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




