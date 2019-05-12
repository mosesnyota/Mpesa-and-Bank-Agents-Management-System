<?php
$category = $_POST['category'];

$qry = "INSERT INTO `product_category`(`category`)VALUES ('$category')";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='product_categories.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Product Category not saved');</script>";
            echo "<script language=javascript>window.location='product_categories.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }



