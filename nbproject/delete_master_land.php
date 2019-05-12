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
 
 

 $query="delete from master_land where master_land_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Land Record Deleted');</script>
<script language=javascript>window.location='master_lands.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Land: '.$id,'Admin');
}

?>