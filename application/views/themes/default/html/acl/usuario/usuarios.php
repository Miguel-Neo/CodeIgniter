

<?php if (isset($usuarios) && count($usuarios)): ?>
    <table>
        <tr><td><?= dictionary('theme_id'); ?></td>
            <td><?= dictionary('theme_user'); ?></td>
            <td><?= dictionary('theme_role'); ?></td>
            <td></td>
        </tr>
        <?php foreach ($usuarios as $us): ?>

            <tr>
                <td><?php echo $us->id; ?></td>
                <td><?php echo $us->name; ?></td>
                <td><?php echo $us->role; ?></td>

                <td>
                    <?= anchor('usuario/permisosusuario/'. $us->id , dictionary('theme_permissions'));?>
                    
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?= anchor('usuario/nuevo', dictionary('theme_txt_add_user'));?>

