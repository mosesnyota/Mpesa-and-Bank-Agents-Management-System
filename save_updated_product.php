<?php
include('dao/connect.php');

$product_id = mysqli_real_escape_string($connection,$_POST['id']);

$product_category = mysqli_real_escape_string($connection,$_POST['product_category']);
$product_name = mysqli_real_escape_string($connection,$_POST['product_name']);
$wholesale_price = mysqli_real_escape_string($connection,$_POST['wholesale_price']);
$retail_price = mysqli_real_escape_string($connection,$_POST['retail_price']);
$purchase_price = mysqli_real_escape_string($connection,$_POST['purchase_price']);
$qty = mysqli_real_escape_string($connection,$_POST['qnty']);

$qry = "UPDATE `products` SET 
  `product_category` = '$product_category',
  `product_value` = '$product_name',
  `wholesale_price` = '$wholesale_price',
  `retail_price` = '$retail_price',
  `purchase_price` = '$purchase_price',
      qnty = '$qty'
WHERE `product_id` = '$product_id'";



 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Product Updated Successfully');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
          
        } else {
            $err = $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Product not saved $err');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
        }





