<?php

include("audittrail.php");
require_once("dao/SaveData.php");

foreach($_POST as $key => $value)
{
    if($key == 'myid'){
        
    }else{
        $role = $_POST['myid'];
        $dyd = "INSERT INTO `file_rights`(`file_id`,`role_id`,`approved`) VALUES ('$key','$role','$value')"
                . "ON DUPLICATE KEY UPDATE approved = '$value'";
        
        new SaveData($dyd);
    }
 
    echo "<script type= 'text/javascript'>alert('Updated Rights Successfully');</script>";
    echo "<script language=javascript>window.location='assign_rights.php?id=".$role."';</script>";
    new AuditTrail('Updated Rights Successfully: '.$role,'Admin');
 
}
