
<?php if (isset($permissions) && count($permissions)): ?>
    <table>
        <tr><td>ID</td>
            <td>Title</td>
            <td>Name</td>
            <td>Editar</td>
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
                        <input type="submit" value="<?php dictionary('theme_save'); ?>" />
                    </td>
                </tr>

            </form>

        <?php endforeach; ?>
    </table>

<?php endif; ?>
<p><a href="<?php echo base_url('admin/ACL_Controller/addpermiso'); ?>"><? dictionary('theme_txt_add_permission'); ?></a></p>

