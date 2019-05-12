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
//$address = strip_tags($_POST['address']);
$datejoined = strip_tags($_POST['datejoined']);


$query = "INSERT INTO `brokers`(`idno`,`first_name`,`middle_name`,`last_name`,`kra_pin`,`email`,`phone`,`dob`,gender,date_joined)
VALUES ('$idpas','$fname','$mname','$lname','$kra','$email','$phone','$dob','$gender','$datejoined')";

      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('New Dealer Recorded Successfully');</script>";
            echo "<script language=javascript>window.location='broker_new.php';</script>";
            new AuditTrail('Added New Staff: '.$idpas,'Admin');
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Broker not Added.');</script>";
        }

