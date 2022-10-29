
var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
   body.className = "sign-in-js"; 
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})

/***********password visibility for sign up***************/

const visibilityToggle = document.querySelector('.visibility');

const input = document.querySelector('#box input');

var password = true;

visibilityToggle.addEventListener('click', function() {
  if (password) {
    input.setAttribute('type', 'text');
    visibilityToggle.innerHTML = 'visibility';
  } else {
    input.setAttribute('type', 'password');
    visibilityToggle.innerHTML = 'visibility_off';
  }
  password = !password;
  
});


/***********password visibility for sign up***************/

const visibilityToggle1 = document.querySelector('#visibility1');

const input1 = document.querySelector('#box1 input');

var password1 = true;

visibilityToggle1.addEventListener('click', function() {
  if (password1) {
    input1.setAttribute('type', 'text');
    visibilityToggle1.innerHTML = 'visibility';
  } else {
    input1.setAttribute('type', 'password');
    visibilityToggle1.innerHTML = 'visibility_off';
  }
  password1 = !password1;
  
});

