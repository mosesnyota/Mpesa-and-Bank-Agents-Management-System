<?php
$cust_id = $_GET['id'];
$qry = "delete from `staff` where member_id= '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='staffs.php';</script>";
          
        } else {
           
            echo "<script type= 'text/javascript'>alert('Error! Staff not deleted');</script>";
            echo "<script language=javascript>window.location='staffs.php';</script>";
        }