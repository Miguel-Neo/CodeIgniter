<h2>Administrador de roles</h2>

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