<?php 
session_start();
include "./conexion.php";

if(  isset($_POST['email'])  && isset($_POST['password'])  ){
    
    $resultado = $conexion->query("select * from usuario where 
        email='".$_POST['email']."' and 
        password='".sha1($_POST['password'])."' limit 1")or die($conexion->error);
        
    if(mysqli_num_rows($resultado)>0 ){
        $datos_usuario = mysqli_fetch_row($resultado); 
        $id_usuario= $datos_usuario[0];
        $nombre= $datos_usuario[1];
        $email= $datos_usuario[2];
        $nivel= $datos_usuario[4];
     
        $_SESSION['datos_login']= array(
            'nombre'=>$nombre,
            'id_usuario'=>$id_usuario,
            'email'=>$email,
            'nivel'=>$nivel 
        );
        header("Location: ../panel.php");
    }

    else{
        header("Location: ../index.php?error=Credenciales incorrectas");
    }



}else{
    header("../index.php");
}



?>

