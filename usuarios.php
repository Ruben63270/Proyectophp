<?php
require "config/conexion.php";
require "clases/usuario.php";

$resultado = $conexion->query("SELECT * FROM usuarios");

$usuarios =[];
while(true){
    $usuario = $resultado->fetch_object(Usuario::class);

    if($usuario == null){
        break;
    }

    $usuarios [] = $usuario;

}



?>

<html>
<ul>
<?php foreach($usuarios as $usuario):?>
    <li>
        <?php echo $usuario->Usuario?>
    </li>
<?php endforeach;?>
</ul>

<form action="filtrar_libro.php" method="POST">
            <input type="text" name="Nombre_libro" required>
            <input type="submit" value="Buscar" required>
        </form>
        <hr>
<form action="lista_reservas.php">
    <input type="submit" value="Ver tabla de reservas y disponibilidad">
</form>
</html>

