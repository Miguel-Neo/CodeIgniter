<?php

$name = '';
$email = '';
if(isset($user)){
   $name =  $user['name'];$email = $user['email'];
}
?>
<h2><?php dictionary('theme_txt_add_user'); ?></h2>

<form name="form1" action="" method="post">
    <input type="hidden" name="nuevo_usuario" value="1" />

    <label for="name"><?= dictionary('theme_name'); ?></label>
    <input type="input" name="name" value="<?=$name?>"/><br />

    <label for="email"><?= dictionary('theme_email'); ?></label>
    <input type="input" name="email" value="<?=$email?>"/><br />

    <label for="user"><?= dictionary('theme_user'); ?></label>
    <input type="input" name="user" /><br />

    <label for="password"><?= dictionary('theme_password'); ?></label>
    <input type="input" name="password" /><br />

    <label for="role"><?= dictionary('theme_role'); ?></label>
    <select name="role">
        <?php if(isset($roles)):?>
        
        <?php foreach($roles as $role):?>
        <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
        <?php endforeach;?>
        <?php endif;?>
    </select>

    <p>
        <input type="submit" value="<?= dictionary('theme_save'); ?>" />
    </p>
</form>
