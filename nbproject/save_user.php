<?php

include("audittrail.php");
require_once("dao/SaveData.php");

$fname = str_replace("'","&",$_POST['firstname']);  
$mname = str_replace("'","&",$_POST['middlename']);
$lname = str_replace("'","&",$_POST['lastname']);
$idpas = strip_tags($_POST['idno']);
$gender=strip_tags($_POST['gender']);
$kra = strip_tags($_POST['kra']);
$phone = strip_tags($_POST['phone']);
$email = strip_tags($_POST['email']);
$dob = strip_tags($_POST['dob']);
$datejoined = strip_tags($_POST['datejoined']);
$category = strip_tags($_POST['category']);


$query = "INSERT INTO `staff`(`idno`,`first_name`,`middle_name`,`last_name`,`kra_pin`,`email`,`phone`,`dob`,gender,date_joined,category)
VALUES ('$idpas','$fname','$mname','$lname','$kra','$email','$phone','$dob','$gender','$datejoined','$category')";

      if (new SaveData($query)) {
          
          $jry = "INSERT INTO `sys_users`(`username`,`passwrd`,`user_level`) VALUES ('$idpas','$idpas','$category')";
          new SaveData($jry);
            echo "<script type= 'text/javascript'>alert('New Staff Recorded Successfully');</script>";
            echo "<script language=javascript>window.location='member_new.php';</script>";
            new AuditTrail('Added New Staff: '.$idpas,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Staff not Added.');</script>";
        }

