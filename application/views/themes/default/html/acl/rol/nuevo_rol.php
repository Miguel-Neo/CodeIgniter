
<form  action="" method="post">
    <input type="hidden" name="guardar_nuevo_rol" value="1" />
    <?= dictionary('theme_role'); ?>: 
    <input type="text" name="role" />
    <input type="submit" value="<?= dictionary('theme_save'); ?>" />
</form>