<?php
$cust_id = $_GET['id'];
$qry = "DELETE
FROM `products`
WHERE `product_id` = '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Product Deleted Successfully');</script>";

            echo "<script language=javascript>window.location='products.php';</script>";
          
        } else {
            $error = $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Product not deleted $error');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
        }