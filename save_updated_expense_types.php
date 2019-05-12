<?php
$category = $_POST['category'];
$category_id = $_POST['id'];

$qry = "UPDATE `expense_types`
SET 
  `expense_type` = '$category'
WHERE `expense_type_id` = '$category_id'";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Expense Type not saved');</script>";
            echo "<script language=javascript>window.location='expense_types.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }



