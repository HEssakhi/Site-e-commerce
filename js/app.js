// Navigate product images 

const BigImage = document.getElementById('big-image');
const imgSlider = document.getElementById('img-slider');
const first_image = document.getElementById('big-image').getAttribute('src');

imgSlider.addEventListener('click', event => {

    if (event.target === img1) {
         BigImage.setAttribute ("src",first_image);
    }

    else if (event.target === img2) {
        BigImage.setAttribute ("src",first_image);
    }

    else if (event.target === img3) {
        BigImage.setAttribute ("src",first_image);
    }

    else {
    BigImage.setAttribute ("src",first_image);
    }
  
});

// selectionner une taille
   
    $(document).ready(function(){
           $(".item1").click(function(){
                     $(".item1").addClass("active1");
                     $(".item7").removeClass("active7");
                     $(".item6").removeClass("active6");
                     $(".item5").removeClass("active5");
                     $(".item4").removeClass("active4");
                     $(".item3").removeClass("active3");
                     $(".item2").removeClass("active2");
           });

           $(".item2").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item7").removeClass("active7");
                     $(".item6").removeClass("active6");
                     $(".item5").removeClass("active5");
                     $(".item4").removeClass("active4");
                     $(".item3").removeClass("active3");
                     $(".item2").addClass("active2");
           });

           $(".item3").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item2").removeClass("active2");
                     $(".item7").removeClass("active7");
                     $(".item6").removeClass("active6");
                     $(".item5").removeClass("active5");
                     $(".item4").removeClass("active4");
                     $(".item3").addClass("active3");
           });

           $(".item4").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item2").removeClass("active2");
                     $(".item3").removeClass("active3");
                     $(".item7").removeClass("active7");
                     $(".item6").removeClass("active6");
                     $(".item5").removeClass("active5");
                     $(".item4").addClass("active4");
           });

           $(".item5").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item2").removeClass("active2");
                     $(".item3").removeClass("active3");
                     $(".item4").removeClass("active4");
                     $(".item7").removeClass("active7");
                     $(".item6").removeClass("active6");
                     $(".item5").addClass("active5");
           });

           $(".item6").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item2").removeClass("active2");
                     $(".item3").removeClass("active3");
                     $(".item4").removeClass("active4");
                     $(".item5").removeClass("active5");
                     $(".item7").removeClass("active7");
                     $(".item6").addClass("active6");
           });

           $(".item7").click(function(){
                     $(".item1").removeClass("active1");
                     $(".item2").removeClass("active2");
                     $(".item3").removeClass("active3");
                     $(".item4").removeClass("active4");
                     $(".item5").removeClass("active5");
                     $(".item6").removeClass("active6");
                     $(".item7").addClass("active7");
            });

           
    });


    


/***********************************************/

window.sr = ScrollReveal();

sr.reveal('.logo', {
    origin: 'top',
    duration: 1000,
    distance: '6rem', 
    delay:150,
    easing:'ease',
    viewFactor: 0.4,
});

sr.reveal('.card', {
    origin: 'bottom',
    duration: 1000,
    distance: '6rem', 
    easing:'ease',
    delay:500,
    viewFactor: 0.2,
});

sr.reveal('.hexa1', {
  origin: 'right',
  duration: 1000,
  distance: '6rem', 
  easing:'ease',
  delay:450,
  viewFactor: 0.2,
});

sr.reveal('.hexa2', {
  origin: 'right',
  duration: 1000,
  distance: '6rem', 
  easing:'ease',
  delay:550,
  viewFactor: 0.2,
});


sr.reveal('.hexa3', {
  origin: 'left',
  duration: 1000,
  distance: '6rem', 
  easing:'ease',
  delay:650,
  viewFactor: 0.2,
});