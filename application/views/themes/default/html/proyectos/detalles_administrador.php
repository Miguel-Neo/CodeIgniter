<?php
echo '<pre>';
print_r($proyecto);
echo '</pre>';
?>

Desarrolladores:
<br>
<?php

echo '<pre>';
print_r($users);
echo '</pre>';
echo anchor('Proyectos/nuevo_desarrollador/'.$idProyecto,'nuevo desarrollador');
?>