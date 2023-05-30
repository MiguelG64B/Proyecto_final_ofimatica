<?php
include "./conexion.php";

if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['editor']) && isset($_POST['categoria'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['editor'];
    $categoria = $_POST['categoria'];

    // Se asegura de escapar las comillas simples en el contenido para evitar problemas de inserción
    $contenido = $conexion->real_escape_string($contenido);

    $conexion->query("UPDATE contenido SET
        id_categoria='$categoria',
        titulo='$titulo',
        contenido='$contenido'
        WHERE id_contenido='$id'") or die($conexion->error);

    header("Location: ../panelejercicios.php?success");
} else {
    header("Location: ../panelejercicios.php?error=Favor de llenar todos los campos");
}
?>
