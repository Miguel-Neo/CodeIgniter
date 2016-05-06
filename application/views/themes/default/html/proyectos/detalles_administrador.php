<?php
echo '<br>Proyecto:<br>';
echo '<pre>';
print_r($proyecto);
echo '</pre>';
?>


<?php
echo '<br>Cliente:<br>';
echo '<pre>';
print_r($cliente);
echo '</pre>';
?>


<?php
echo '<br>Desarrolladores:<br>';
echo '<pre>';
print_r($users);
echo '</pre>';
echo anchor('Proyectos/nuevo_desarrollador/'.$idProyecto,'nuevo desarrollador');
?>