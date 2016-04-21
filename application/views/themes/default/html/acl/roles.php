

<?php if (isset($roles)): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Role</th>
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
                <a href="<?php echo base_url('roles/eliminar') . '/' . $role['id']; ?>">
                    <?= dictionary('theme_delete') ?>
                </a>
            </td>
            <td>
                <a href="<?php echo base_url('roles/permisos') . '/' . $role['id']; ?>">
                    <?= dictionary('theme_permissions') ?>
                </a>
            </td>
        </tr>

    <?php endforeach; ?>
    </table>
<?php endif; ?>

<p><a href="<?php echo base_url('roles/nuevo_rol'); ?>">Agregar Role</a></p>