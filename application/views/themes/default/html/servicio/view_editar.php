<?php
/**
 * Esta es la vista para EDITAR los datos de un servicio del crm
 * Envia mediante POST los datos de {nobre} , {descripcion} y {id}
 */
?>
<form action="" method="post">
    <input type="hidden" name="editar_servicio" value="1" />
    <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">

    <?php echo $servicio['id']; ?>

    <input type="input" name="nombre" value="<?php echo $servicio['nombre']; ?>"/>

    <input type="input" name="descripcion" value="<?php echo $servicio['descripcion']; ?>"/>

    <input type="submit" value="<?= dictionary('theme_save'); ?>" />

</form>