var accordions = document.getElementsByClassName("accordion-link");

for (var i = 0; i < accordions.length; i++) {
  accordions[i].onclick = function() {
    this.classList.toggle('is-open');

    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
      // accordion is currently open, so close it
      content.style.maxHeight = null;
    } else {
      // accordion is currently closed, so open it
      content.style.maxHeight = content.scrollHeight + "px";
    }
  }
}

/*******************************************/

window.sr = ScrollReveal();

sr.reveal('.animate-top', {
    origin: 'top',
    duration: 700,
    distance: '2rem', 
    delay:150,
    easing:'ease',
});

sr.reveal('.animate-bottom', {
    origin: 'bottom',
    duration: 700,
    distance: '2rem', 
    delay:150,
    easing: 'ease',
});
