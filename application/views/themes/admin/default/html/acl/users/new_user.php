<h2><?php dictionary('theme_txt_add_user'); ?></h2>

<form name="form1" action="" method="post">
    <input type="hidden" name="guardar" value="1" />

    <label for="name"><?php dictionary('theme_name'); ?></label>
    <input type="input" name="name" /><br />

    <label for="email"><?php dictionary('theme_email'); ?></label>
    <input type="input" name="email" /><br />

    <label for="user"><?php dictionary('theme_user'); ?></label>
    <input type="input" name="user" /><br />

    <label for="password"><?php dictionary('theme_password'); ?></label>
    <input type="input" name="password" /><br />

    <label for="role"><?php dictionary('theme_role'); ?></label>
    <select name="role">
        <?php if(isset($roles)):?>
        <?php foreach($roles->result() as $role):?>
        <option value="<?php echo $role->id;?>"><?php echo $role->role;?></option>
        <?php endforeach;?>
        <?php endif;?>
    </select>

    <p>
        <input type="submit" value="<?php dictionary('theme_save'); ?>" />
    </p>
</form>
