<form action="" method="post">
    <input type="hidden" name="new_permission" value="1" />
    
    <label for="title"><?php dictionary('theme_description'); ?></label>
    <input type="input" name="title" /><br />
    
    <label for="name"><?php dictionary('theme_name'); ?></label>
    <input type="input" name="name" /><br />
    
    <p>
        <input type="submit" value="<?php dictionary('theme_save'); ?>" />
    </p>
</form>