<?php
if(isset($_POST['mname'])){
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$cust_id = $_POST['id'];
$idno = $_POST['idno'];
$phone = $_POST['phone'];
$emailadd = 0;
$emailadd = $_POST['emailadd'];

$todate =date("Y-m-d");

$qry = "UPDATE `customer`
SET 
  `fname` = '$fname',
  `mname` = '$mname',
  `lname` = '$lname',
  `idno` = '$idno',
  `phone` = '$phone'
WHERE `cust_id` = '$cust_id'";


if($emailadd > 0){
    $sale = "INSERT INTO `sales`
            (
             `sales_date`,
             `total_amount`,
             `amount_paid`,
             `customer_id`,
             `statuss`,
             `mode_of_pay`,
             `pricetype`)
VALUES (
        '$todate',
        '$emailadd',
        '0',
        '$cust_id',
        'Unpaid',
        'Cash',
        'Balance')";
    include('dao/connect.php');
 $state2 = $connection->query($sale);
 
    
}


try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Customer Updated Successfully');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
          
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Customer not saved');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




}