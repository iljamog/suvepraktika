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
