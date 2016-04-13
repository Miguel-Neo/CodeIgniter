<h2><?php echo $titulo; ?></h2>

<?php if(isset($usuarios) && count($usuarios)): ?>
    <table>
        <tr><td>ID</td>
            <td>Usuario</td>
            <td>Role</td>
            <td></td>
        </tr>
        <?php foreach ($usuarios as $us):?>

        <tr>
        	<td><?php echo $us->id; ?></td>
            <td><?php echo $us->name; ?></td>
            <td><?php echo $us->role; ?></td>
            
            <td>
           	<a href="<?php echo base_url('admin/ACL_Controller/permisosusuario').'/'.$us->id; ?>">Permisos</a>
          
            </td>
        </tr>
            
        <?php endforeach; ?>
    </table>
<?php endif; ?>


