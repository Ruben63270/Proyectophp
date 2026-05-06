<?php
    $servidor = "bbdd"; //En Xampp localhost
    $usuario = "root";
    $contraseña = "bbdd"; //En xamppp ""
    $nombre_bbdd = "Biblioteca";

    $conexion = new mysqli($servidor, $usuario, $contraseña, $nombre_bbdd);

    if($conexion->connect_error){
        echo "Error en la conexion: " . $conexion->connect_error;
    }
?>