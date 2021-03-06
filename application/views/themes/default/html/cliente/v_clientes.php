<?php
/**
 * @param $tab_clientes : Es un array con todos los registros de los clientes
 */
if(isset($tab_clientes)){
    $this->load->library('table');
    echo $this->table->generate($tab_clientes);
}
echo anchor('Cliente/nuevo' , dictionary('theme_txt_add_element'));

/*
 *Este es el metodo anterior 
 */
/*
if(isset($clientes))
{
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
                        ),
                anchor(
                        'Cliente/contactos/'. $cliente['id'] , 
                        dictionary('theme_contact')
                        )
                );
        
    }
    echo $this->table->generate();
}
//*/
?>
