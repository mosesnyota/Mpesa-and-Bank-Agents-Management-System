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
 
 

 $query="delete from brokers where broker_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Broker Deleted');</script>
<script language=javascript>window.location='brokers.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Broker: '.$id,'Admin');
}

?>