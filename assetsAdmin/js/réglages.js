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
    $('.reset').click(function(){
        $('#remarque').removeClass('hidden')
        $('#validation').removeClass('show')
    })
})
