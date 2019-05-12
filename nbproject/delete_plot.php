<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?><?php

if($_GET['id'])
{
$id=$_GET['id'];

 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 

 $query="delete from plots where plot_id = '$id'";

 require_once("dao/SaveData.php");
 
 if(new SaveData($query)){ ?>
     <script language=javascript>alert('Plot Record Deleted');</script>
     <script language=javascript>window.location='availableplots.php';</script>
 
     <?php
include("audittrail.php");
new AuditTrail('Deleted Plot: '.$id,'Admin');
}else{ ?>
     <script language=javascript>alert('Error Deleting plot');</script>
   <?php  
}
     }
 
 
 ?>




?>