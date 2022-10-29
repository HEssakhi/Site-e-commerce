$(document).ready(function(){
    $('#search').click(function(){
        $('.chercher').addClass('active')
        $('#close').addClass('active')
        $('#search').hide()

    })
    
    $('#close').click(function(){
        $('.chercher').removeClass('active')
        $('#close').removeClass('active')
        $('#search').show()

    }) 
})
    
