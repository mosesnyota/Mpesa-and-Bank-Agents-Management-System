<?php
$cust_id = $_GET['id'];
$qry = "DELETE
FROM `expense_types`
WHERE `expense_type_id` = '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Expense Types not deleted');</script>";
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        }