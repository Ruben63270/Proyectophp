<?php
require "config/conexion.php";

    $nombre = $_POST["Nombre"];
    $apellidos = $_POST["Apellidos"];
    $fecha_nacimiento = $_POST["Fecha_nacimiento"];
    $localidad = $_POST["Localidad"];


    $consulta = "SELECT * FROM clientes WHERE Nombre = ?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param("s", $nombre);
    $sentencia->execute();
    
    $sentencia->store_result();

    if($sentencia->num_rows > 0){
        echo "El usuario existe";
    }else{
        $consulta = "INSERT INTO clientes (Nombre, Apellidos, Fecha_Nacimiento, Localidad) VALUES (?, ?, ?, ?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bind_param("ssds", $nombre, $apellidos, $fecha_nacimiento, $localidad);
        $sentencia->execute();

        header("Location: login.php");
    }

?>