<?php
include 'conexion.php';
$conexion = conexion();

// Insertar nueva sede
if (isset($_POST['crear_sede'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ssql = "INSERT INTO sedes (nombre, direccion) VALUES ('$nombre', '$direccion')";
    if ($conexion->query($ssql)) {
        header("Location: sedes_view.php?mensaje=Sede creada con éxito");
    } else {
        header("Location: sedes_view.php?error=Error: " . $conexion->error);
    }
}

// Actualizar sede
if (isset($_POST['editar_sede'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ssql = "UPDATE sedes SET nombre='$nombre', direccion='$direccion' WHERE id=$id";
    if ($conexion->query($ssql)) {
        header("Location: sedes_view.php?mensaje=Sede actualizada con éxito");
    } else {
        header("Location: sedes_view.php?error=Error: " . $conexion->error);
    }
}

// Eliminar sede
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $ssql = "DELETE FROM sedes WHERE id=$id";
    if ($conexion->query($ssql)) {
        header("Location: sedes_view.php?mensaje=Sede eliminada con éxito");
    } else {
        header("Location: sedes_view.php?error=Error: " . $conexion->error);
    }
}
?>
