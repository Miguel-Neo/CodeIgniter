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
           		<a href="<?php echo base_url('admin/ACL_Controller/permisosusuario').'/'.$role->id; ?>">Permisos</a>
          
            </td>
        </tr>
            
        <?php endforeach; ?>
    </table>
<?php endif; ?>




<?php if(isset($roles)): ?>
	<table>
		<tr>
			<th>ID</th>
			<th>Role</th>
			<th></th>
			<th></th>
		</tr>
<?php foreach ($roles->result() as $role):?>

		<tr>
			<td><?php echo $role->id; ?></td>
			<td><?php echo $role->role; ?></td>
			<td>
				<a href="<?php echo base_url('admin/ACL_Controller/permissionsRole').'/'.$role->id; ?>">Permisos</a>
			</td>
			<td>Editar</td>
		</tr>

<?php endforeach; ?>
	</table>
<?php endif; ?>

<p><a href="<?php echo base_url('admin/ACL_Controller/nuevo_role');?>">Agregar Role</a></p>