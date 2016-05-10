<?php
$this->load->helper('form');
?>
<?= form_open($action,'',$input_hidden)?>
<p>
    <?= form_label('Titulo', 'titulo') ?>
    <?= form_input(['id'=>'titulo','name'=>'titulo'],set_value('titulo'))?>
    <?= form_error('titulo')?>
</p>
<p>
    <?= form_label('Descripcion', 'descripcion') ?>
    <?= form_input(['id'=>'descripcion','name'=>'descripcion'],set_value('descripcion'))?>
    <?= form_error('descripcion')?>
</p>
<p>
    <?= form_label('Servicio', 'servicio'); ?>
    <?= form_dropdown('servicio', $servicios); ?>
</p>
<p>
    <?= form_label('Cliente', 'cliente'); ?>
    <?= form_dropdown('cliente', $clientes,$cliente_selected,['onchange'=>'get_contactos(this.value)']); ?>
</p>
<p>
    <?= form_label('Contacto', 'contacto'); ?>
    <?= form_dropdown('contacto', $contactos,'',['id'=>'contactos']); ?>
</p>
<p>
    <?= form_label('fecha de inicio','fecha_de_inicio')?>
    <input type="date" name="fecha_de_inicio"id="fecha_de_inicio">
</p>
<p>
    
    <?= form_label('fecha de entrega','fecha_de_entrega')?>
    <input type="date" name="fecha_de_entrega" id="fecha_de_entrega">
</p>
<?= form_submit(['value' => dictionary('theme_save')]) ?>
<?= form_close() ?>
