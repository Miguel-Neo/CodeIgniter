<?php
/**
 * Esta vista es usada tanto para crear un NUEVO usuario como para EDITAR sus datos
 * 
 * 
 * @param $action : El action del formulario
 * @param $input_hidden : Elementos del formulario q van ocultos
 * @param $tipos_de_empresa : Lista con todos los tipos de empresas
 * @param $default Array
 * 
 * @return
 * Elementos ocultos
 * here[razon_social]
 * ext[cp]
 * ext[direccion]
 * ext[tipo_de_empresa]
 * ext[telefono_1]
 * ext[telefono_2]
 * ext[sitio_web]
 * logo
 * 
 * El arreglo ext[] se pueden añadir tantos como sean requeridos, el controlador 
 * los identifica de forma automatica
 */
$this->load->helper('form');


?>
<?= form_open_multipart($action, '', $input_hidden); ?>
<p>
    <?= form_label(dictionary('theme_cliente_razon_social'), 'razon_social') ?>
    <?= form_input(['id' => 'razon_social', 'name' => 'here[razon_social]'], set_value('here[razon_social]',$default['rs'])) ?>
    <?= form_error('here[razon_social]') ?>
</p>
<p>
    <?= form_label('C.P.', 'cp') ?>
    <?= form_input(['id' => 'cp', 'name' => 'ext[cp]'], set_value('ext[cp]',$default['cp'])) ?>
    <?= form_error('ext[cp]') ?>
</p>
<p>
    <?= form_label(dictionary('theme_cliente_razon_direccion'), 'direccion') ?>
    <?= form_input(['id' => 'direccion', 'name' => 'ext[direccion]'], set_value('ext[direccion]',$default['dir'])) ?>
    <?= form_error('ext[direccion]') ?>
</p>
<p>
    <?= form_label('Tipo de empresa', 'tipo_de_empresa'); ?>
    <?= form_dropdown('ext[tipo_de_empresa]', $tipos_de_empresa, $default['emp']); ?>

</p>
<p>
    <?= form_label('Telefono 1', 'telefono_1') ?>
    <?= form_input(['id' => 'telefono_1', 'name' => 'ext[telefono_1]'], set_value('ext[telefono_1]',$default['t1'])) ?>
    <?= form_error('ext[telefono_1]') ?>
</p>
<p>
    <?= form_label('Telefono 2', 'telefono_2') ?>
    <?= form_input(['id' => 'telefono_2', 'name' => 'ext[telefono_2]'], set_value('ext[telefono_2]',$default['t2'])) ?>
    <?= form_error('ext[telefono_2]') ?>
</p>
<p>
    <?= form_label('Sitio web', 'sitio_web') ?>
    <?= form_input(['id' => 'sitio_web', 'name' => 'ext[sitio_web]'], set_value('ext[sitio_web]',$default['web'])) ?>
    <?= form_error('ext[sitio_web]') ?>
</p>
<p>
   <?= form_upload(['name'=>'logo']);?> 
</p>
<?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
<?= form_close() ?>
