tinymce.init({
    selector: 'div#div_tinymce',
    height: 500,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
    ]
});


$('#form_chat').submit(function () {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function (data) {
            $('#input_msg_chat').val('');
            get_chat();

        }
    })
    return false;
});
var chat;
window.addEventListener('load', function () {
    get_chat();
    setInterval(get_chat, 3000);
    $("#body_chat").mouseover(function () {
        chat = true;
        console.log('entro el el div');
    });
    $("#body_chat").mouseout(function () {
        chat = false;
        console.log('salio el el div');
    });

}, false);

function get_chat() {
    var idProyecto = document.getElementById('body_chat').getAttribute("data-idProyecto");
    $("#body_chat").load($('body').data('baseurl') + "Proyectos/get_chat_ajax/" + idProyecto);
    if (!chat)
        document.getElementById('body_chat').scrollTop = ($('#mensajes').height());
    return false;
}