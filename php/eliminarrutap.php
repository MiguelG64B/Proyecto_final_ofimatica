<?php
include "./conexion.php";

$conexion->query("DELETE FROM contenidoruta WHERE id=".$_POST['id']);

echo 'listo';
?>
