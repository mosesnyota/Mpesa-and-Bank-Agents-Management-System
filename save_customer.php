<?php
if(isset($_POST['mname'])){
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$idno = $_POST['idno'];
$phone = $_POST['phone'];
$emailadd = $_POST['emailadd'];


$qry = "INSERT INTO `customer`
(`fname`,`mname`,`lname`,`idno`,`phone`,`email`)
VALUES ('$fname','$mname','$lname','$idno','$phone','$emailadd')";




try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Customer Recorded Successfully');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
          
        } else {
       
            echo "<script type= 'text/javascript'>alert('Error! Customer not saved');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




}