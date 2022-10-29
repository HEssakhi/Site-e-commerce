$(document).ready(function(){
    $('#search').click(function(){
        $('.menu-item').addClass('hide-item')
        $('.search-form').addClass('active')
        $('.close').addClass('active')
        $('#search').hide()

    })
    $('.close').click(function(){
        $('.menu-item').removeClass('hide-item')
        $('.search-form').removeClass('active')
        $('.close').removeClass('active')
        $('#search').show()

    }) 
})

$(document).ready(function(){
    $('#barmenu').click(function(){
        $('.icon-menu').addClass('hide')
        $('.icon-close').addClass('active')
        $('.menu-item').addClass('active')
        $('#nav').addClass('active')

    })
    $('#barmenu1').click(function(){
        $('.icon-menu').removeClass('hide')
        $('.icon-close').removeClass('active')
        $('.menu-item').removeClass('active')
        $('#nav').removeClass('active')
    })
})
