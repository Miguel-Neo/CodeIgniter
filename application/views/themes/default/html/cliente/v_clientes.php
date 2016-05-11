<?php
/**
 * Esta es la vista principal de los servicion 
 * Aqui se listan todos los servicio esn formato de tabla
 * tienen links para ir a {editar}, {eliminar} y {nuevo}
 * 
 * @param type $servicios Es un array con todos los registros de los servicios
 */
if(isset($tab_clientes)){
    $this->load->library('table');
    echo $this->table->generate($tab_clientes);
}
echo anchor('Cliente/nuevo' , dictionary('theme_txt_add_element'));
?>
