<?php 
include "./conexion.php";

if(isset($_POST['contenido']) && isset($_POST['idruta']) && isset($_POST['posicion'])) {
    
    $idruta = $_POST['idruta']; // Obtener el valor de idruta
    
    $conexion->query("INSERT INTO contenidoruta
        (id_ruta,id_contenido,posicion) VALUES
        (   '".$idruta."',
            '".$_POST['contenido']."',
            '".$_POST['posicion']."'
        )") or die($conexion->error);
    
    header("Location: ../panelcontenidoruta.php?id2=".$idruta."&success"); 
} else {
    $idruta = $_POST['idruta']; // Obtener el valor de idruta
    
    header("Location: ../panelcontenidoruta.php?id2=".$idruta."&error=Favor de llenar todos los campos"); 
}
?>

