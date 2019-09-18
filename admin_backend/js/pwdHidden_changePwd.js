let eye_1 = document.querySelector("#eye_1");
let old_pwd = document.querySelector("#old_pwd");
let eye_icon_1 = eye_1.querySelector("i");
eye_1.addEventListener("click", function(e) {
  e.preventDefault();
  if (old_pwd.type == "password") {
    old_pwd.type = "text";
    eye_icon_1.className = "far fa-eye";
  } else {
    old_pwd.type = "password";
    eye_icon_1.className = "far fa-eye-slash";
  }
});

let eye_2 = document.querySelector("#eye_2");
let eye_icon_2 = eye_2.querySelector("i");
let password = document.querySelectorAll(".pwdVisibility");

eye_2.addEventListener("click", function(e) {
  e.preventDefault();
  if (password[0].type == "password" && password[1].type == "password") {
    password[0].type = "text";
    password[1].type = "text";
    eye_icon_2.className = "far fa-eye";
  } else {
    password[0].type = "password";
    password[1].type = "password";
    eye_icon_2.className = "far fa-eye-slash";
  }
});
