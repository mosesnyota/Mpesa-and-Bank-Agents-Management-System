<?php

require('fpdf.php');


class PeoplePDF extends FPDF {

//Page header
function Header(){
    
    

$num=0;
$fill=0;
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
        //$this->Image($logo, 15, 10, 20, 20);
       // $this->Image($barcode, 255, 10, 0, 0);
       // $this->Text(265, 25, $hcode);

        $this->SetFont('times', '', 8);
        //$this->Image($barcode,150,10,0,0);
        //$this->Text(151, 25, $hcode);
        $this->SetFont('times', 'B', 28);

        $this->Cell(290, 7, $name, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', 'B', 14);
        $this->Cell(290, 6, $name2, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', '', 12);
        $this->Cell(290, 6, "Head Office Thika: $headoffice, Email: $email", 0, 0, "C", 0);
        $this->Ln();

        $this->Cell(290, 6, "Available Plots :  Call " . $phone, 0, 0, "C", 0);
        $this->Line(10, 36, 290, 36);
        $this->Ln();



        $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',9);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
	
}

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black

 
 
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(20, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(60, 7, "Name", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Location", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Size", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Title No.", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Holder", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Date", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Status", 1, 0, "C", 1);


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
	
$statement = "SELECT * FROM `master_land` ORDER BY `purchase_date` DESC";
include('dao/connect.php');
$result = $db->query($statement);
$num=0;
$fill=0;
 while($row = $result->fetch_assoc()) {
$num++;
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","11");
	
	
                $pdf->Cell(10, 7, $num, 1, 0, "L", 1);
                $pdf->Cell(60, 7, strtoupper(str_replace("&","'",$row['name'])), 1, 0, "L", $fill);
                $pdf->Cell(50, 7, strtoupper(str_replace("&","'",$row['location'])), 1, 0, "L", $fill);
                $pdf->Cell(25, 7, strtoupper($row['size']), 1, 0, "L", $fill);
                $pdf->Cell(25, 7, strtoupper($row['title_no']), 1, 0, "L", $fill);
                $pdf->Cell(40, 7, strtoupper($row['registered_holder']), 1, 0, "L", $fill);
                $pdf->Cell(25, 7, $row['purchase_date'], 1, 0, "L", $fill);
                $pdf->Cell(30, 7, strtoupper($row['status']), 1, 0, "L", $fill);

        
        
        
        $y += 7;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(20, 40);
		
                $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
                $pdf->Cell(60, 7, "Name", 1, 0, "C", 1);
                $pdf->Cell(50, 7, "Location", 1, 0, "C", 1);
                $pdf->Cell(25, 7, "Size", 1, 0, "C", 1);
                $pdf->Cell(25, 7, "Title No.", 1, 0, "C", 1);
                $pdf->Cell(40, 7, "Holder", 1, 0, "C", 1);
                $pdf->Cell(25, 7, "Date", 1, 0, "C", 1);
                $pdf->Cell(30, 7, "Status", 1, 0, "C", 1);


		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
$pdf->Output();

?>