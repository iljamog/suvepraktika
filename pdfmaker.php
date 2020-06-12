<?php
require_once("fpdf/fpdf.php");

//vormi submit
if (isset($_POST['next_btn_cv'])){

    // andmete kinni püüdmine
    // ISIKLIKUD
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $personalCode = $_POST['idcode'];
    $gender = $_POST['gender'];
    $postIndex = $_POST['postalcode'];
    // ÄRIPLAAN
    $business_name = $_POST['business_name'];
    $business_idea = $_POST['business_idea'];
    // KES MA OLEN JA MIDA OLEN TÄNASEKS TEINUD?
    $business_personal_1 = $_POST['business_personal_1'];
    $business_personal_2 = $_POST['business_personal_2'];
    $business_personal_3 = $_POST['business_personal_3'];
    $business_personal_4 = $_POST['business_personal_4'];
    $business_personal_5 = $_POST['business_personal_5'];
    $business_personal_6 = $_POST['business_personal_6'];
    // MINU KLIENT    
    $business_client_1 = $_POST['business_client_1'];
    $business_client_2 = $_POST['business_client_2'];
    $business_client_3 = $_POST['business_client_3'];
    $business_client_4 = $_POST['business_client_4'];
    $business_client_5 = $_POST['business_client_5'];
    // MINU TOODE JA / VÕI TEENUS
    $business_product_1 = $_POST['business_product_1'];
    $business_product_2 = $_POST['business_product_2'];
    $business_product_3 = $_POST['business_product_3'];
    // MINU KONKURENDID
    $business_competitor_1 = $_POST['business_competitor_1'];
    $business_competitor_2 = $_POST['business_competitor_2'];
    $business_competitor_3 = $_POST['business_competitor_3'];
    $business_competitor_4 = $_POST['business_competitor_4'];
    $business_competitor_5 = $_POST['business_competitor_5'];
    $business_competitor_6 = $_POST['business_competitor_6'];
    // MINU TURUNDUS JA MÜÜK
    $business_marketing_1 = $_POST['business_marketing_1'];
    $business_marketing_2 = $_POST['business_marketing_2'];
    $business_marketing_3 = $_POST['business_marketing_3'];
    $business_marketing_4 = $_POST['business_marketing_4'];
    $business_marketing_5 = $_POST['business_marketing_5'];
    // TEGEVUSE KÄIVITAMISE KAVA
    $business_action_1_1 = $_POST['business_action_1_1'];
    $business_action_1_2 = $_POST['business_action_1_2'];
    $business_action_2_1 = $_POST['business_action_2_1'];
    $business_action_2_2 = $_POST['business_action_2_2'];
    $business_action_2_3 = $_POST['business_action_2_3'];
    $business_action_3_1 = $_POST['business_action_3_1'];
    $business_action_4_1 = $_POST['business_action_4_1'];
    $business_action_5_1 = $_POST['business_action_5_1'];
    // MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE    
    $business_production_1 = $_POST['business_production_1'];
    $business_production_2 = $_POST['business_production_2'];
    $business_production_3 = $_POST['business_production_3'];
    $business_production_4 = $_POST['business_production_4'];
    $business_production_5 = $_POST['business_production_5'];
    $business_production_6 = $_POST['business_production_6'];
    // PERSONAL JA PARTNERID
    $business_associate_1 = $_POST['business_associate_1'];
    $business_associate_2 = $_POST['business_associate_2'];
    $business_associate_3 = $_POST['business_associate_3'];
    $business_associate_4 = $_POST['business_associate_4'];
    // HINNASTAMINE
    $business_pricing_1 = $_POST['business_pricing_1'];
    $business_pricing_2 = $_POST['business_pricing_2'];
    $business_pricing_3 = $_POST['business_pricing_3'];
    $business_pricing_4 = $_POST['business_pricing_4'];
    // ARVELDAMINE
    $business_settlement_1_1 = $_POST['business_settlement_1_1'];
    $business_settlement_1_2 = $_POST['business_settlement_1_2'];
    $business_settlement_1_3 = $_POST['business_settlement_1_3'];
    $business_settlement_2_1 = $_POST['business_settlement_2_1'];
    $business_settlement_2_2 = $_POST['business_settlement_2_2'];
    // MINU PLAAN B
    $business_plan_b = $_POST['business_plan_b'];

    $cellwidth = 190;

    // PDFi loomine klassi abil
    // constructor - portrait , millimeetrid, a4 leht
    $pdf = new FPDF('p', 'mm', 'A4'); 

    //ISIKLIKUD ANDMED
    
    // loob pdf lehe
    $pdf->AddPage();
    //stiili sätted
    $pdf->SetFont("Arial","","20");
    $pdf->Cell("0","15", "ISIKLIKUD ANDMED", "B", 2, "C");

    $pdf->SetFont('Arial','B',12);    
    $pdf->Cell("90","20", "Eesnimi: " , 0, 0, "L");
    $pdf->SetFont('Arial','',12);
    $pdf->Write(20,$firstName);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell("30","20", "Perekonnanimi: " , 0, 1, "L");
    $pdf->SetFont('Arial','',12);
    $pdf->Write(20,$lastName);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell("90","20", "Isikukood: " , 0, 0, "L");
    $pdf->SetFont('Arial','',12);
    $pdf->Write(20, $personalCode);

    // tõlgime soo stringi eestikeelseks
    $pdf->SetFont('Arial','B',12);
    ($gender=='male') ? $gender = "Mees" : $gender = "Naine";
    $pdf->Cell("30","20", "Sugu: ", 0, 1, "L");
    $pdf->SetFont('Arial','',12);
    $pdf->Write(20, $gender);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell("30","20", "Postiindeks: ", 0, 2, "L");
    $pdf->SetFont('Arial','',12);
    $pdf->Write(20, $postIndex);

    /**
     * ÄRIPLAAN
     */
    $pdf->AddPage();
    
    $pdf->SetFont("Arial","","20");
    $pdf->Cell("0","15", "ÄRIPLAAN", "B", 2, "C");
    // ISIKLIKUD
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12);    
    $pdf->Cell("0","10", "Loodava ettevõtte nimi: ", 0, 0, "L");
    $pdf->Ln(15);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7, $business_name);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Äridee: ", "", 2, "L");
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7, $business_idea);
    $pdf->Ln(20);
    
    
    // KES MA OLEN JA MIDA OLEN TÄNASEKS TEINUD?
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "KES MA OLEN JA MIDA OLEN TÄNASEKS TEINUD? ", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Kirjeldan oma senist kogemust. Mida olen varem teinud oma loodava äri vallas? ", "", 2, "L");
    $pdf->Ln(1);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7,$business_personal_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Kuidas minu haridus, täiendõpe ja teadmised toetavad äri käivitamist? ", "", 2, "L");
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7,$business_personal_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Minu 3-4 isikuomadust, mis aitavad mul äri teha:", "", 2, "L");
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7,$business_personal_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12);
    $pdf->Write(5 ,"Äri alustamiseks olen julge ja valmis aktiivselt suhtlema, et oma äri turundada ja müüa. Toon näiteid oma õnnestumistest."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_personal_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Äri alustamiseks olen julge ja valmis aktiivselt suhtlema, et oma äri turundada ja müüa. Toon näiteid oma õnnestumistest."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_personal_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Mul on selles äris alustamiseks täna olemas eeldused: (nt. kontaktid, eeltöö) "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_personal_6);
    $pdf->Ln(15);

    // MINU KLIENT
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU KLIENT", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kirjeldan enda tüüpilist klienti"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Tunnen oma klienti, sest tänaseks olen teinud järgmisi tegevusi (nt. kõned, kohtumised, eelkokkulepped, proovitööd, …) ja jõudnud … (arv) kliendini:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Klient vajab minu teenust või toodet sellepärast, et "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas minu klient praegu enda vajadust katab või probleemi lahendab?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Esimesel tegevusaastal saab mul olema … (arv) klienti, sest … (põhjendus)"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_5);
    $pdf->Ln(15);


    // MINU TOODE JA / VÕI TEENUS
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU KLIENT", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toode ja / või teenus on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_product_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toode ja / või teenus on selline.\nKirjeldan või lisan foto toote näidisest või analoogist (võimalusel)"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_product_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toote ja / või teenuse EMTAK kood ja tegevusala on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_product_3);
    $pdf->Ln(15);
    
    // MINU KONKURENDID
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU KLIENT", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Ca 3 otsest konkurenti, kellega ma saan ennast võrrelda on …, nende majandusnäitajad on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Miks just need on minu kõige olulisemad konkurendid?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu konkurentide tugevused on... Ma võiksin neilt õppida kuidas"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Mina olen konkurentidest parem sellepärast, et"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toode ja / või teenus on konkurentidega võrreldav ja neist eristuv sellepärast, et "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuna mul otseseid konkurente ei ole, siis kirjeldan asendustooteid või kaudseid konkurente"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_6);
    $pdf->Ln(15);

    // MINU TURUNDUS JA MÜÜK
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU TURUNDUS JA MÜÜK", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kus minu tüüpiline klient asub?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Millisest kohast ostab klient sarnaseid tooteid ja / või teenuseid praegu ja kus mina hakkan müüma?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Saan oma tooteid ja teenuseid potentsiaalse kliendi jaoks nähtavaks teha järgmiste tegevustega"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Äri käivitamisel (nt. esimesed … kuud) on minu eelarve ja ajakava nende turundustegevuste elluviimiseks "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Peale äri käivitamist (nt. alates ... kuust) on minu põhilised turundustegevused ja igakuine eelarve turundusele"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_5);
    $pdf->Ln(15);
    
    // TEGEVUSE KÄIVITAMISE KAVA

    $pdf->AddPage();
    $pdf->MultiCell("$cellwidth","5", "business_action_1_1: ". $business_action_1_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_1_2: ". $business_action_1_2, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_2_1: ". $business_action_2_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_2_2: ". $business_action_2_2, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_2_3: ". $business_action_2_3, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_3_1: ". $business_action_3_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_4_1: ". $business_action_4_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_action_5_1: ". $business_action_5_1, "B", 2, "L");

    // MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE    
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kirjeldan etappe, kuidas minu kõige olulisem toode valmib. Kui pakun teenuseid, siis kuidas klienti teenindan."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Vajan toote valmistamiseks või teenuse pakkumiseks jooksvalt alljärgnevaid toormaterjale"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu kõige olulisema toote valmistamiseks või teenuse pakkumiseks kuluv aeg on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Toodete ja / või teenuste pakkumiseks on mul vaja hoida oma laos varusid sellises koguses:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas viin oma toote ja / või teenuse kliendini (partnerid, tarneaeg) või kas kliendid tulevad minu juurde?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas klient minu toodet ja / või teenust ostab"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_production_6);
    $pdf->Ln(15);

    // PERSONAL JA PARTNERID
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu enda ülesanded ettevõttes on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_associate_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Äri tegemiseks vajan lisaks neid töötajaid või partnereid"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_associate_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Igakuised palgakulud endale ja töötajatele on "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_associate_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Igakuised teenuste kulud koostööpartneritele ja teenuste pakkujatele"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_associate_4);
    $pdf->Ln(15);

    // HINNASTAM15INE
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu 3 olulisemat konkurenti müüvad tooteid ja / või teenuseid järgmiste hindadega"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_pricing_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu kõige olulisema toote või teenuse omahind ja selle arvutuskäik on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_pricing_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Edasimüüja teenustasu või juurdehindlus on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_pricing_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toote ja / või teenuse lõplik müügihind lõppkliendi jaoks on"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_pricing_4);
    $pdf->Ln(15);

    // ARVELDAMINE
    $pdf->MultiCell("$cellwidth","5", "business_settlement_1_1: ". $business_settlement_1_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_settlement_1_2: ". $business_settlement_1_2, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_settlement_1_3: ". $business_settlement_1_3, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_settlement_2_1: ". $business_settlement_2_1, "B", 2, "L");
    $pdf->MultiCell("$cellwidth","5", "business_settlement_2_2: ". $business_settlement_2_2, "B", 2, "L");
    // MINU PLAAN B
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU PLAAN B", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Mis võib minu äris plaanitust teisiti minna ja mida ma siis teen"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_plan_b);
    $pdf->Ln(15);
    
    //väljastamise meetod, default avab browseris
    $pdf->Output();
}


// teksti lahtri suurendamine

function cellForEachString($input){

    $separatedInputs = explode(",",$input);
    // not done
}

?>