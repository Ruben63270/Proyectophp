<?php
require "config/conexion.php";

if (isset($_GET["id_libro"])) {
    $id_libro = $_GET["id_libro"];


    $consulta = "DELETE FROM reservas WHERE Id_libro = ?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param("i", $id_libro);

    if ($sentencia->execute()) {
        echo "Libro devuelto correctamente (reserva eliminada).";
    } else {
        echo "Error al procesar la devolución.";
    }
}
?>
<br><a href="usuarios.php">Volver al buscador</a>