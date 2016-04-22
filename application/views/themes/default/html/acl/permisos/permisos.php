
<?php if (isset($permissions) && count($permissions)): ?>
    <table>
        <tr><td><?= dictionary('theme_id'); ?></td>
            <td><?= dictionary('theme_title'); ?></td>
            <td><?= dictionary('theme_permissions'); ?></td>
            <td><?= dictionary('theme_edit'); ?></td>
            <td></td>
        </tr>
        <?php foreach ($permissions as $permission): ?>


            <form action="" method="post">
                <input type="hidden" name="edit_permission" value="1" />
                <input type="hidden" name="id" value="<?php echo $permission->id; ?>" />
                <tr> 
                    <td><?php echo $permission->id; ?></td>
                    <td><input type="text" name="title" value="<?php echo $permission->title; ?>"></td>
                    <td><input type="text" name="name" value="<?php echo $permission->name; ?>"></td>

                    <td>
                        <input type="submit" value="<?= dictionary('theme_save'); ?>" />
                    </td>
                    <td>
                        <?= anchor('permisos/eliminar/'.$permission->id, dictionary('theme_delete'));?>
                        
                    </td>
                </tr>

            </form>

        <?php endforeach; ?>
    </table>

<?php endif; ?>
<?= anchor('permisos/nuevo' , dictionary('theme_txt_add_permission'));?>
