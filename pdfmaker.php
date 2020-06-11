<?php

require("fpdf/fpdf.php");


//vormi submit
if (isset($_POST['next_btn_cv'])){

    // andmete kinni püüdmine
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $personalCode = $_POST['idcode'];
    $gender = $_POST['gender'];
    $postIndex = $_POST['postalcode'];


    /**
     * sisestuste kontroll ??
     */

    // constructor - portrait , millimeetrid, a4 leht
    $pdf = new FPDF('p', 'mm', 'A4');

    // loob pdf lehe
    $pdf->AddPage();

    // font stiilisätted
    $pdf->SetFont("Arial","","20");

    // lisab lahtri, sisu läheb selle sisse 
    // Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
    $pdf->Cell("0","10", "TESTIME", 0 , 1);

    $pdf->Cell("0","20", "ISIKLIKUD ANDMED", "B", 2, "C");

    $pdf->Cell("90","20", "Eesnimi: " . $firstName, 0, 0, "L");
    $pdf->Cell("30","20", "Perekonnanimi: " . $lastName, 0, 1, "L");
    $pdf->Cell("90","20", "Isikukood: " . $personalCode, 0, 0, "L");

    // tõlgime soo stringi eestikeelseks
    ($gender=='male') ? $gender = "Mees" : $gender = "Naine";

    $pdf->Cell("30","20", "Sugu: " . $gender, 0, 2, "L");

    //väljastamise meetod, default avab browseris
    $pdf->Output();
}


?>