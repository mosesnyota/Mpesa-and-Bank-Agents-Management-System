<?php

if($_GET['id'])
{
$id=$_GET['id'];

 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 

 $query="delete from member where member_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Member Deleted');</script>
<script language=javascript>window.location='member_list.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Member: '.$id,'Admin');
}

?>