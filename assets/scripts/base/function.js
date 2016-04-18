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