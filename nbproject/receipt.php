<?php

require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];
require('fpdf.php');
$set_price = strip_tags($_GET['set_price']);
$plot_id = strip_tags($_GET['plot_id']);

$customer = strip_tags($_GET['customer']);
$saledate = strip_tags($_GET['saledate']);
$otherdetails = strip_tags($_GET['otherdetails']);

$date=date_create($saledate);
$saledate = date_format($date,"d-m-Y");
$set_price1= $set_price.".00";
$set_price = number_format($set_price,2);

$payment_mode = strip_tags($_GET['payment_mode']);
$reference = strip_tags($_GET['reference']);


$incometype = strip_tags($_GET['incometype']);

if($payment_mode=='cash'){
    $payment_mode = "Cash";
}else if($payment_mode=='mpesa'){
    $payment_mode = "Mpesa";
}else if($payment_mode=='cheque'){
    $payment_mode = "Cheque";
}else if($payment_mode=='transfer'){
    $payment_mode = "Bank Transfer";
}else if($payment_mode=='deposit'){
    $payment_mode = "Direct Deposit";
}else if($payment_mode=='others'){
    $payment_mode = "Other Means";
}


function getIncomeSource($incometype){
     $statement = "SELECT * FROM `income_sources` WHERE `source_id` = '$incometype'";
    include('dao/connect.php');
    $result = $db->query($statement);
$name ='';
    while ($row = $result->fetch_assoc()) {
        $name = $row['source_name'];
    }
    return $name;
    
}
function getPlotDetails($plot_id,$incometype ) {
    $statement = "SELECT `plot_num`,plots.`size`,plots.`title_no`,`name`,`location` FROM `master_land` JOIN `plots`
ON master_land.`master_land_id` = plots.`master_land_id` WHERE plots.`plot_id` = '$plot_id'";
    include('dao/connect.php');
    $result = $db->query($statement);
$name ='';
    while ($row = $result->fetch_assoc()) {
        $name = getIncomeSource($incometype). " for: Plot No. ".$row['plot_num']." , ".$row['name'];
    }
    return $name;
}


function getCustomerNames($customer_id){
    $statement = "select * from member where member_id ='$customer_id'";
    include('dao/connect.php');
    $result = $db->query($statement);
$name ='';
    while ($row = $result->fetch_assoc()) {
        $name = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
    }
    return $name;
}

function getMemberNo($customer_id){
    $statement = "select * from member where member_id ='$customer_id'";
    include('dao/connect.php');
    $result = $db->query($statement);
$name ='';
    while ($row = $result->fetch_assoc()) {
        $name = $row['member_id'];
    }
    return $name;
}

function getReceiptID($plot_id,$customer){
    $statement = "select max(payment_id) as myid from payments where plot_id ='$plot_id' and member_id = $customer";
    include('dao/connect.php');
    $result = $db->query($statement);

    while ($row = $result->fetch_assoc()) {
        return "00".$row['myid'];
    }
    
}



function getCustomerID($customer_id){
    $statement = "select * from member where member_id ='$customer_id'";
    include('dao/connect.php');
    $result = $db->query($statement);
$name ='';
    while ($row = $result->fetch_assoc()) {
        $name = $row['idno'];
    }
    return $name;
}



function convertNumber($number)
{
    list($integer, $fraction) = explode(".", (string) $number);

    $output = "";

    if ($integer{0} == "-")
    {
        $output = "negative ";
        $integer    = ltrim($integer, "-");
    }
    else if ($integer{0} == "+")
    {
        $output = "positive ";
        $integer    = ltrim($integer, "+");
    }

    if ($integer{0} == "0")
    {
        $output .= "zero";
    }
    else
    {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group   = rtrim(chunk_split($integer, 3, " "), " ");
        $groups  = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g)
        {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++)
        {
            if ($groups2[$z] != "")
            {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0)
    {
        $output .= " point";
        for ($i = 0; $i < strlen($fraction); $i++)
        {
            $output .= " " . convertDigit($fraction{$i});
        }
    }

    return $output;
}

function convertGroup($index)
{
    switch ($index)
    {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
    {
        return "";
    }

    if ($digit1 != "0")
    {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0")
        {
            $buffer .= " and ";
        }
    }

    if ($digit2 != "0")
    {
        $buffer .= convertTwoDigit($digit2, $digit3);
    }
    else if ($digit3 != "0")
    {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0")
    {
        switch ($digit1)
        {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1")
    {
        switch ($digit2)
        {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else
    {
        $temp = convertDigit($digit2);
        switch ($digit1)
        {
            case "2":
                return "twenty-$temp";
            case "3":
                return "thirty-$temp";
            case "4":
                return "forty-$temp";
            case "5":
                return "fifty-$temp";
            case "6":
                return "sixty-$temp";
            case "7":
                return "seventy-$temp";
            case "8":
                return "eighty-$temp";
            case "9":
                return "ninety-$temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit)
    {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
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
        $this->SetFont('times', 'B', 28);

        $this->Cell(195, 7, $name, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', 'B', 14);
        $this->Cell(195, 6, $name2, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', '', 12);
        $this->Cell(195, 6, "Head Office Thika: $headoffice, Email: $email", 0, 0, "C", 0);
        $this->Ln();
        $this->Cell(195, 6, $address, 0, 0, "C", 0);
        $this->Line(10, 36, 200, 36);
        $this->Ln();
    }



    function SetDash($black = null, $white = null) {
        if ($black !== null)
            $s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        else
            $s = '[] 0 d';
        $this->_out($s);
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



$pdf->SetFont('times', 'B', 13);
$pdf->Cell(185, 10, "PAYMENT RECEIPT", 0, 0, "C", 0);
$pdf->Cell(5, 10, "NO. ".getReceiptID($plot_id,$customer), 0, 0, "R", 0);
$pdf->SetFont('times', '', 12);
$pdf->Ln();
$pdf->Cell(10, 7, "Received From: " . "     ".getCustomerNames($customer), 0, 0, "L", 0);
$pdf->SetDash(0.5, 1);
$pdf->Line(39, 51, 200, 51);
$pdf->Ln();
$pdf->Cell(10, 7, "National ID: " . "          ".getCustomerID($customer)."                                      Member No.: ".getMemberNo($customer)."                      Date: ".$saledate, 0, 0, "L", 0);
$pdf->SetDash(0.5, 1);
$pdf->Line(39, 58, 200, 58);
$pdf->SetDash();
$pdf->Line(10, 62, 200, 62);
$pdf->Line(10, 69, 200, 69);
$pdf->Line(10, 83, 200, 83);
$pdf->Line(10, 90, 200, 90);

$pdf->Line(10, 62, 10, 90);
$pdf->Line(40, 62, 40, 90);
$pdf->Line(160, 62, 160, 90);
$pdf->Line(200, 62, 200, 90);
$pdf->SetFont('times', 'B', 12);

$pdf->Text(14, 67, '1');
$pdf->Text(44, 67, 'PARTICULAR');
$pdf->Text(165, 67, "AMOUNT");

$pdf->Text(14, 76, 'No');
$pdf->Text(44, 75, getPlotDetails($plot_id,$incometype ));
$pdf->Text(44, 81, $otherdetails);
$pdf->Text(165, 76, "Ksh. ".$set_price);

$pdf->Text(14, 88, 'Total');

$pdf->Text(165, 88, "Ksh. ".$set_price);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times', '', 12);
$pdf->Cell(10, 7, "Amount in words:     ". ucfirst(convertNumber($set_price1)) , 0, 0, "L", 0);
$pdf->SetDash(0.5, 1);
$pdf->Line(42, 100, 200, 100);
$pdf->Ln();
$pdf->Cell(10, 9, "Payment Mode: " . "          " . $payment_mode . "                                " . "    Reference: " . "  ".$reference, 0, 0, "L", 0);
$pdf->SetDash(0.5, 1);
$pdf->Line(38, 108, 100, 108);
$pdf->Line(200, 108, 118, 108);
$pdf->Ln();
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(10, 9, "You were served by: " .$user . "                                             " . "  Sign: ", 0, 0, "L", 0);
$pdf->SetDash(0.5, 1);

$pdf->Line(200, 117, 118, 117);
$pdf->Ln();
$pdf->SetDash();
//DRAW AN OUTER BOX
$pdf->Line(5, 5, 205, 5); //TOP
$pdf->Line(5, 5, 205, 5);//TOP


$pdf->Line(5, 5, 5, 125); //SID1
$pdf->Line(5, 5, 5, 125);//SIDE1

$pdf->Line(205, 5, 205, 125); //SID2
$pdf->Line(205, 5, 205, 125);//SIDE2

$pdf->Line(5, 125, 205, 125); //bTOP
$pdf->Line(5, 125, 205, 125);//bTOP
$pdf->SetFont('times', 'I', 9);

$pdf->Cell(190, 8, "NB: This receipt will be deemed invalid if it doesn't have a valid stamp/seal ", 0, 0, "C", 0);

$pdf->Output('', 'receipt', false);
?>


