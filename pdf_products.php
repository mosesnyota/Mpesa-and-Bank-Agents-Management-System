<?php

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

        $this->Cell(195, 6, "All Products" , 0, 0, "C", 0);
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

                
                 


       $pdf->Cell(40, 7, "Category", 1, 0, "C", 1);
       $pdf->Cell(40, 7, "Name", 1, 0, "C", 1);
       
       $pdf->Cell(25, 7, "Purchase Price", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Wholesale", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Retail", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Quantity", 1, 0, "C", 1);




$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);

 $statement = "SELECT products.*,`category` FROM `products` JOIN `product_category` ON products.`product_category` = `product_category`.`category_id`";
                        
include('dao/connect.php');
$result = $db->query($statement);
$num = 0;
$fill = 0;

$purchase_total = 0;
$wholesale_total = 0;

$totalunits = 0;
$retail_total = 0;
while ($row = $result->fetch_assoc()) {
    $num++;
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setFont("times", "", "11");


    $pdf->Cell(10, 7, $num, 1, 0, "L", 1);
    $pdf->Cell(40, 7, $row['category'], 1, 0, "L", $fill);
    $pdf->Cell(40, 7, $row['product_value'], 1, 0, "L", $fill);
    $pdf->Cell(25, 7, number_format($row['purchase_price'],2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($row['wholesale_price'],2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($row['retail_price'],2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($row['qnty'],0), 1, 0, "R", $fill);
   
$purchase_total = $purchase_total + $row['purchase_price'];
$wholesale_total = $wholesale_total + $row['wholesale_price'];
$retail_total = $retail_total + $row['retail_price'];
$totalunits = $totalunits + $row['qnty'];

    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(20, 40);

       $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
       $pdf->Cell(40, 7, "Category", 1, 0, "C", 1);
       $pdf->Cell(40, 7, "Name", 1, 0, "C", 1);
       
       $pdf->Cell(25, 7, "Purchase Price", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Wholesale", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Retail", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Quantity", 1, 0, "C", 1);


        $pdf->Ln();
        $y = 45;
    }

    $pdf->setXY($x, $y);
}


    $pdf->Cell(90, 7, "Totals :", 1, 0, "C", $fill);

    $pdf->Cell(25, 7, number_format($purchase_total,2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($wholesale_total,2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($retail_total,2), 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($totalunits,0), 1, 0, "R", $fill);

$pdf->Output();
?>