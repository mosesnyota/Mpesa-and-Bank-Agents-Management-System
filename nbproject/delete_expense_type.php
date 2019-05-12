<?php

if($_GET['id'])
{
$id=$_GET['id'];

 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 

 $query="delete from expense_types where expense_type_id = '$id'";
 require_once("dao/SaveData.php");
 new SaveData($query);
 
 ?>
<script language=javascript>alert('Expense Type Deleted');</script>
<script language=javascript>window.location='expense_types.php';</script>

<?php
include("audittrail.php");
new AuditTrail('Deleted Expense Type: '.$id,'Admin');
}

?>