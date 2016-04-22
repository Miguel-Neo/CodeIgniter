
<form action="" method="post">
    <input type="hidden" name="new_permission" value="1" />
    
    <label for="title"><?= dictionary('theme_description'); ?></label>
    <input type="input" name="title" /><br />
    
    <label for="name"><?= dictionary('theme_permission'); ?></label>
    <input type="input" name="name" /><br />
    
    <p>
        <input type="submit" value="<?= dictionary('theme_save'); ?>" />
    </p>
</form>