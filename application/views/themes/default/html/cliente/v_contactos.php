<?php
/**
 * Esta es la vista principal de los servicion 
 * Aqui se listan todos los servicio esn formato de tabla
 * tienen links para ir a {editar}, {eliminar} y {nuevo}
 * 
 * @param type $servicios Es un array con todos los registros de los servicios
 */
if (isset($contactos)) {
    $this->load->library('table');
    $template = array(
        'table_open'            => '<table border="1" cellpadding="4" cellspacing="0">',
        'table_close'           => '</table>'
    );
    $this->table->set_template($template);
    
    $this->table->set_heading(
            dictionary('theme_id'),
            dictionary('theme_name'),
            dictionary('theme_edit'),
            dictionary('theme_delete')
            );
    foreach ($contactos as $contacto) {
        $this->table->add_row(
                $contacto['id'], 
                $contacto['nombre'], 
                $contacto['apellidos'], 
                anchor(
                        'Contacto/editar/'. $contacto['id'] , 
                        dictionary('theme_edit')
                        ),
                anchor(
                        'Contacto/eliminar/'. $contacto['id'].'/'.$idCliente , 
                        dictionary('theme_delete'),
                        array('onclick' => 'return confirm_delete();')
                        )
                );
        
    }
    echo $this->table->generate();
}
echo anchor('Contacto/nuevo/'.$idCliente , dictionary('theme_txt_add_element'));
?>
