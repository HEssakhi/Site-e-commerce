
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	$("#progressbar li").eq($("fieldset").index(current_fs)).addClass("valid");

	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	$("#progressbar li").eq($("fieldset").index(previous_fs)).removeClass("valid");

	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

/*****************************************************/

function copie() {

    /*** had lvariable "d" htit fih l combo box kamla */
    var d = document.getElementById("bien");
    /****hna glt lih ched liya ghir la valeur choisi o affectiha l variable display */
    var display = d.options[d.selectedIndex].text;

    /**********hna fin drt test 3la dik la valeur choisi ila kant k tsawi wahda mn had les critères y affichiha sinon
     y khali dik input khawya o ybdel liha type dyalha mn "text" l "tel"
     */
    if (display == "Appartement") {
		$('#appartements').addClass('shown1')
		$('#bureau-plateaux').removeClass('shown2')
		$('#villa-maison').removeClass('shown3')
		$('#magasin').removeClass('shown4')
	}
	 if(display == "Bureaux et Plateaux"){
		$('#bureau-plateaux').addClass('shown2')
		$('#appartements').removeClass('shown1')
		$('#villa-maison').removeClass('shown3')
		$('#magasin').removeClass('shown4')
	}
	if(display == "Maison" || display == "Villa"){
		$('#villa-maison').addClass('shown3')
		$('#bureau-plateaux').removeClass('shown2')
		$('#appartements').removeClass('shown1')
		$('#magasin').removeClass('shown4')
	}
	if(display == "Magasin Commerce" || display == "locaux industriels"){
		$('#magasin').addClass('shown4')
		$('#bureau-plateaux').removeClass('shown2')
		$('#appartements').removeClass('shown1')
		$('#villa-maison').removeClass('shown3')
	}
}

/*****************************************************/

function triggerclick1() {
    document.querySelector('#profileimage1').click();
}

function displayimage1(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
			document.querySelector('#profiledisplay1').setAttribute('src', e.target.result);
			$('#profiledisplay1').addClass('hidden-border')
        }
        reader.readAsDataURL(e.files[0]);
    }
}

/*********************image2****************** */

function triggerclick2() {
    document.querySelector('#profileimage2').click();
}

function displayimage2(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
			document.querySelector('#profiledisplay2').setAttribute('src', e.target.result);
			$('#profiledisplay2').addClass('hidden-border')
        }
        reader.readAsDataURL(e.files[0]);
    }
}

/***********image3*************************/
function triggerclick3() {
    document.querySelector('#profileimage3').click();
}

function displayimage3(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
			document.querySelector('#profiledisplay3').setAttribute('src', e.target.result);
			$('#profiledisplay3').addClass('hidden-border')
        }
        reader.readAsDataURL(e.files[0]);
    }
}

/*********************delete first image*****************/

$( ".delete1" ).on( "click", function() {
	document.getElementById("profiledisplay1").src = "assets/images/upload.png";
	$('#profiledisplay1').removeClass('hidden-border')
});

/*********************delete second image*****************/

$( ".delete2" ).on( "click", function() {
	document.getElementById("profiledisplay2").src = "assets/images/upload.png";
	$('#profiledisplay2').removeClass('hidden-border')
});

/*********************delete third image*****************/

$( ".delete3" ).on( "click", function() {
	document.getElementById("profiledisplay3").src = "assets/images/upload.png";
	$('#profiledisplay3').removeClass('hidden-border')
});