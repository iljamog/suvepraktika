<?php
require_once("fpdf/fpdf.php");

// lisatud funktsioonid, mis võimaldavad kasutada erisümboleid ja Eesti tähti.
// Saadud https://gist.github.com/gale93/78306ec438698032de747f4d99604419

// lisatud funktsioonid, mis aitavad tekstimahutamisega
// saadud http://www.fpdf.org/?go=script&id=3

class TextNormalizerFPDF extends FPDF{
	function __construct()
	{
		parent::__construct();
    }
    
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

	function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
	{
		parent::MultiCell($w, $h, $this->normalize($txt), $border, $align, $fill);
	}

	function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		parent::Cell($w, $h, $this->normalize($txt), $border, $ln, $align, $fill, $link);
	}

	function Write($h, $txt, $link='')
	{
		parent::Write($h, $this->normalize($txt), $link);
	}

	function Text($x, $y, $txt)
	{
		parent::Text($x, $y, $this->normalize($txt));
	}

	protected function normalize($word)
	{
		// Thanks to: http://stackoverflow.com/questions/3514076/special-characters-in-fpdf-with-php
		
		$word = str_replace("@","%40",$word);
		$word = str_replace("`","%60",$word);
		$word = str_replace("¢","%A2",$word);
		$word = str_replace("£","%A3",$word);
		$word = str_replace("¥","%A5",$word);
		$word = str_replace("|","%A6",$word);
		$word = str_replace("«","%AB",$word);
		$word = str_replace("¬","%AC",$word);
		$word = str_replace("¯","%AD",$word);
		$word = str_replace("º","%B0",$word);
		$word = str_replace("±","%B1",$word);
		$word = str_replace("ª","%B2",$word);
		$word = str_replace("µ","%B5",$word);
		$word = str_replace("»","%BB",$word);
		$word = str_replace("¼","%BC",$word);
		$word = str_replace("½","%BD",$word);
		$word = str_replace("¿","%BF",$word);
		$word = str_replace("À","%C0",$word);
		$word = str_replace("Á","%C1",$word);
		$word = str_replace("Â","%C2",$word);
		$word = str_replace("Ã","%C3",$word);
		$word = str_replace("Ä","%C4",$word);
		$word = str_replace("Å","%C5",$word);
		$word = str_replace("Æ","%C6",$word);
		$word = str_replace("Ç","%C7",$word);
		$word = str_replace("È","%C8",$word);
		$word = str_replace("É","%C9",$word);
		$word = str_replace("Ê","%CA",$word);
		$word = str_replace("Ë","%CB",$word);
		$word = str_replace("Ì","%CC",$word);
		$word = str_replace("Í","%CD",$word);
		$word = str_replace("Î","%CE",$word);
		$word = str_replace("Ï","%CF",$word);
		$word = str_replace("Ð","%D0",$word);
		$word = str_replace("Ñ","%D1",$word);
		$word = str_replace("Ò","%D2",$word);
		$word = str_replace("Ó","%D3",$word);
		$word = str_replace("Ô","%D4",$word);
		$word = str_replace("Õ","%D5",$word);
		$word = str_replace("Ö","%D6",$word);
		$word = str_replace("Ø","%D8",$word);
		$word = str_replace("Ù","%D9",$word);
		$word = str_replace("Ú","%DA",$word);
		$word = str_replace("Û","%DB",$word);
		$word = str_replace("Ü","%DC",$word);
		$word = str_replace("Ý","%DD",$word);
		$word = str_replace("Þ","%DE",$word);
		$word = str_replace("ß","%DF",$word);
		$word = str_replace("à","%E0",$word);
		$word = str_replace("á","%E1",$word);
		$word = str_replace("â","%E2",$word);
		$word = str_replace("ã","%E3",$word);
		$word = str_replace("ä","%E4",$word);
		$word = str_replace("å","%E5",$word);
		$word = str_replace("æ","%E6",$word);
		$word = str_replace("ç","%E7",$word);
		$word = str_replace("è","%E8",$word);
		$word = str_replace("é","%E9",$word);
		$word = str_replace("ê","%EA",$word);
		$word = str_replace("ë","%EB",$word);
		$word = str_replace("ì","%EC",$word);
		$word = str_replace("í","%ED",$word);
		$word = str_replace("î","%EE",$word);
		$word = str_replace("ï","%EF",$word);
		$word = str_replace("ð","%F0",$word);
		$word = str_replace("ñ","%F1",$word);
		$word = str_replace("ò","%F2",$word);
		$word = str_replace("ó","%F3",$word);
		$word = str_replace("ô","%F4",$word);
		$word = str_replace("õ","%F5",$word);
		$word = str_replace("ö","%F6",$word);
		$word = str_replace("÷","%F7",$word);
		$word = str_replace("ø","%F8",$word);
		$word = str_replace("ù","%F9",$word);
		$word = str_replace("ú","%FA",$word);
		$word = str_replace("û","%FB",$word);
		$word = str_replace("ü","%FC",$word);
		$word = str_replace("ý","%FD",$word);
		$word = str_replace("þ","%FE",$word);
		$word = str_replace("ÿ","%FF",$word);

		return urldecode($word);
	}

}

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
    $pdf = new TextNormalizerFPDF('p', 'mm', 'A4'); 

    //ISIKLIKUD ANDMED
    
    // loob pdf lehe
    $pdf->AddPage();
    //stiili sätted
    $pdf->SetFont("Arial","","20");
    $pdf->Cell("0","15", "ISIKLIKUD ANDMED", "B", 2, "C");

    $pdf->SetFont('Arial','',12);    
    $pdf->Cell("90","20", "Eesnimi: " . $firstName, 0, 0, "L");
    $pdf->Cell("30","20", "Perekonnanimi: " . $lastName, 0, 1, "L");
    $pdf->Cell("90","20", "Isikukood: " . $personalCode, 0, 0, "L");
    // tõlgime soo stringi eestikeelseks
    ($gender=='male') ? $gender = "Mees" : $gender = "Naine";
    $pdf->Cell("30","20", "Sugu: " . $gender, 0, 1, "L");    
    $pdf->Cell("30","20", "Postiindeks: " . $postIndex, 0, 0, "L");

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
    $pdf->Write(5 ,"Tunnen oma klienti, sest tänaseks olen teinud järgmisi tegevusi (nt. kõned, kohtumised, eelkokkulepped, proovitööd, ...) ja jõudnud ... (arv) kliendini:"); 
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
    $pdf->Write(5 ,"Esimesel tegevusaastal saab mul olema ... (arv) klienti, sest ... (põhjendus)"); 
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
    $pdf->Write(5 ,"Ca 3 otsest konkurenti, kellega ma saan ennast võrrelda on ..., nende majandusnäitajad on:"); 
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
    $pdf->Write(5 ,"Äri käivitamisel (nt. esimesed ... kuud) on minu eelarve ja ajakava nende turundustegevuste elluviimiseks "); 
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

    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "TEGEVUSE KÄIVITAMISE KAVA", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Tootmiseks või teenuse osutamiseks on mul praeguseks olemas ..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);

    // tabel
    $pdf->SetWidths(array(130,50));
    $temporaryArray = cellForEachStringDouble($business_action_1_1,$business_action_1_2);
    $pdf->Row(array("Ruum, vahend või seade, mis on olemas ...","Saan võtta kasutusele"));
    for ($i=0; $i < sizeof($temporaryArray[0]); $i++) { 
        $pdf->Row(array($temporaryArray[0][$i],$temporaryArray[1][$i]));
    }
    $pdf->SetWidths(array(0,0));

    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Lisaks vajan tootmiseks/teenuse osutamiseks ..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    // tabel lõpp

    // tabel
    $pdf->SetWidths(array(100,40,40));
    $temporaryArray = cellForEachStringTriple($business_action_2_1,$business_action_2_2,$business_action_2_3);
    $pdf->Row(array("Ruum, vahend või seade, mida vaja ...","Maksumus","Saan võtta kasutusele"));
    for ($i=0; $i < sizeof($temporaryArray[0]); $i++) { 
        $pdf->Row(array($temporaryArray[0][$i],$temporaryArray[1][$i],$temporaryArray[2][$i]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->Ln(15);
    // tabel lõpp

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Ettevõtte käivitan ... vormis"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_3_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Loetlen üles oma toote ja teenuse pakkumiseks vajaminevad tegevusload, litsentsid, sertifikaadid, kooskõlastused. "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_4_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu esimene müügitehing toimub"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_5_1);
    $pdf->Ln(15);

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

    $pdf->AddPage();

    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "Arveldamine", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Millistel maksetingimustel ostan enda tooraineid ja tellin teenuseid?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);

    // tabel
    $pdf->SetWidths(array(100,40,40));
    $temporaryArray = cellForEachStringTriple($business_action_2_1,$business_action_2_2,$business_action_2_3);
    $pdf->Row(array("Hangitav toode või teenus","Tarnija","Makseviis ja -tähtaeg"));
    for ($i=0; $i < sizeof($temporaryArray[0]); $i++) { 
        $pdf->Row(array($temporaryArray[0][$i],$temporaryArray[1][$i],$temporaryArray[2][$i]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->Ln(15);
    // tabel lõpp

    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas klient mulle maksab talle müüdud toote või teenuse eest?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);

    // tabel
    $pdf->SetWidths(array(130,50));
    $temporaryArray = cellForEachStringDouble($business_action_1_1,$business_action_1_2);
    $pdf->Row(array("Klient","Makseviis ja -tähtaeg"));
    for ($i=0; $i < sizeof($temporaryArray[0]); $i++) { 
        $pdf->Row(array($temporaryArray[0][$i],$temporaryArray[1][$i]));
    }
    $pdf->SetWidths(array(0,0));
    // tabel lõpp

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


// komaga eraldada palutud sisendite slicimine
function cellForEachStringTriple($input1,$input2,$input3){ // kolmene tabel
    $dataArray = array();
    $separatedInputs1 = explode(",",$input1);
    array_push($dataArray,$separatedInputs1);
    $separatedInputs2 = explode(",",$input2);
    array_push($dataArray,$separatedInputs2);
    $separatedInputs3 = explode(",",$input3);
    array_push($dataArray,$separatedInputs3);
    return $dataArray; 
}

function cellForEachStringDouble($input1,$input2){ // kahene tabel
    $dataArray = array();
    $separatedInputs1 = explode(",",$input1);
    array_push($dataArray,$separatedInputs1);
    $separatedInputs2 = explode(",",$input2);
    array_push($dataArray,$separatedInputs2);        
    return $dataArray; 
}

?>