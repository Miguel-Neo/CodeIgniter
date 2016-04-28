<?php
/**
 * Esta es la vista principal de los servicion 
 * Aqui se listan todos los servicio esn formato de tabla
 * tienen links para ir a {editar}, {eliminar} y {nuevo}
 * 
 * @param type $servicios Es un array con todos los registros de los servicios
 */
if (isset($clientes)) {
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
    foreach ($clientes as $cliente) {
        $this->table->add_row(
                $cliente['id'], 
                $cliente['razonSocial'], 
                anchor(
                        'Cliente/editar/'. $cliente['id'] , 
                        dictionary('theme_edit')
                        ),
                anchor(
                        'Cliente/eliminar/'. $cliente['id'] , 
                        dictionary('theme_delete'),
                        array('onclick' => 'return confirm_delete();')
                        )
                );
    }
    echo $this->table->generate();
}
echo anchor('Cliente/nuevo' , dictionary('theme_txt_add_element'));
?>
