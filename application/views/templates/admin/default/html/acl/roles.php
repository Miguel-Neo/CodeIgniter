<h2>Administrador de roles</h2>
<div class="container">hola</div>

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