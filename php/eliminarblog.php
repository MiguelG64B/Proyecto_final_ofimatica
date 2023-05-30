<?php
include "./conexion.php";

$conexion->query("delete from contenidos where id=".$_POST['id']);
echo 'listo';

?>
