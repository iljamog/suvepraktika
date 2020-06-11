// äriplaani vormi tekitamine


function createBusinessPlanForm() {

    // kustutab nupud
    $("#business_plan_form_div").empty();

    // tekitab vormi

    $("#business_plan_form_div").append(
        "<h2> Loodava ettevõtte üldandmed </h2>");

}

$( document ).ready(function() {
    document.getElementById("business_plan_form_button").addEventListener("click", createBusinessPlanForm);

    
});



