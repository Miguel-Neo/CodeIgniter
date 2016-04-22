
<h3><?php echo dictionary('theme_role').": ".$role->role; ?></h3>


<form action="" method="post">
    <input type="hidden" name="save_permissionsRole" value="1">
    <?php if (isset($permisos)): ?>
        <table>
            <tr>
                <th><?= dictionary('theme_id'); ?></th>
                <th><?= dictionary('theme_permission'); ?></th>
                <th><?= dictionary('theme_enabled'); ?></th>
                <th><?= dictionary('theme_denied'); ?></th>
                <th><?= dictionary('theme_unknown'); ?></th>
            </tr>
            <?php foreach ($permisos as $permiso): ?>
                <tr>
                    <td><?php echo $permiso['id']; ?></td>
                    <td><?php echo $permiso['title'].' ('.$permiso['permission'].')'; ?></td>
                    <td>
                        <input type="radio" name="perm_<?= $permiso['id'] ?>" value="1" <?php if ($permiso['value'] == 1) echo ' checked="checked"'; ?> >
                    </td>
                    <td>
                        <input type="radio" name="perm_<?= $permiso['id'] ?>" value="" <?php if ($permiso['value'] == '') echo ' checked="checked"'; ?> >
                    </td>
                    <td>
                        <input type="radio" name="perm_<?= $permiso['id'] ?>" value="x" <?php if ($permiso['value'] === "x") echo ' checked="checked"'; ?> >
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <input type="submit" value="<?= dictionary('theme_save'); ?>">
</form>
