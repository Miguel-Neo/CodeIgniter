function get_contactos(id_cliente){
	//window.location= $('body').data('baseurl')+"Proyectos/nuevo/"+id_cliente;
	$("#contactos").load($('body').data('baseurl')+"Proyectos/ajax_get_contactos/"+id_cliente);
}