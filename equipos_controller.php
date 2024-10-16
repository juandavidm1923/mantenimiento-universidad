<?php
include 'conexion.php';
$conexion = conexion();

// Insertar nuevo equipo
if (isset($_POST['crear_equipo'])) {
    $nombre = $_POST['nombre'];
    $marca_id = $_POST['marca_id'];
    $sala_id = $_POST['sala_id'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
    $estado = $_POST['estado'];

    $ssql = "INSERT INTO equipos (nombre, marca_id, sala_id, fecha_mantenimiento, estado) VALUES ('$nombre', '$marca_id', '$sala_id', '$fecha_mantenimiento', '$estado')";
    
    if ($conexion->query($ssql)) {
        header("Location: equipos_view.php?mensaje=Equipo creado con éxito");
    } else {
        header("Location: equipos_view.php?error=Error: " . $conexion->error);
    }
}

// Actualizar equipo
if (isset($_POST['editar_equipo'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca_id = $_POST['marca_id'];
    $sala_id = $_POST['sala_id'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
    $estado = $_POST['estado'];

    $ssql = "UPDATE equipos SET nombre='$nombre', marca_id='$marca_id', sala_id='$sala_id', fecha_mantenimiento='$fecha_mantenimiento', estado='$estado' WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: equipos_view.php?mensaje=Equipo actualizado con éxito");
    } else {
        header("Location: equipos_view.php?error=Error: " . $conexion->error);
    }
}

// Eliminar equipo
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $ssql = "DELETE FROM equipos WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: equipos_view.php?mensaje=Equipo eliminado con éxito");
    } else {
        header("Location: equipos_view.php?error=Error: " . $conexion->error);
    }
}
?>
