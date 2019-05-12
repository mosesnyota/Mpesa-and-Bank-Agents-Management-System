<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?><?php

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

//$address = strip_tags($_POST['address']);


$id = strip_tags($_POST['id']);



$query = "UPDATE `brokers`
SET 
  `idno` = '$idpas',
  `first_name` = '$fname',
  `middle_name` = '$mname',
  `last_name` = '$lname',
  `kra_pin` = '$kra',
  `email` = '$email',
  `phone` = '$phone',
  `gender` = '$gender'
WHERE `member_id` = '$id'";

      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('Broker Updated Successfully');</script>";
            echo "<script language=javascript>window.location='brokers.php';</script>";
            new AuditTrail('Added New Staff: '.$idpas,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Broker not Updated.');</script>";
        }

