

<?php if (isset($roles)): ?>
    <table>
        <tr>
            <th><?= dictionary('theme_id'); ?></th>
            <th><?= dictionary('theme_role'); ?></th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($roles as $role): ?>

            <tr>
            <form action="<?= base_url() . 'roles/editar' ?>" method="post">
                <input type="hidden" name="edit_role" value="1" />
                <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
                <td>
                    <?php echo $role['id']; ?>
                </td>
                <td>
                    <input type="input" name="role" value="<?php echo $role['role']; ?>"/>
                </td>
                <td>
                    <input type="submit" value="<?= dictionary('theme_edit'); ?>" />
                </td>
            </form>
            <td>
                <?= anchor('roles/eliminar/'. $role['id'] , dictionary('theme_delete'));?>
                
            </td>
            <td>
                <?= anchor('roles/permisos/'. $role['id'] , dictionary('theme_permissions'));?>
                
            </td>
        </tr>

    <?php endforeach; ?>
    </table>
<?php endif; ?>

<?= anchor('roles/nuevo' , dictionary('theme_txt_add_role'));?>