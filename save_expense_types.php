<?php
$category = $_POST['category'];

$qry = "INSERT INTO `expense_types`
            (
             `expense_type`)
VALUES (
        '$category')";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Expense Category not saved');</script>";
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }



