const visibilityToggle = document.querySelector('.visibility');

const input = document.querySelector('.input input');

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

/***************************************** */

const visibilityToggle1 = document.querySelector('#visibility1');

const input1 = document.querySelector('.input-two input');

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

$('#change_pass').submit(function (event){
  var pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}/;
  var chaine1 = $('.form-control1').val();
  var chaine2 = $('.form-control2').val();

  
  if(pattern.test(chaine1)==false){
    $('.erreur_pass1').text("Veuillez saisir un mot de pass correct");
    $('.erreur_pass1').addClass('lancer');
    event.preventDefault();
  }else{
    
    if (chaine1==chaine2) {
        $('.erreur_pass1').removeClass('lancer');
        $('.erreur_pass2').removeClass('lancer_1');
        
    }else{
        $('.erreur_pass2').text("mot de pass érrone");
        $('.erreur_pass2').addClass('lancer_1');
        event.preventDefault();
    }
  }


});