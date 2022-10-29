function triggerclick() {
    document.querySelector('#profileimage').click();
}

function displayimage(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            document.querySelector('#profiledisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}

$(document).ready(function(){
    $('#profiledisplay').click(function(){
        $('#remarque').addClass('hidden')
        $('#validation').addClass('show')
    })
    $('#reset').click(function(){
        $('#remarque').removeClass('hidden')
        $('#validation').removeClass('show')
    })
})


// tester sur le nom et prenom
$('#form').submit(function (event) {
    
          if (($('#firstName').val()=="" && $('#lastName').val()=="")){
            $('#erreur_nom').text("Veuillez Mr/Ms remplir ce champ");
            $('#erreur_nom').addClass('lancer_1');
            $('#erreur_prenom').text("Veuillez Mr/Ms remplir ce champ");
            $('#erreur_prenom').addClass('lancer_2');
            event.preventDefault();
             
          }else{
            $('#erreur_nom').removeClass('lancer_1');
            $('#erreur_prenom').removeClass('lancer_2');
            event.returnValue = false;
          }
          //nom
          if($('#lastName').val()==""){
            $('#erreur_nom').text("Veuillez Mr/Ms remplir ce champ");
            $('#erreur_nom').addClass('lancer_1');
            event.preventDefault();

          }
          // prenom
          if($('#firstName').val()==""){
            $('#erreur_prenom').text("Veuillez Mr/Ms remplir ce champ");
            $('#erreur_prenom').addClass('lancer_2');
            event.preventDefault(); 
          }
});

$('#form_email').submit(function (event){

  var pattern = /^[\w-]+(\.[\w-]+)*@([a-z0-9-]+(\.[a-z0-9-]+)*?\.[a-z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/;
  var chaine = $('#email').val();

  if(pattern.test(chaine)==false){
    $('#erreur_email').text("Veuillez saisir une email correct");
    $('#erreur_email').addClass('lancer_3');
    event.preventDefault();
  }else{
    $('#erreur_email').removeClass('lancer_3');
  }

});

$('#form_tel').submit(function (event){

  var pattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
  var tel = $('#tel').val();

  if(pattern.test(tel)==false){
    $('#erreur_tel').text("Veuillez saisir un num de téléphone correct");
    $('#erreur_tel').addClass('lancer_4');
    event.preventDefault();
  }else{
    $('#erreur_tel').removeClass('lancer_4');
  }

});



