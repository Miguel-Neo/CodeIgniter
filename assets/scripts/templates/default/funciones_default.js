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

function upload_Archivo(){


        
        var formData = new FormData($("#formulario_archivos_proyecto")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: 'do_upload', 
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                

            },
            //una vez finalizado correctamente
            success: function(data){
                console.log(data);
                
            },
            //si ha ocurrido un error
            error: function(){
            }
        });
  
}

/*  ./SUAVIZAR LA TRANSICIÓN QUE SE DA MEDIANTE LAS ANCLAS DE LA BARRA DE MENU  */