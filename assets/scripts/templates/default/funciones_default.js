window.addEventListener('load',
        function () {

            setTimeout(function () {
                $("#panel_message_alert").hide("blind", 2000);
            }, 1000);
        }

);

/*
 *  SUAVIZAR LA TRANSICIÓN QUE SE DA MEDIANTE LAS ANCLAS DE LA BARRA DE MENU
 */

$('.menu_con_efecto_scroll').click(function () {

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            && location.hostname == this.hostname) {

        var $target = $(this.hash);

        $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');

        if ($target.length) {
            $('#mobile-menu').toggle();
            var targetOffset = $target.offset().top - $("#main-header").outerHeight(true);

            $('html,body').animate({scrollTop: targetOffset}, 1000);

            return false;

        }

    }

});

/**
 * Cambiara el idioma haciendo una peticion al controlador Language
 * 
 * Es requerido que el template tenga <body data-baseurl="<?php echo base_url(); ?>">
 * @param {type} lenguage Es el idioma selecionado
 * @returns {undefined} Solo actualiza la pantalla
 */
function setLenguage(lenguage){
    $.ajax({
        url: $('body').data('baseurl')+'Languaje/change/'+lenguage,
        success:function (a){
            location.reload();
        }
    });
}
/*  ./SUAVIZAR LA TRANSICIÓN QUE SE DA MEDIANTE LAS ANCLAS DE LA BARRA DE MENU  */