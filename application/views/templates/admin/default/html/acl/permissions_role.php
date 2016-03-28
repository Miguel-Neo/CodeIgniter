 <h2>Aministracion de permisos de rol</h2>
 <h3><?php echo $role->role; ?></h3>
<form action="" method="post">
	<input type="hidden" name="save_permissionsRole" value="1">
	<?php if (isset($permisos)):?>
		<table>
			<tr>
				<th>Permiso</th>
				<th>Habilitado</th>
				<th>Denegado</th>
				<th>ignorar</th>
			</tr>
			<?php foreach ($permisos as $permiso):?>
			<tr>
				<td><?php echo $permiso['name']; ?></td>
				<td>
					<input type="radio" name="perm_<?=$permiso['id'] ?>" value="1" <?php if($permiso['value'] == 1) echo ' checked="checked"';?> >
				</td>
				<td>
					<input type="radio" name="perm_<?=$permiso['id'] ?>" value="" <?php if($permiso['value'] == '') echo ' checked="checked"';?> >
				</td>
				<td>
					<input type="radio" name="perm_<?=$permiso['id'] ?>" value="x" <?php if($permiso['value'] === "x") echo ' checked="checked"';?> >
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
	<input type="submit" value="Guardar">
</form>
