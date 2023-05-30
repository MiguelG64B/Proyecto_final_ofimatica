<?php 
include "./conexion.php";

if (isset($_POST['id_usuario']) && isset($_POST['id_ruta'])) {
    $id_usuario = $_POST['id_usuario'];
    $id_ruta = $_POST['id_ruta'];

    // Verificar si la id_usuario ya existe en id_ruta
    $query = "SELECT * FROM controlruta WHERE id_usuario = '$id_usuario' AND id_ruta = '$id_ruta'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        header("Location: ../detalleruta.php?id2=".$id_ruta."&error=Ruta ya inscrita");
    } else {
        // Insertar los valores en la base de datos
        $query = "INSERT INTO controlruta (id_usuario, id_ruta) VALUES ('$id_usuario', '$id_ruta')";
        $conexion->query($query) or die($conexion->error);

        header("Location: ../panel.php?success");
    }
} else {
    header("Location: ../detalleruta.php?id2=".$id_ruta."&error=Ruta ya inscrita");
}

?>
