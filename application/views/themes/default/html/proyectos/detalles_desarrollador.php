<?php
$this->load->helper('form');
?>
detalles DESARROLLADOR

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


<div>
    <div>
        <br>estatus:<br>
        
        <div><?= $estatus; ?></div>
        <br>
    </div>
    <div>
        <div id="body_chat" data-idProyecto="<?= $idProyecto;?>"></div>
        <?= form_open($action_chat,['id'=>'form_chat']); ?>
        <?= form_input(['id'=>'input_msg_chat','name'=>'msg'])?>
        <?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
        <?= form_close() ?>
    </div>
</div>
