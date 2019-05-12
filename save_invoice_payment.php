<?php

$account = $_POST['pay_from'];
$invoice_id = $_POST['id'];
$todate = $_POST['todate'];
$amount = $_POST['amount1'];
$new_amount = -$amount;
$paidto = "Paid: ".$_POST['paidto'];

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


include('dao/connect.php');
$finalqry = "UPDATE `invoice`
SET `pay_status` = 'Paid'
WHERE `invoice_id` = '$invoice_id'";

$state7 = $connection->query($finalqry);

echo "<script type= 'text/javascript'>alert('Invoice Paid Successfully');</script>";
echo "<script language=javascript>window.location='invoices.php';</script>";