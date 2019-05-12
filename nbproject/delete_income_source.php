<?php

if($_GET['id'])
{
$id=$_GET['id'];

 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 

 $query="delete from income_sources where source_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Income Type Deleted');</script>
<script language=javascript>window.location='income_sources.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Income Type: '.$id,'Admin');
}

?>