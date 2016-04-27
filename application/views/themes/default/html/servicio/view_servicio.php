<?php
/**
 * Esta es la vista principal de los servicion 
 * Aqui se listan todos los servicio esn formato de tabla
 * tienen links para ir a {editar}, {eliminar} y {nuevo}
 * 
 * @param type $servicios Es un array con todos los registros de los servicios
 */
if (isset($servicios)) {
    $this->load->library('table');
    $template = array(
        'table_open'            => '<table border="1" cellpadding="4" cellspacing="0">',
        'table_close'           => '</table>'
    );
    $this->table->set_template($template);
    
    $this->table->set_heading(
            dictionary('theme_id'),
            dictionary('theme_created'),
            dictionary('theme_name'),
            dictionary('theme_description'),
            dictionary('theme_edit'),
            dictionary('theme_delete')
            );
    foreach ($servicios as $servicio) {
        $this->table->add_row(
                $servicio['id'], 
                $servicio['fechaRegistro'], 
                $servicio['nombre'], 
                $servicio['descripcion'],
                anchor(
                        'Servicio/editar/'. $servicio['id'] , 
                        dictionary('theme_edit')
                        ),
                anchor(
                        'Servicio/eliminar/'. $servicio['id'] , 
                        dictionary('theme_delete'),
                        array('onclick' => 'return confirm_delete();')
                        )
                );
    }
    echo $this->table->generate();
}
echo anchor('Servicio/nuevo' , dictionary('theme_txt_add_element'));
?>
