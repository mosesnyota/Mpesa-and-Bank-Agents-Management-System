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

$category = strip_tags($_POST['category']);


$id = strip_tags($_POST['id']);



$query = "UPDATE `staff`
SET 
  `idno` = '$idpas',
  `first_name` = '$fname',
  `middle_name` = '$mname',
  `last_name` = '$lname',
  `kra_pin` = '$kra',
  `email` = '$email',
  `phone` = '$phone',
   category ='$category',
  `gender` = '$gender'

WHERE `member_id` = '$id'";

      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert(' Staff Updated Successfully');</script>";
            echo "<script language=javascript>window.location='all_users.php';</script>";
            new AuditTrail('Added New Staff: '.$idpas,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Member not Added.');</script>";
        }

