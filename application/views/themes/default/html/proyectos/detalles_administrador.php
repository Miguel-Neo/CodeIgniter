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
echo '<br>Contactos:<br>';
echo '<pre>';
print_r($contactos);
echo '</pre>';
echo anchor('Proyectos/nuevo_contacto/'.$idProyecto.'/'.$cliente['id'],'nuevo contacto');
?>


<?php
echo '<br>Desarrolladores:<br>';
echo '<pre>';
print_r($users);
echo '</pre>';
echo anchor('Proyectos/nuevo_desarrollador/'.$idProyecto,'nuevo desarrollador');
?>
<form method="post">
    <textarea id="mytextarea">Hello, World!</textarea>
  </form>