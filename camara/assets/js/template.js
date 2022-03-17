
jQuery(document).ready(function ($) {
    $('.sidenav').sidenav();
    if ($('.parallax').find('img').length > 0) {
        $('.parallax').parallax();
    }
    $('.modal').modal();
    $('.botonpresupuesto').click(function () {
        $('.modal').modal('open')
    })

})
jQuery(document).scroll(function (event) {
    if (($(window).scrollTop()) >= jQuery('.franjasuperior').height()) {
        jQuery('header').addClass('subrayado');
        jQuery('.franjainferior').addClass('fijado');
        jQuery('article').css('margin-top', '117px');
    } else
    {
        jQuery('header').removeClass('subrayado');
        jQuery('.franjainferior').removeClass('fijado');
        jQuery('article').css('margin-top', '0px');
    }
})
