<?php

require("fpdf/fpdf.php");

// constructro - portrait , millimeetrid, a4 leht
$pdf = new FPDF('p', 'mm', 'A4');

// loob pdf lehe
$pdf->AddPage();

// font stiilisätted
$pdf->SetFont("Arial","","20");

// lisab lahtri, sisu läheb selle sisse 
// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
$pdf->Cell("0","10", "TESTIME", 0 , 1);

$pdf->Cell("0","20", "TERE RAHVAS", "B", 2, "C");

$pdf->Cell("0","20", "Mis toimps", 0, 2, "R");



//väljastamise meetod, default avab browseris
$pdf->Output();

?>