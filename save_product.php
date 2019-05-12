<?php
include('dao/connect.php');
$product_category = mysqli_real_escape_string($connection,$_POST['product_category']);
$product_name = mysqli_real_escape_string($connection,$_POST['product_name']);
$wholesale_price = mysqli_real_escape_string($connection,$_POST['wholesale_price']);
$retail_price = mysqli_real_escape_string($connection,$_POST['retail_price']);
$purchase_price = mysqli_real_escape_string($connection,$_POST['purchase_price']);
$qty = mysqli_real_escape_string($connection,$_POST['qnty']);




$qry = "INSERT INTO `products`
            (`product_category`,`product_value`,`wholesale_price`,`retail_price`,`purchase_price`,qnty)
VALUES ('$product_category','$product_name','$wholesale_price','$retail_price','$purchase_price','$qty')";



 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Product Saved Successfully');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
          
        } else {
            
            echo "<script type= 'text/javascript'>alert('Error! Product not saved');</script>";
            echo "<script language=javascript>window.location='products.php';</script>";
        }




