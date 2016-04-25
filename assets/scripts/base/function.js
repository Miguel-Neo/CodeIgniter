/**
 * Cambiara el idioma haciendo una peticion al controlador Language
 * 
 * Es requerido que el template tenga <body data-baseurl="<?php echo base_url(); ?>">
 * @param {type} lenguage Es el idioma selecionado
 * @returns {undefined} Solo actualiza la pantalla
 */
function setLenguage(lenguage){
    $.ajax({
        url: $('body').data('baseurl')+'login/changeLanguage/'+lenguage,
        success:function (a){
            location.reload();
        }
    });
}

/**
 * Ventana de confirmacion para ir al area de elimiar algun elemento
 * @returns boolean true si se acepto pa peticion y false si se rechaso
 */
function confirm_delete(){
    return confirm("¿Está seguro de que desea eliminar permanentemente el elemento?");
}