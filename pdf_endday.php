<?php

function getCashBalance(){
    include('dao/connect.php');
    $statement = "SELECT `cash_amount` FROM `cashsettings` ";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['cash_amount'];
      }
    return $deposits;
}
function getAllSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`total_amount`) AS total FROM `sales` WHERE `sales_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function getPaidSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount_paid`) AS total FROM `sales` WHERE `sales_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}


function getCreditSales(){
    include('dao/connect.php');
    $statement = "SELECT SUM(total_amount - amount_paid) AS total FROM sales WHERE sales_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}


function cashAdditions(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) AS total FROM `cash_additions` WHERE `amount` > 0 AND `cash_ad_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function payouts(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) AS total FROM `cash_additions` WHERE `amount` < 0 AND `cash_ad_date` = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return abs($deposits);
}




function floatAdditions(){
    include('dao/connect.php');
    $statement = "SELECT SUM(amount) AS total FROM float_additions WHERE amount > 0 AND float_ad_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}

function creditPayments(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount`) as total FROM `credit_sale_payments` WHERE pay_date = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['total'];
      }
    return $deposits;
}




require('fpdf.php');

class PeoplePDF extends FPDF {

//Page header
    function Header() {



        $num = 0;
        $fill = 0;
        include('dao/connect.php');
        $result = $db->query("select * from institution_details");
        while ($de = $result->fetch_assoc()) {
            $name = $de['institution_name'];
            $name2 = $de['name_part2'];
            $address = $de['box'] . " , " . $de['place'] . " Tel: " . $de['telphone'];
            //$logref=$de['logref'];
            $phone = $de['telphone'];
            $headoffice = $de['head_office'];
            $email = $de['email'];
            $web = $de['website'];
        }
        $logo = "images/logo.png";
        $date = date("Y-m-d H:i:s");
        $y = date("Y");
        $m = date("m");
        $d = date("d");
        $hr = date("H");
        $min = date("i");
        $sec = date("s");
        $hcodes = $y . $m . $d . $hr;
        $mins = $min . $sec;

        $hcode = $hcodes . $mins;

        $barcode = "images/barcode.PNG";

        $this->SetFont('times', '', 8);
        $this->Image($logo, 15, 10, 20, 20);
        $this->Image($barcode, 165, 10, 0, 0);
        $this->Text(175, 25, $hcode);

        $this->SetFont('times', '', 8);
        //$this->Image($barcode,150,10,0,0);
        //$this->Text(151, 25, $hcode);
        $this->SetFont('times', 'B', 28);

        $this->Cell(195, 7, $name, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', 'B', 14);
        $this->Cell(195, 6, $name2, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', '', 12);
        $this->Cell(195, 6, "Office: $headoffice, Email: $email", 0, 0, "C", 0);
        $this->Ln();

        $this->Cell(195, 6, "END OF DAY : ".date("d-m-Y") , 0, 0, "C", 0);
        $this->Line(10, 36, 200, 36);
        $this->Ln();



        $this->Ln(20);
    }

//Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 9);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages(); //for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
//table header
$pdf->SetFillColor(128, 128, 128); //gray
$pdf->setFont("times", "", "11");
$pdf->setXY(10, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(50, 7, "Account", 1, 0, "C", 1);
        $pdf->Cell(60, 7, "Name/Acc", 1, 0, "C", 1);

        $pdf->Cell(20, 7, "Type", 1, 0, "C", 1);
        $pdf->Cell(50, 7, "Amount", 1, 0, "C", 1);

      


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);

$statement = "SELECT `account_type`,`account_name` , `trans_type`, SUM(`trans_amount`) AS total FROM `accounts` 
JOIN `transactions` ON accounts.`accnt_id` = `transactions`.`accnt_id`  WHERE DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE() GROUP BY `account_type`,`account_name` , `trans_type`";
                      
include('dao/connect.php');
$result = $db->query($statement);
$num = 0;
$fill = 0;
$totalWithdrawal= 0;
$totalDeposits = 0;
while ($row = $result->fetch_assoc()) {
    $type = $row['trans_type'];
    if($type == 'W'){
                    $totalWithdrawal += $row['total'];
                }else{
                    $totalDeposits += $row['total'];
                }
    $num++;
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setFont("times", "", "11");

    $pdf->Cell(10, 7, $num, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, str_replace("&", "'", $row['account_type']), 1, 0, "L", $fill);
    $pdf->Cell(60, 7, $row['account_name'], 1, 0, "L", $fill);
    $pdf->Cell(20, 7, $row['trans_type'], 1, 0, "C", $fill);
    $pdf->Cell(50, 7, number_format($row['total'],2), 1, 0, "R", $fill);
   
    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(20, 40);
        $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(50, 7, "Account", 1, 0, "C", 1);
        $pdf->Cell(60, 7, "Name/Acc", 1, 0, "C", 1);
        $pdf->Cell(20, 7, "Type", 1, 0, "C", 1);
        $pdf->Cell(50, 7, "Amount", 1, 0, "C", 1);


        $pdf->Ln();
        $y = 45;
    }

    $pdf->setXY($x, $y);
}


$pdf->Cell(190, 7, "", 1, 0, "C", 1);

$pdf->Ln();
$pdf->Cell(190, 7, "Summary of Transactions", 1, 0, "C", 0);
$pdf->Ln();
$pdf->Cell(95, 7, "Total Withdrawals", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format($totalWithdrawal,2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(95, 7, "Total Deposits", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format($totalDeposits,2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(95, 7, "Cash Addition", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(cashAdditions(),2), 1, 0, "L", 0);

$pdf->Ln();
$pdf->Cell(95, 7, "Float Addition", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(floatAdditions(),2), 1, 0, "L", 0);

$pdf->Ln();
$pdf->Cell(95, 7, "Paid Out", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(payouts(),2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(95, 7, "Total Sales", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(getAllSales(),2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(105, 7, "Cash Sales", 1, 0, "R", 0);
$pdf->Cell(85, 7, "Ksh. ".number_format(getPaidSales(),2), 1, 0, "L", 0);

$pdf->Ln();
$pdf->Cell(105, 7, "Sales on Credit", 1, 0, "R", 1);
$pdf->Cell(85, 7, "Ksh. ".number_format(getCreditSales(),2), 1, 0, "L", 1);


$pdf->Ln();
$pdf->Cell(95, 7, "Payments for Previous Credit Sales", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(creditPayments(),2), 1, 0, "L", 0);

$pdf->Ln();
$pdf->Cell(95, 7, "Expected Cash", 1, 0, "R", 0);
$pdf->Cell(95, 7, "Ksh. ".number_format(getCashBalance(),2), 1, 0, "L", 0);

$pdf->Output();
?>