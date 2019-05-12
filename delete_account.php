<?php
$cust_id = $_GET['id'];
$qry = "delete from accounts where accnt_id= '$cust_id'";
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Account Deleted Successfully');</script>";
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Account not deleted');</script>";
            echo "<script language=javascript>window.location='allaccounts.php';</script>";
        }