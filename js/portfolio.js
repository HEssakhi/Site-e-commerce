$(document).ready(function () {
   AOS.init({
       easing: 'ease',
       duration: 1000
   });
});

/**************les titres*************/

window.sr = ScrollReveal();

sr.reveal('.animate-top', {
    origin: 'top',
    duration: 1000,
    distance: '3rem', 
    delay:150,
    easing:'ease',
    reset: true,
    viewFactor: 0.4,
});

sr.reveal('.animate-bottom', {
    origin: 'bottom',
    duration: 1000,
    distance: '3rem', 
    easing:'ease',
    delay:150,
    reset: true,
    viewFactor: 0.2,
});


sr.reveal('.footer-top', {
    origin: 'top',
    duration: 1000,
    distance: '2rem', 
    delay:150,
    easing:'ease',
    reset: true,
    viewFactor: 0.4,
});

sr.reveal('.footer-bottom', {
    origin: 'bottom',
    duration: 1000,
    distance: '2rem', 
    easing:'ease',
    delay:150,
    reset: true,
    viewFactor: 0.2,
});
