<?php


if(isset($proyectos)){
    $this->load->library('table');
    $this->table->set_heading(
            'id','nombre'
            );
    foreach($proyectos as $proyecto){
        $this->table->add_row(
                $proyecto['id'],
                $proyecto['nombre'],
                $this->user->has_permission('Proyectos/detalles') ? 
                anchor('Proyectos/detalles/'.$proyecto['id'],"Detalles"):''
                );
    }
    echo $this->table->generate();
}
if($this->user->has_permission('Proyectos/index'))
echo anchor('Proyectos/nuevo',dictionary('theme_txt_add_element'));
