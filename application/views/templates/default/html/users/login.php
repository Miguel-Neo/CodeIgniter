<h2>Login</h2>

<?= form_open('', ['id' => 'form_login', 'style' => 'width:300px; margin:0 auto 0 auto'], ['login' => 1]) ?>
<?= form_fieldset('Datos de usuario') ?>

<p>
    <?= form_label($this->lang->line('cms_general_label_user'), 'user')?>
    <?= form_input(['id' => 'user', 'name' => 'user'], set_value('user'))?>
    <?= form_error('user') ?>
</p>

<p>
    <?= form_label($this->lang->line('cms_general_label_password'), 'password')?>
    <?= form_password(['id' => 'password', 'name' => 'password'])?>
    <?= form_error('password') ?>
</p>

<?= form_submit(['value' => $this->lang->line('cms_general_label_button_access')])?>
<?= form_fieldset_close() ?>
<?= form_close() ?>