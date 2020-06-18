// document.querySelector("#start").addEventListener("click", (e) => {
//   window.location.href = "taotlus.html";
// });

// Nuppude

$("#next_btn_data").click(function () {
  $("#business-tab").trigger("click");
});

$("#next_btn_business").click(function () {
  $("#finance-tab").trigger("click");
});

$("#previous_btn_business").click(function () {
  $("#data-tab").trigger("click");
});

$("#next_btn_finance").click(function () {
  $("#cv-tab").trigger("click");
});

$("#previous_btn_finance").click(function () {
  $("#business-tab").trigger("click");
});

$("#previous_btn_cv").click(function () {
  $("#finance-tab").trigger("click");
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$("#uploadCollapse").click(function () {
  $("#collapse2").collapse("hide");
  $("#collapse1").collapse("show");
});

$("#fillCollapse").click(function () {
  $("#collapse1").collapse("hide");
  $("#collapse2").collapse("show");
});



// Avalduse submit

$(function() { // lühiversioon document.ready funktsioonist
  $('#register_form').on('submit', function(e) {

      // submit ei vii järgmisele lehele
      e.preventDefault();

      // Eemaldame submit funktsiooni, et saada käivitada käsitsi
      $(this).unbind('submit');  

      // äriplaani osa väljad 
      var allInputs = $("#collapse2 :input"); //  Valib kõik inputid - textarea, radio, checked ...
      var allLabels = $("#collapse2 label");

      // kasutatud set, sest 1 labeli all võib olla mitu input välja
      var errorMessageArray = new Set();

      $.each(allInputs, function(index, value) {
        var originalValue = value.value;
        var trimmedValue = String(originalValue.trim());  

        //Object.keys(trimmedValue)
        if (trimmedValue.length < 10) {          
          if (index==54 || index== 55) {

            errorMessageArray.add(String(allLabels[49].outerText));

          } else if(index==51 || index==52 || index ==53 ){

            errorMessageArray.add(String(allLabels[48].outerText));

          } else if(index==31 || index==32 || index ==33 ){

            errorMessageArray.add(String(allLabels[29].outerText));

          }else if (index > 49) {
            // do nothing
          } else {
            
            errorMessageArray.add(String(allLabels[index].outerText));

          }
        } // if input liiga lühike lõpp    
      }); // foeach input lõpp

      // KAS SUBMIT VÕI MITTE
      
      if (errorMessageArray.size == 0) {
        //kui korras submitime
        // submiti tegemine käsitsi 
        e.currentTarget.submit();
        
      } else {
        // täidame errorMessages divi
        $("#errorMessages").css("border", "solid 1px red");
        $("#errorMessages").css("padding", "1%");

        var title = $("<h5></h5>").text("Palun vaadake üle:");
        $("#errorMessages").append(title);
        errorMessageArray.forEach(element => {
          var message = $("<li></li>").text(element);
          $("#errorMessages").append(message);
          $("#data-tab").trigger("click");
        });

      }

  }); // Avalduse submit lõpp
}); // Avalduse submit lõpp

// äriplaanile kuupäeva saamine
n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("business_date").innerHTML ="Koostamise kuu ja aasta: " + m + "/" + y;


