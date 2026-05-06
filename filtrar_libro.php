<?php

require "config/conexion.php";
require "clases/libro.php";


if (!isset($_POST["Nombre_libro"])) {
    die("Error: No se recibió el nombre del libro.");
}

$nombre_busqueda = $_POST["Nombre_libro"];


$consulta = "SELECT * FROM libros WHERE Titulo LIKE ?";
$sentencia = $conexion->prepare($consulta);
$parametro = "%$nombre_busqueda%";
$sentencia->bind_param("s", $parametro);
$sentencia->execute();

$resultado = $sentencia->get_result();
$libro = $resultado->fetch_object(Libro::class); 


if ($libro != null) {

    echo "<h3>Libro: " . htmlspecialchars($libro->Titulo) . "</h3>";

    $consulta_reserva = "SELECT Id_libro FROM reservas WHERE Id_libro = ?";
    $sentencia_reserva = $conexion->prepare($consulta_reserva);
    $sentencia_reserva->bind_param("i", $libro->Id);
    $sentencia_reserva->execute();
    
    $resultado_reserva = $sentencia_reserva->get_result();

    if ($resultado_reserva->num_rows > 0) {
        echo "<p>Estado: Reservado</p>";
    } else {
        echo "<p>Estado: Disponible</p>";
    }
} else {
    echo "<p>No se encontró ningún libro con ese nombre.</p>";
}
;

if ($libro != null) {
    echo "<h3>" . htmlspecialchars($libro->Titulo) . "</h3>";

    // Comprobamos disponibilidad[cite: 5]
    $consulta_reserva = "SELECT * FROM reservas WHERE Id_libro = ?";
    $sentencia_reserva = $conexion->prepare($consulta_reserva);
    $sentencia_reserva->bind_param("i", $libro->Id);
    $sentencia_reserva->execute();
    $resultado_reserva = $sentencia_reserva->get_result();

    if ($resultado_reserva->num_rows > 0) {
        // Si está reservado, mostramos botón de devolver[cite: 2, 5]
        echo "<p style='color: red;'>Estado: Reservado</p>";
        echo "<a href='devolver.php?id_libro=" . $libro->Id . "'>Devolver Libro</a>";
    } else {
        // Si está libre, mostramos botón de reservar[cite: 5]
        echo "<p style='color: green;'>Estado: Disponible</p>";
        echo "<a href='reservar.php?id_libro=" . $libro->Id . "'>Reservar ahora</a>";
    }
}
?>