<?php
$cust_id = $_GET['id'];
$qry = "delete from `suppliers` where supplier_id= '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Supplier Deleted Successfully');</script>";

            echo "<script language=javascript>window.location='suppliers.php';</script>";
          
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Supplier not deleted');</script>";
            echo "<script language=javascript>window.location='suppliers.php';</script>";
        }