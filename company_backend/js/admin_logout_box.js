// let logout = document.querySelector("#logout");
// let profile = document.querySelector("#profile");
// let clicked = true;
// profile.addEventListener("click", function(e) {
//   if (clicked) {
//     logout.style.display = "block";
//     clicked = false;
//   } else {
//     logout.style.display = "none";
//     clicked = true;
//   }
// });

// jquery
$("#profile").click(function(e) {
  e.stopPropagation();
  $("#logout").toggle();
});
$("body").click(function() {
  $("#logout").hide();
});
