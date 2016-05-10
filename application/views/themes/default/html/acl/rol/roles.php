<?php
    if (isset($roles)):
        $this->load->library('table');
        $this->table->set_heading(
                dictionary('theme_id'),
                dictionary('theme_role')
                );
        foreach($roles as $role){
            $this->table->add_row(
                    $role['id'],
                    $role['role'],
                    anchor('roles/editar/'.$role['id'],
                            dictionary('theme_edit')
                            ),
                    anchor('roles/permisos/'. $role['id'] ,
                            dictionary('theme_permissions')
                            ),
                
                    anchor('roles/eliminar/'. $role['id'] ,
                            dictionary('theme_delete'),
                            array('onclick' => 'return confirm_delete();')
                            )
                
                    );
        }
        echo $this->table->generate();
    endif;
    
    echo anchor('roles/nuevo' , 
            dictionary('theme_txt_add_role')
            );
?>
