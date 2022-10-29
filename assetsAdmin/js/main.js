// SHOW MENU
const showMenu = (toggleId, navbarId,bodyId) =>{
    const toggle = document.getElementById(toggleId),
    navbar = document.getElementById(navbarId),
    bodypadding = document.getElementById(bodyId)

    if(toggle && navbar){
        toggle.addEventListener('click', ()=>{
            // APARECER MENU
            navbar.classList.toggle('show')
            // ROTATE TOGGLE
            toggle.classList.toggle('rotate')
            // PADDING BODY
            bodypadding.classList.toggle('expander')
        })
    }
}
showMenu('nav-toggle','navbar','body')

// LINK ACTIVE COLOR
const linkColor = document.querySelectorAll('.nav__link');   
function colorLink(){
    linkColor.forEach(l => l.classList.remove('active'));
    this.classList.add('active');
}

linkColor.forEach(l => l.addEventListener('click', colorLink));

/*****************************************************************/

$(document).ready(function(){
    $(document).bind('keypress', function(e){
        if (e.keyCode==13) {
       $('#my_form').submit();
       $('#comment').val("");
       }
       
    });
   
});

function post() {
    var comment = document.getElementById("comment").nodeValue;
    var name = document.getElementById("username");
    if(comment && name){
        $.ajax({
            type: 'post',
            url :'commentajax.php',
            data:{
                user_comm:comment,
                user_name:name
            },
            success:function (response) {
                document.getElementById("comment").value= "";
            }
        });
    }
    return false;
}

function autoRefresh_div() {
    $("#result").load("load.php").show();
}

setInterval('autoRefresh_div()', 2000);