<?php
date_default_timezone_set("Africa/Nairobi");
$category = $_POST['category'];

$description = $_POST['details'];
$paidto = $description;

$expense_amount = $_POST['amount'];
$amount = $expense_amount;
$new_amount = -$amount;

$expense_date = date("Y-m-d",time());
$todate = $expense_date;

$account = $_POST['pay_from'];

$qry = "INSERT INTO `expenses`(`expense_date`,`expense_amount`,`description`,`expense_type`)
VALUES ('$expense_date','$expense_amount','$description','$category')";


 include('dao/connect.php');
 $state = $connection->query($qry);




if($account == 'cash'){
    //reduce cash
    
    $qry1 = "UPDATE `cashsettings` SET `cash_amount` = `cash_amount` - $amount";
    
    $qry2 = "INSERT INTO `cash_additions`
            (`amount`,`cash_ad_date`,`trans_type`)
VALUES (
        '$new_amount',
        '$todate',
        '$paidto')";
    
    include('dao/connect.php');
    $state1 = $connection->query($qry1);
    $state2 = $connection->query($qry2);
}else if($account == 'other'){
    //do nothing
}else{
    //other accounts, reduce float
    
    $qry4 = "UPDATE `float_settings`
SET `float_amount` = float_amount - $amount
WHERE `accnt_id` = '$account'";
    include('dao/connect.php');
    $state4 = $connection->query($qry4);
    
    $qry5 = "INSERT INTO `float_additions`
            (
             `amount`,
             `float_ad_date`,
             `trans_type`,
             `accnt_id`)
VALUES (
        '$new_amount',
        '$todate',
        '$paidto',
        '$account')";
    $state5 = $connection->query($qry5);
}







 
 if ($state) {
            echo "<script language=javascript>window.location='expense.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Expense  not saved');</script>";
            echo "<script language=javascript>window.location='expense.php';</script>";
        }




