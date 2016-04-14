
 <h2>Aministracion de permisos de rol</h2>
 <h3><?php echo "Usuario: ".$user->name." Role:".$user->role; ?></h3>

 
<form action="" method="post">
	<input type="hidden" name="save_permissionsUser" value="1">
	<?php if (isset($permisos)):?>
		<table>
			<tr>
				<th>id</th>
				<th>Permiso</th>
				<th>heredado</th>
				<th>Habilitado</th>
				<th>Denegado</th>
				<th>ignorar</th>
			</tr>
			<?php foreach ($permisos as $permiso):?>
			<tr>
				<td><?php echo $permiso['id'];?></td>
				<td><?php echo $permiso['title']; ?></td>
				<td><?php if ($permiso['inherited'] == 1) echo "si"; else echo ""; ?></td>
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

