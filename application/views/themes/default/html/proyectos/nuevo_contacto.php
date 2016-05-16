<?php
$this->load->helper('form');
?>
<?= form_open($action,'',$input_hidden)?>


<p>
    <?= form_label('Contacto', 'contacto'); ?>
    <?= form_dropdown('contacto', $contactos); ?>
</p>


<?= form_submit(['value' => dictionary('cms_general_label_button_access')]) ?>
<?= form_close() ?>