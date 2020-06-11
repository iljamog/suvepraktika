// äriplaani vormi tekitamine


function createBusinessPlanForm() {

    // kustutab nupud
    $("#business_plan_form_div").empty();

    // tekitab vormi
    // ! VAHETADA id ja nimed
    $("#business_plan_form_div").append(
        
        "<label><h4>Loodava ettevõtte nimi</h4></label> <br>", 
        "<input type='text' name='company_name' id='business_name' class='form-control'/>",

        "<br> <p>See vorm kirjeldab minu äriplaani Eesti Töötukassale ettevõtlusega alustamise toetuse taotlemiseks.</p>",
        "<li>Kirjutan äriplaani toetuse saamiseks, kuid ennekõike iseendale. </li>",
        "<li>Äriplaani koostamise käigus saan läbi mõelda enda tugevused ja nõrkused ning äri põhialused. </li>",
        "<li>Äriplaani koostamise vältel mõtlen suurelt ja samas hindan realistlikult, mida ma suudan ellu viia.</li>",
        "<li>Kui äriplaani valmis saan, siis tean kuhu võin oma äriga tulevikus välja jõuda.</li> <br>",

        "<label>Minu äriidee kuni 3 lausega: (nt mida, kellele, kuidas)</label>",
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>', 
        

        "<h3> KES MA OLEN JA MIDA OLEN TÄNASEKS TEINUD? </h3> <br>", 

        "<label>Kirjeldan oma senist kogemust. Mida olen varem teinud oma loodava äri vallas?</label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label>Kuidas minu haridus, täiendõpe ja teadmised toetavad äri käivitamist?</label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label>Minu 3-4 isikuomadust, mis aitavad mul äri teha:</label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label>Äri alustamiseks olen julge ja valmis aktiivselt suhtlema, et oma äri turundada ja müüa. Toon näiteid oma õnnestumistest.</label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label>Äris hakkama saamiseks olen valmis toime tulema raskustega.",
        " Toon näiteid oma ebaõnnestumistest ja kuidas olen neist õppinud ja edasi liikunud.</label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label>Mul on selles äris alustamiseks täna olemas eeldused: (nt. kontaktid, eeltöö) </label>", 
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",

        "<h3> MINU KLIENT </h3> <br>",

        "<label> Kirjeldan enda tüüpilist klienti </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Tunnen oma klienti, sest tänaseks olen teinud järgmisi tegevusi (nt. kõned, kohtumised, eelkokkulepped, proovitööd, …)",
        " ja jõudnud … (arv) kliendini: </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Klient vajab minu teenust või toodet sellepärast, et  </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Kuidas minu klient praegu enda vajadust katab või probleemi lahendab? </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Esimesel tegevusaastal saab mul olema … (arv) klienti, sest … (põhjendus) </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",

        "<h3> MINU TOODE JA / VÕI TEENUS </h3> <br>",

        "<label> Minu toode ja / või teenus on: </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Minu toode ja / või teenus on selline. Kirjeldan või lisan foto toote näidisest või analoogist (võimalusel) </label>",
        "<div class='input-group mb-3'>",
            "<input type='file' accept='image/*'> <br>",
            "<label class='custom-file-label' for='inputGroupFile01'>Lisa fail</label>",
            "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "</div>",
        "<label> Minu toote ja / või teenuse EMTAK kood ja tegevusala on (otsin ja valin nimekirjast)",
        "<br> <a href='https://emtak.rik.ee/EMTAK/pages/klassifikaatorOtsing.jspx' style='font-size:30px;'> Leia siit </a> </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",

        "<h3> MINU KLIENT </h3> <br>",

        "<label> Ca 3 otsest konkurenti, kellega ma saan ennast võrrelda on …, <br>",
        " nende majandusnäitajad on: …   (töötajate arv, müügitulu, turul tegutsemise aeg) </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Miks just need on minu kõige olulisemad konkurendid? </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Minu konkurentide tugevused on... Ma võiksin neilt õppida kuidas (loetlen kuni 3) </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Mina olen konkurentidest parem sellepärast, et ...  (loetlen kuni 3) </label>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        "<label> Minu toode ja / või teenus on konkurentidega võrreldav ja neist eristuv sellepärast, et ... </label>",
        "<p style='color:darkgray;'><i> * Kui mul otsekonkurente pole, kirjeldan asendustooteid või kaudseid konkurente. Näiteks raamatute asendustooteks on ajakirjad või blogid. Laste mängutoa kaudseteks konkurentideks on kino, televisioon, suvelaager või vanavanemad. Need kõik pakuvad võimalust vaba aja veetmiseks.</i></p>",
        "<input type='text' name='fname' id='fname' class='form-control' style='height:100px;' />    <br>",
        '<label>Kuna mul otseseid konkurente ei ole, siis kirjeldan asendustooteid või kaudseid konkurente </label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',
        
        '<h3> MINU TURUNDUS JA MÜÜK </h3> <br>',

        '<p style="color:darkgray;"><i> * Saan oma kaupa ja teenuseid müüa nendes kohtades, kus minu klient on. Saan ennast turundada kohtades, mida klient näeb. Näiteks: Mõni klient näiteks elab linna lähedal maal ja käib kesklinna kaubanduskeskuses. Teine klient külastab regulaarselt sotsiaalmeedias koerasõprade gruppi.</i></p><br>',
        '<label>Kus minu tüüpiline klient asub? </label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',
        '<label>Millisest kohast ostab klient sarnaseid tooteid ja / või teenuseid praegu ja kus mina hakkan müüma?</label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',

        '<li>Enda toodete ja teenuste nähtavaks tegemine nõuab kavandamist ja vahendeid. Selleks, et konkurentide seas silma paista, tuleb asjad läbi mõelda. </li>',
        '<li>Enamasti ei piisa koduleheküljest või sotsiaalmeedia kanalist. Kui kodulehekülge internetiavarustest üles ei leita, siis pole sellest kasu. </li>',
        '<li>Mõne reklaami eest tuleb maksta raha. Näiteks otsingumootorid või sotsiaalmeedia kampaaniad, mis suunaksid kliendid minu müügikanalisse.</li>',
        '<li>Mõnel juhul pean panustama oma aega. Näiteks juhul kui ma soovin oma tooteid tutvustada, siis pean suhtlema potentsiaalsete klientidega, kirjutama artikleid vms, et tähelepanu võita.</li>',
        '<li>Pean meeles, et minu toodete või teenuste fännid ei ole veel nende ostjad.</li>',
        '<li>Turundus on järjepidev töö. Et uued ja olemasolevad kliendid minu juurde tagasi pöörduksid, pean pidevalt nähtaval püsima. </li><br>',

        '<label>Saan oma tooteid ja teenuseid potentsiaalse kliendi jaoks nähtavaks teha järgmiste tegevustega</label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',
        '<label>Äri käivitamisel (nt. esimesed … kuud) on minu eelarve ja ajakava nende turundustegevuste elluviimiseks </label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',
        '<label>Peale äri käivitamist (nt. alates ... kuust) on minu põhilised turundustegevused ja igakuine eelarve turundusele</label>',
        '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> <br>',

        '<h3> TEGEVUSE KÄIVITAMISE KAVA </h3> <br>',

        '<p> Tootmiseks või teenuse osutamiseks on mul praeguseks olemas ...</p>',
        
        '<div class="row">  <br><br>'+
            '<div class="col-sm-6" >Ruum, vahend või seade, mis on olemas …'+
                '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> '+
            '</div>'+
            '<div class="col-sm-6" >Saan võtta kasutusele (kohe või …)'+
                '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> '+
            '</div>'+
        '</div>',

        '<p> Lisaks vajan tootmiseks/teenuse osutamiseks ...</p>',

        '<div class="row">  <br><br>'+
            '<div class="col-sm-6" >Ruum, vahend või seade, mis on olemas …'+
                '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> '+
            '</div>'+
            '<div class="col-sm-6" >Saan võtta kasutusele (kohe või …)'+
                '<textarea class="form-control" id="business_idea" name="business_idea" class="text" rows ="3" form="register_form"></textarea> '+
            '</div>'+
        '</div>',

        

        );

}

$( document ).ready(function() {
    document.getElementById("business_plan_form_button").addEventListener("click", createBusinessPlanForm);

    
});



