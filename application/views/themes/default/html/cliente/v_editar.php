<?php
$this->load->helper('form');

echo form_open('email/send');
echo form_hidden('username', 'johndoe');
?>
<?= form_close() ?>