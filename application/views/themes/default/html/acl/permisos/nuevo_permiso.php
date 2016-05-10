<?php 
$this->load->helper('form');
?>

<?= form_open($action,'',$input_hidden); ?>
<p>
    <?= form_label(dictionary('theme_description'), 'title') ?>
    <?= form_input(['id' => 'title', 'name' => 'title'], set_value('title')) ?>
    <?= form_error('title') ?>
</p>
<p>
    <?= form_label(dictionary('theme_permission'), 'name') ?>
    <?= form_input(['id' => 'name', 'name' => 'name'], set_value('name')) ?>
    <?= form_error('name') ?>
</p>
    <?= form_submit(['value' => dictionary('theme_save')]) ?>

<?= form_close(); ?>
