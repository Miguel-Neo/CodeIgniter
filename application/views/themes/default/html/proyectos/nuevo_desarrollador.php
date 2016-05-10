<?php
$this->load->helper('form');
?>
<?= form_open($action,'',$hidden)?>


<p>
    <?= form_label('Colaborador', 'user'); ?>
    <?= form_dropdown('user', $usuarios); ?>
</p>
<p>
    <?= form_label('Rol', 'Rol'); ?>
    <?= form_dropdown('Rol', $rol); ?>
</p>


<?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
<?= form_close() ?>