<?php 
$this->load->helper('form');

?>
<?= form_open($action,'',$input_hidden); ?>

    <?= form_label(dictionary('theme_role'), 'role') ?>
    <?= form_input(['id' => 'role', 'name' => 'role'], set_value('role',$role)) ?>
    <?= form_error('role') ?>

    <?= form_submit(['value' => dictionary('theme_save')]) ?>

<?= form_close(); ?>

