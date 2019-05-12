<?php

require('fpdf.php');

function getTypePay($id){
                                 include('dao/connect.php');
                                 $qey = "SELECT `expense_type` FROM `expense_types` WHERE `expense_type_id` = '$id'";
                             $result = $db->query($qey);
                                  while ($row = $result->fetch_assoc()) {
                                      return $row['expense_type'];
                                  }
                             }

function getLand($id){
    include('dao/connect.php');
                      $resultf = $db->query("SELECT * FROM `master_land` where master_land_id=$id");
                    
                      while ($rowf = $resultf->fetch_assoc()) {
                        return strtoupper($rowf['name']." ". $rowf['location']);
                      }
}
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
        //$this->Image($barcode,150,10,0,0);
        //$this->Text(151, 25, $hcode);
        $this->SetFont('times', 'B', 20);

        $this->Cell(195, 7, $name, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', 'B', 13);
        $this->Cell(195, 6, $name2, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', '', 12);
        $this->Cell(195, 6, "Head Office Thika: $headoffice, Email: $email", 0, 0, "C", 0);
        $this->Ln();
        if(isset($_GET['id']) ){
        $this->Cell(195, 6, "PAYMENTS REPORT FOR ". getLand($_GET['id']), 0, 0, "C", 0);
        }else{
            $this->Cell(195, 6, "PAYMENTS REPORT FOR ALL LANDS", 0, 0, "C", 0);
        }
        $this->Line(10, 36, 200, 36);
        $this->Ln();
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
$pdf->Cell(35, 7, "Expense Type", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Land", 1, 0, "C", 1);
$pdf->Cell(23, 7, "Date", 1, 0, "C", 1);

$pdf->Cell(30, 7, "Mode", 1, 0, "C", 1);

$pdf->Cell(35, 7, "Paid By", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Amount", 1, 0, "C", 1);


                                                   
                                                  


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);



                             if(isset($_GET['id']) ){
                                 
                                 $master = $_GET['id'];
                                 $statement = "SELECT payment_type, `name`,`location`,`plot_num`,`others`,`reference`,`mode`,`amount`,`date_of_pay`, `idno`,`first_name`,`middle_name` FROM `member`
JOIN `payments` ON member.`member_id` = payments.`member_id` JOIN `plots` ON `payments`.`plot_id` = plots.`plot_id` 
JOIN `master_land` ON plots.`master_land_id` = `master_land`.`master_land_id` where  `master_land`.`master_land_id`='$master' order by date_of_pay";
                             
                             }else{
                                 $statement = "SELECT payment_type, `name`,`location`,`plot_num`,`others`,`reference`,`mode`,`amount`,`date_of_pay`, `idno`,`first_name`,`middle_name` FROM `member`
JOIN `payments` ON member.`member_id` = payments.`member_id` JOIN `plots` ON `payments`.`plot_id` = plots.`plot_id` 
JOIN `master_land` ON plots.`master_land_id` = `master_land`.`master_land_id` order by date_of_pay";
                                 }
                             

include('dao/connect.php');
$result = $db->query($statement);
$num = 0;
$fill = 0;
$total = 0;
while ($row = $result->fetch_assoc()) {
    $num++;
    $payment_mode = $row['mode'];
    if ($payment_mode == 'cash') {
        $payment_mode = "Cash";
    } else if ($payment_mode == 'mpesa') {
        $payment_mode = "Mpesa";
    } else if ($payment_mode == 'cheque') {
        $payment_mode = "Cheque";
    } else if ($payment_mode == 'transfer') {
        $payment_mode = "Bank Transfer";
    } else if ($payment_mode == 'deposit') {
        $payment_mode = "Direct Deposit";
    } else if ($payment_mode == 'others') {
        $payment_mode = "Other Means";
    }
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setFont("times", "", "11");
    $pdf->Cell(10, 7, $num, 1, 0, "L", $fill);
    $pdf->Cell(35, 7, str_replace("&", "'", getTypePay($row['payment_type'])), 1, 0, "L", $fill);
    $pdf->Cell(35, 7, str_replace("&", "'", $row['name'].",No: ". $row['plot_num']), 1, 0, "L", $fill);
    $pdf->Cell(23, 7, date_format(date_create($row['date_of_pay']), "d-m-Y"), 1, 0, "L", $fill);
    
    $pdf->Cell(30, 7, $payment_mode, 1, 0, "L", $fill);

     $pdf->Cell(35, 7, $row['first_name'] ."  ".$row['middle_name'], 1, 0, "L", $fill);
    
    $pdf->Cell(25, 7, number_format($row['amount'], 2, ".", ","), 1, 0, "R", $fill);

    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 40);

       
        $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(35, 7, "Expense Type", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Land", 1, 0, "C", 1);
$pdf->Cell(23, 7, "Date", 1, 0, "C", 1);

$pdf->Cell(30, 7, "Mode", 1, 0, "C", 1);

$pdf->Cell(35, 7, "Paid By", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Amount", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 45;
    }
    
    

    $pdf->setXY($x, $y);
    
    $total = $total + $row['amount'];
}
    $y += 7;
    $fill = !$fill;
    $pdf->Cell(133, 7, "Total Payments", 1, 0, "C", $fill);
    $pdf->Cell(60, 7, "Ksh. ".number_format($total,2), 1, 0, "R", $fill);
$pdf->Output();
?>