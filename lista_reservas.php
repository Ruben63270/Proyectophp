<?php
require "config/conexion.php";
require "clases/libro.php";


$sql = "SELECT l.*, r.Fecha_reserva 
        FROM libros l 
        LEFT JOIN reservas r ON l.Id = r.Id_libro";

$resultado = $conexion->query($sql);
?>

<html>
<head>
    <title>Estado de Reservas</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .reservado { color: red; font-weight: bold; }
        .disponible { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Estado Actual de los Libros</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Fecha Reserva</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($libro = $resultado->fetch_object()): ?>
                <tr>
                    <td><?php echo $libro->Id; ?></td>
                    <td><?php echo htmlspecialchars($libro->Titulo); ?></td>
                    <td>
                        <?php if ($libro->Fecha_reserva): ?>
                            <span class="reservado">Reservado</span>
                        <?php else: ?>
                            <span class="disponible">Disponible</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $libro->Fecha_reserva ?? '-'; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="usuarios.php">Volver al panel</a>
</body>
</html>