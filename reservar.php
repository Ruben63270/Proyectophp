<?php
require "config/conexion.php";

if (isset($_GET["id_libro"])) {
    $id_libro = $_GET["id_libro"];
    $id_cliente = 1; // ID de Pedro Díaz
    $fecha_actual = date("Y-m-d");


    $check_cliente = $conexion->prepare("SELECT * FROM reservas WHERE Id = ?");
    $check_cliente->bind_param("i", $id_cliente);
    $check_cliente->execute();
    $resultado = $check_cliente->get_result();
    
    if ($resultado->num_rows > 0) {
       
        $consulta = "UPDATE reservas SET Id_libro = ?, Fecha_reserva = ?, Id_pelicula = NULL WHERE Id = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bind_param("isi", $id_libro, $fecha_actual, $id_cliente);
        $mensaje = "Reserva actualizada con éxito.";
    } else {
      
        $consulta = "INSERT INTO reservas (Id, Id_libro, Id_pelicula, Fecha_reserva) VALUES (?, ?, NULL, ?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bind_param("iis", $id_cliente, $id_libro, $fecha_actual);
        $mensaje = "Reserva creada con éxito.";
    }

    if ($sentencia->execute()) {
        echo $mensaje;
    } else {
        echo "Error en la operación: " . $conexion->error;
    }
}
?>
<br><a href="usuarios.php">Volver al buscador</a>