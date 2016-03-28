/*
 * Este codigo evitara menu cierre inesperado 
 * cuando se utiliza algunos componentes 
 * (como el acordeon, formas, etc.)
 */
 
$(function () {
    window.prettyPrint && prettyPrint()
    $(document).on('click', '.yamm .dropdown-menu', function (e) {
        e.stopPropagation()
    })
})