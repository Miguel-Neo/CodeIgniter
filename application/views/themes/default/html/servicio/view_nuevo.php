<?php
/**
 * Esta es la vista para crear un NUEVO servicio 
 * Solo envia mediante POST los datos de {nobre} y {descripcion}
 */
?>
<form action="" method="post">
    <input type="hidden" name="nuevo_servicio" value="1" />


    nombre: <input type="input" name="nombre"/>

    descripcion: <input type="input" name="descripcion"/>

    <input type="submit" value="<?= dictionary('theme_save'); ?>" />

</form>