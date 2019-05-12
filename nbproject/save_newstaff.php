<?php

include("AuditTrail.php");
require_once("dao/SaveData.php");

$fname = str_replace("'","&",$_POST['firstname']);  
$mname = str_replace("'","&",$_POST['middlename']);
$lname = str_replace("'","&",$_POST['lastname']);
$idpas = strip_tags($_POST['idno']);
$gender=strip_tags($_POST['gender']);
$kra = strip_tags($_POST['kra']);
$phone = strip_tags($_POST['phone']);
$email = strip_tags($_POST['email']);
$project = strip_tags($_POST['project']);
$department = strip_tags($_POST['department']);
$education = strip_tags($_POST['education']);


$query = "INSERT INTO staff(idno,first_name,middle_name,last_name,gender,kra_pin,phone,email)VALUES "
        . "('".$idpas."','".$fname."','".$mname."','".$lname."','".$gender."','".$kra."','".$phone."','".$email."')";


      if (new SaveData($query)) {
            echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
            echo "<script language=javascript>window.location='newstaff.php';</script>";
            
        } else {
            echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
        }
new AuditTrail('Added New Staff: '.$idpas,'Admin');
