
<?php 
   include "conexion.php";
   if( isset($_POST['nombre'] ) && isset($_POST['email']) && isset($_POST['pass'] ) 
    && isset($_POST['pass2'] )){
       
        $em= $conexion->query("SELECT email FROM usuario WHERE email = '".$_POST['email']."'")or die($conexion->error);
        if(mysqli_num_rows($em)>0){
            header("Location: ../registro.php?error=correo ya registrado");
        }

        else{
        if($_POST['pass'] == $_POST['pass2'] ){
            $name=$_POST['nombre'];
            $email=$_POST['email'];
            $pass=sha1($_POST['pass']);
                $conexion->query("insert into usuario (nombre,email,password,nivel) 
                    values('$name','$email','$pass','cliente')  ")or die($conexion->error);
                    header("Location: ../login.php");
        }else{
           
        header("Location: ../registro.php?error=password  incorrectas");
        }
    }
}
?>
