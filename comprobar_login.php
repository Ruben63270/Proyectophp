<?php
require "config/conexion.php";
require "clases/usuario.php";

    $usuario = $_POST["Nombre"];
    $contraseña = $_POST["Contraseña"];

    $consulta = "SELECT * FROM usuarios WHERE Usuario = ?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param("s", $usuario);
    $sentencia->execute();

    //get_result - recuperar los datos
    //store_result - cuenta el numero de datos

    $resultado = $sentencia->get_result();

    $usuario = $resultado->fetch_object(Usuario::class);

    //print_r($usuario);

    if($usuario != null && hash("sha256", $contraseña) == $usuario->Contrasena){
        header("Location: usuarios.php");
    }else{
        header("Location: login.php");
    }

?>