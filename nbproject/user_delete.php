<?php

if($_GET['id'])
{
$id=$_GET['id'];

 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 

 $query="delete from staff where member_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Staff Deleted');</script>
<script language=javascript>window.location='all_users.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Member: '.$id,'Admin');
}

?>