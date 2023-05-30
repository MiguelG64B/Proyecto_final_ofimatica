<?php
include "./conexion.php";

if (isset($_POST['titulo']) && isset($_POST['editor']) && isset($_POST['categoria'])) {

    $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato YYYY-MM-DD

    $contenido = $_POST['editor']; // Contenido del editor

    // Se asegura de escapar las comillas simples en el contenido para evitar problemas de inserción
    $contenido = $conexion->real_escape_string($contenido);

    $tipo = "blog"; // Tipo de contenido

    $conexion->query("INSERT INTO contenido (id_categoria, titulo, contenido, fecha, tipo) VALUES
        (
            '" . $_POST['categoria'] . "',
            '" . $_POST['titulo'] . "',
            '$contenido',
            '$fecha',
            '$tipo'
        )") or die($conexion->error);
    header("Location: ../panelblogs.php?success");
} else {
    header("Location: ../panelblogs.php?error=Favor de llenar todos los campos");
}
?>
