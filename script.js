// class UI {
//   static changeCategory(nextdiv, currentdiv) {
//     currentdiv.classList.add("hidden");
//     nextdiv.classList.remove("hidden");
//     if ((currentdiv = datadiv)) {
//       nextData = document.querySelector("#nextData");
//       nextData.addEventListener("click", (e) => {
//         UI.changeCategory(businessdiv, datadiv);
//       });
//     }
//   }
// }

// appdiv = document.querySelector("#application");
// datadiv = document.querySelector("#data");
// businessdiv = document.querySelector("#application");
// appdiv = document.querySelector("#application");
// nextData = document.querySelector("#nextData");
// document.querySelector("#start").addEventListener("click", (e) => {
//   UI.changeCategory(datadiv, appdiv);
// });

// nextData.addEventListener("click", (e) => {
//   UI.changeCategory(businessdiv, datadiv);
// });

document.querySelector("#start").addEventListener("click", (e) => {
  window.location.href = "andmed.html";
});
