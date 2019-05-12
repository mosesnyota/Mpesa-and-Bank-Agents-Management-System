<?php
require('fpdf.php');

class FPDF_CellFit extends FPDF {
    
    
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
        $this->Image($barcode, 255, 10, 0, 0);
        $this->Text(265, 25, $hcode);

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

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }

}
?>