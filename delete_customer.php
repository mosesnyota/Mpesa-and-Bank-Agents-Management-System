<?php
$cust_id = $_GET['id'];
$qry = "delete from `customer` where cust_id= '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Customer Deleted Successfully');</script>";

            echo "<script language=javascript>window.location='customers.php';</script>";
          
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Customer not deleted');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
        }