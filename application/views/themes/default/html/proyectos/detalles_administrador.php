<?php
$this->load->helper('form');
?>

<?php
echo '<br>nombre_proyecto:<br>';
echo '<pre>';
print_r($nombre_proyecto);
echo '</pre>';
?>

<?php
echo '<br>nombre_cliente:<br>';
echo '<pre>';
print_r($nombre_cliente);
echo '</pre>';
?>


<?php
echo '<br>Proyecto:<br>';
echo '<pre>';
print_r($proyecto);
echo '</pre>';
?>


<?php
echo '<br>Cliente:<br>';
echo '<pre>';
print_r($cliente);
echo '</pre>';
?>

<?php
echo '<br>Contactos:<br>';
echo '<pre>';
print_r($contactos);
echo '</pre>';
echo anchor('Proyectos/nuevo_contacto/' . $idProyecto . '/' . $cliente['id'], 'nuevo contacto');
?>


<?php
echo '<br>Desarrolladores:<br>';
echo '<pre>';
print_r($users);
echo '</pre>';
echo anchor('Proyectos/nuevo_desarrollador/' . $idProyecto, 'nuevo desarrollador');
?>

<div>
    <?= form_open_multipart($action_tinymce); ?>
    <div id="div_tinymce" contenteditable="true" ><?php if(isset($tinymce)) echo $tinymce;?></div>
    <?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
    <?= form_close() ?>
</div>


<div>
    <div>
        <br>estatus:<br>
        <?= form_open($action_estatus); ?>
        <textarea rows="4" name="estatus"><?= $estatus; ?></textarea>
        <br>
        <?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
        <?= form_close() ?>
    </div>
    <div>
        <div id="body_chat" data-idProyecto="<?= $idProyecto;?>"></div>
        <?= form_open($action_chat,['id'=>'form_chat']); ?>
        <?= form_input(['id'=>'input_msg_chat','name'=>'msg'])?>
        <?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
        <?= form_close() ?>
    </div>
</div>

    