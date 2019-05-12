<?php
$cust_id = $_GET['id'];
$qry = "delete from `product_category` where category_id= '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='product_categories.php';</script>";
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Category not deleted');</script>";
            echo "<script language=javascript>window.location='product_categories.php';</script>";
        }