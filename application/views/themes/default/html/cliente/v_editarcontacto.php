<?php
$this->load->helper('form');


?>
<?= form_open_multipart($action, '', $input_hidden); ?>
<p>
    <?= form_label(dictionary('theme_name'), 'nombre') ?>
    <?= form_input(['id' => 'nombre', 'name' => 'here[nombre]'], set_value('here[nombre]',$default['nombre'])) ?>
    <?= form_error('here[nombre]') ?>
</p>
<p>
    <?= form_label(dictionary('theme_contacto_apellidos'), 'apellidos') ?>
    <?= form_input(['id' => 'apellidos', 'name' => 'here[apellidos]'], set_value('here[apellidos]',$default['apellidos'])) ?>
    <?= form_error('here[apellidos]') ?>
</p>


<p>
    <?= form_label('Puesto', 'puesto') ?>
    <?= form_input(['id' => 'puesto', 'name' => 'ext[puesto]'], set_value('ext[puesto]',$default['puesto'])) ?>
    <?= form_error('ext[puesto]') ?>
</p>

<p>
    <?= form_label('Telefono 1', 'telefono_1') ?>
    <?= form_input(['id' => 'telefono_1', 'name' => 'tel[telefono_1][1]'], set_value('tel[telefono_1][1]',$default['t1'])) ?>
    <?= form_error('tel[telefono_1][1]') ?>
</p>
<p>
    <?= form_label('Ext.', 'ext_1') ?>
    <?= form_input(['id' => 'ext_1', 'name' => 'tel[telefono_1][2]'], set_value('tel[telefono_1][2]',$default['t1ext'])) ?>
    <?= form_error('tel[telefono_1][2]') ?>
</p>
<p>
    <?= form_label('Telefono 2', 'telefono_2') ?>
    <?= form_input(['id' => 'telefono_2', 'name' => 'tel[telefono_2][1]'], set_value('tel[telefono_2][1]',$default['t2'])) ?>
    <?= form_error('tel[telefono_2][1]') ?>
</p>
<p>
    <?= form_label('Ext.', 'ext_2') ?>
    <?= form_input(['id' => 'ext_2', 'name' => 'tel[telefono_2][2]'], set_value('tel[telefono_2][2]',$default['t2ext'])) ?>
    <?= form_error('tel[telefono_2][2]') ?>
</p>

<p>
    <?= form_label('Celular', 'celular') ?>
    <?= form_input(['id' => 'celular', 'name' => 'ext[celular]'], set_value('ext[celular]',$default['celular'])) ?>
    <?= form_error('ext[celular]') ?>
</p>
<p>
    <?= form_label('e-mail', 'e-mail') ?>
    <?= form_input(['id' => 'puesto', 'name' => 'ext[e-mail]'], set_value('ext[e-mail]',$default['e-mail'])) ?>
    <?= form_error('ext[e-mail]') ?>
</p>
<p>
   <?php //form_upload('img[img_logo]');?> 
</p>
<?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
<?= form_close() ?>