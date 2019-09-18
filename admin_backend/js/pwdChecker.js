let pass = document.querySelector("#password");
let strengthBar = document.querySelector("#strength");
pass.addEventListener("keyup", function() {
  checkPassword(pass.value);
});

function checkPassword(password) {
  let strengthBar = document.querySelector("#strength");
  let strength = 0;
  if (password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)) {
    strength += 1;
  }
  if (password.match(/[~<>?]+/)) {
    strength += 1;
  }
  if (password.match(/[!@£$%^&*()]+/)) {
    strength += 1;
  }
  if (password.length > 5) {
    strength += 1;
  }

  switch (strength) {
    case 0:
      strengthBar.style.width = "0%";
      break;
    case 1:
      strengthBar.style.width = "25%";
      break;
    case 2:
      strengthBar.style.width = "50%";
      break;
    case 3:
      strengthBar.style.width = "75%";
      break;
    case 4:
      strengthBar.style.width = "100%";
      break;
  }
}
