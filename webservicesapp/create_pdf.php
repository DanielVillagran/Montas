<?php
require('conexion.php');
require('fpdf/fpdf.php');
$lista = R::find("product");
    $pdf = new FPDF();
    foreach ($lista as $key) {
    $pdf->AddPage();
        $pdf->SetLineWidth(0.2);
        $img1 = '../img/LOGO A COLOR PNG.png';
        $imgsize = 35;

            $x = 20;
            $y = 14;
            $xf = 15;
            $yf = 25;
            $align = 'R';
            $width = 186;
        $pdf->Image($img1, $x, $y, $imgsize);
        $pdf->Ln(15);
        $pdf->SetFont("Arial", "", 7);
        $pdf->SetTextColor(180, 180, 180);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 10);
        if ($date > 0) {
            $pdf->SetXY($xf, $yf);
            $pdf->Cell($width, 5, str_replace(array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', '#'), array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'de'), strtolower(date("d # F # Y"))), 0, 1, $align);
        } else {
            $pdf->SetXY($xf, $yf);
        }
        $pdf->Ln(20);
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetTextColor(0);
        
            
        
	    $pdf->Cell(185, 15, utf8_decode(strtoupper($key['name'] . ' ' . $key['model'] . ' ' . $key['serie'])), 0, 0, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(185, 5, utf8_decode($key['description']),0,'C',false);
        $pdf->Ln(10);
        $elemento = false;
        $elemento = R::getAll("SELECT * from products_images where product_id='" . $key['serie'] . "' order by id desc limit 4");
        $x = 20;
		$y = $pdf->getY();
	if ($elemento) {
		foreach ($elemento as $imagen) {
            if(file_exists("http://vmcomp.com.mx/montacargas/application/storage/products/" . $imagen['img']) && $imagen['img']!=""){
                $pdf->Image("http://vmcomp.com.mx/montacargas/application/storage/products/" . $imagen['img'], $x, $y,75,95);
                if($x==20){
                    $x+=95;
                }else{
                    $x=20;
                    $pdf->SetY($y + 95);
                    //$pdf->Ln(15);
                    $y = $pdf->getY();
                }
            }
        }
	} 
        }
        
        $pdf->Output('Catalogo de productos.pdf', 'D');
?>