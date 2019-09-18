let eye = document.querySelector("#eye");
let eye_icon = eye.querySelector("i");
let password = document.querySelector(".pwdVisibility");
eye.addEventListener("click", function(e) {
  e.preventDefault();
  if (password.type == "password") {
    password.type = "text";
    eye_icon.className = "far fa-eye";
  } else {
    password.type = "password";
    eye_icon.className = "far fa-eye-slash";
  }
});
