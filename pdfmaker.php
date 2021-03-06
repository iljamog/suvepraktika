<?php
ob_start();
require_once('fpdf/fpdf.php');
print_r($_POST);

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
//vormi submit  && $_SERVER['REQUEST_METHOD'] == 'POST' , isset($_POST['next_btn_cv']
if (isset($_POST['submit'])) {
    // andmete kinni püüdmine
    // ISIKLIKUD    
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $personalCode = $_POST['idcode'];
    $gender = $_POST['gender'];
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
    $business_client_6 = $_POST['business_client_6'];
    // MINU TOODE JA / VÕI TEENUS
    $business_product_1 = $_POST['business_product_1'];
    $business_product_2 = $_POST['business_product_2'];

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
    $business_marketing_5 = $_POST['business_marketing_cell'];
    $business_marketing_6 = $_POST['business_marketing_cell_2'];
    // TEGEVUSE KÄIVITAMISE KAVA
    $business_action_1 = $_POST['business_action_1'];
    $business_action_2 = $_POST['business_action_cell'];
    $business_action_3 = $_POST['business_action_cell_2'];
    $business_action_4 = $_POST['business_action_4'];
    $business_action_5 = $_POST['business_action_cell_3'];
    $business_action_6 = $_POST['business_action_6'];
    // MINU TOOTMINE, TEENUSE PAKKUMINE JA TARNE    
    $business_production_1 = $_POST['business_production_1'];
    $business_production_2 = $_POST['business_production_2'];
    $business_production_3 = $_POST['business_production_3'];
    $business_production_4 = $_POST['business_production_4'];
    $business_production_5 = $_POST['business_production_5'];
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
    $business_settlement_1 = $_POST['business_settlement_cell'];
    $business_settlement_2 = $_POST['business_settlement_cell_2'];
    // MINU PLAAN B
    $business_plan_b = $_POST['business_plan_b'];

    // PDFi loomine klassi abil
    // constructor - portrait , millimeetrid, a4 leht
    $pdf = new TextNormalizerFPDF('p', 'mm', 'A3');
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
    
    //ÄRIPLAAN
    
    $pdf->AddPage();
    
    $pdf->SetFont("Arial","","20");
    $pdf->Cell("0","15", "ÄRIPLAAN", "B", 2, "C");    
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

    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "KES MA OLEN JA MIDA OLEN TÄNASEKS TEINUD? ", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Kirjeldan oma senist kogemust. Mida olen varem teinud oma loodava äri vallas?", "", 2, "L");
    $pdf->Ln(1);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7,$business_personal_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Kuidas minu haridus, täiendõpe, teadmised ja eelnev töökogemus toetavad äri käivitamist?", "", 2, "L");
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',12);
    $pdf->Write(7,$business_personal_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Cell(50 ,"10", "Minu 3-4 isikuomadust, mis aitavad mul äri teha", "", 2, "L");
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
    $pdf->Write(5 ,"Äris hakkama saamiseks olen valmis toime tulema raskustega. Toon näiteid oma ebaõnnestumistest ja kuidas olen neist õppinud ja edasi liikunud."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_personal_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Mul on selles äris alustamiseks täna olemas eeldused (nt kontaktid, eeltöö)"); 
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
    $pdf->Write(5 ,"Kirjeldan enda tüüpilist klienti:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Tunnen oma klienti, sest tänaseks olen teinud järgmisi tegevusi (nt. kõned, kohtumised, eelkokkulepped ja nendega kaetud potentsiaalne müük, proovitööd) ja jõudnud ... (arv) kliendini:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Tean, milline on olukord ja trendid selles valdkonnas: (kirjeldan taustainfot ja / või uuringuid)"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Klient vajab minu teenust või toodet sellepärast, et:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas minu klient praegu enda vajadust katab või probleemi lahendab: (sh mille järgi valib tooteid või teenuseosutajat)"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Esimesel tegevusaastal saab mul olema ... (arv) klienti, sest ... (põhjendus)"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_client_6);
    $pdf->Ln(15);

    // MINU TOODE JA / VÕI TEENUS

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU TOODE JA / VÕI TEENUS", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu tooted ja / või teenused on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_product_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toote ja / või teenuse EMTAK kood ja tegevusala nimetus on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_product_2);
    $pdf->Ln(15);

    // MINU KONKURENDID

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "MINU KONKURENDID", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Umbes 3 otsest konkurenti, kellega ma saan ennast võrrelda, on ... , nende majandusnäitajad on: "); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Miks just nemad on minu kõige olulisemad konkurendid?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu konkurentide tugevused on... Ma võiksin neilt õppida, kuidas..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu tugevused konkurentide ees on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu toode ja / või teenus on konkurentidega võrreldav ja neist eristuv sellepärast, et..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_competitor_5);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kirjeldan asendustooteid või kaudseid konkurente "); 
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
    $pdf->Write(5 ,"Millisest kohast ostab klient sarnaseid tooteid ja / või teenuseid praegu?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kus mina hakkan müüma või teenust osutama?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_2);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu kliendid otsivad ja saavad informatsiooni minu valdkonna kohta praegu ... kanalitest ... märksõnade abil"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_3);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Mina saan oma tooteid ja teenuseid potentsiaalse kliendi jaoks nähtavaks teha selliste tegevustega:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_marketing_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','',9);
    $pdf->SetWidths(array(60,40,20,20,40));
    $pdf->Row(array("Tegevus", "Sihtrühm", "Ajakava" ,"Eelarve (EUR)", "Oodatud tulem"));
    for ($i=0; $i < (sizeof($business_marketing_5)/5); $i++) { 
        $pdf->Row(array($business_marketing_5[$i],$business_marketing_5[$i+1], $business_marketing_5[$i+2],$business_marketing_5[$i+3],$business_marketing_5[$i+4]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','',9);
    $pdf->SetWidths(array(60,40,20,20,40));
    $pdf->Row(array("Tegevus", "Sihtrühm", "Ajakava" ,"Eelarve (EUR)", "Oodatud tulem"));
    for ($i=0; $i < (sizeof($business_marketing_6)/5); $i++) { 
        $pdf->Row(array($business_marketing_6[$i],$business_marketing_6[$i+1],$business_marketing_6[$i+2],$business_marketing_6[$i+3],$business_marketing_6[$i+4]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(15);

    // TEGEVUSE KÄIVITAMISE KAVA

    $pdf->AddPage();

    $pdf->SetFont('Arial','B',15);
    $pdf->Cell("0","10", "TEGEVUSE KÄIVITAMISE KAVA", 0, 2, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu äri tegevuskoht on:"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_1);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Tootmiseks või teenuse osutamiseks on mul praeguseks olemas ..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);

    $pdf->SetWidths(array(90,90));    
    $pdf->Row(array("Ruum, vahend või seade, mis on olemas ...", "Millal saan kasutusele võtta?"));
    for ($i=0; $i < (sizeof($business_action_2)/2); $i++) { 
        $pdf->Row(array($business_action_2[$i],$business_action_2[$i+1]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(15);

    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Lisaks vajan tootmiseks/teenuse osutamiseks ..."); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial','',9);
    $pdf->SetWidths(array(70,30,30,50));
    $pdf->Row(array("Ruum, vahend, seade või teenus, mida vaja", "Maksumus", "Millal saan kasutusele võtta?	" ,"Rahastamisallikas (laen, toetus vms)"));
    for ($i=0; $i < (sizeof($business_action_3)/4); $i++) { 
        $pdf->Row(array($business_action_3[$i],$business_action_3[$i+1],$business_action_3[$i+2],$business_action_3[$i+3]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Ettevõtte käivitan ... vormis"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_4);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','',9);
    $pdf->SetWidths(array(50,30,30,70));
    $pdf->Row(array("Tegevusluba, litsents, sertifikaat, kooskõlastus jms", "Maksumus", "Saamiseks kuluv aeg" ,"Tegevusluba, litsents, sertifikaat, kooskõlastus olemas (kuu, aasta)"));
    for ($i=0; $i < (sizeof($business_action_5)/4); $i++) { 
        $pdf->Row(array($business_action_5[$i],$business_action_5[$i+1],$business_action_5[$i+2],$business_action_5[$i+3]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(15);

    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Minu esimene müügitehing toimub"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Write(7,$business_action_6);
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

    $pdf->SetWidths(array(60,60,60));    
    $pdf->Row(array("Hangitav toode või teenus", "Tarnija", "Makseviis ja -tähtaeg"));
    for ($i=0; $i < (sizeof($business_settlement_1)/3); $i++) { 
        $pdf->Row(array($business_settlement_1[$i],$business_settlement_1[$i+1],$business_settlement_1[$i+2]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->Ln(15);

    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',12); 
    $pdf->Write(5 ,"Kuidas klient, sh edasimüüja mulle maksab talle müüdud toote või teenuse eest?"); 
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);

    $pdf->SetWidths(array(80,100));    
    $pdf->Row(array("Hangitav toode või teenus", "Makseviis ja -tähtaeg"));
    for ($i=0; $i < (sizeof($business_settlement_2)/2); $i++) { 
        $pdf->Row(array($business_settlement_2[$i],$business_settlement_2[$i+1]));
    }
    $pdf->SetWidths(array(0,0));
    $pdf->Ln(15);

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
    $pdf->Output("Ariplaan.pdf", "D");
    ob_end_flush();
}
?>