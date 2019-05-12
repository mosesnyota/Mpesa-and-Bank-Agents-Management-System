<?php
$cust_id = $_GET['id'];
$qry = "DELETE
FROM `expenses`
WHERE `expense_id` = '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='expense.php';</script>";
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Expense  not deleted');</script>";
            echo "<script language=javascript>window.location='expense.php';</script>";
        }