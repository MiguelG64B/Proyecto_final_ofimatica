<?php 
include "conexion.php";

if(isset($_POST['idruta']) && isset($_POST['contenido']) && isset($_POST['posicion'])) {
    $idruta = $_POST['idruta'];
    $contenido = $_POST['contenido'];
    $posicion = $_POST['posicion'];

    $query = "UPDATE contenidoruta SET id_contenido='$contenido', posicion='$posicion' WHERE id_ruta='$idruta'";
    $conexion->query($query) or die($conexion->error);

    header("Location: ../panelcontenidoruta.php?id2=$idruta&success"); 
} else {
    $idruta = $_POST['idruta'];
    header("Location: ../panelcontenidoruta.php?id2=$idruta&error=Favor de llenar todos los campos"); 
}
?>