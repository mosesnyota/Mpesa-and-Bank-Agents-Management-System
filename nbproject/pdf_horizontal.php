<?php
require('pdf_landscape.php');


$pdf = new FPDF_CellFit();
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
