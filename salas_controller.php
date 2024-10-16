<?php
include 'conexion.php';
$conexion = conexion();

// Insertar nueva sala
if (isset($_POST['crear_sala'])) {
    $nombre = $_POST['nombre'];
    $sede_id = $_POST['sede_id'];
    $ssql = "INSERT INTO salas (nombre, sede_id) VALUES ('$nombre', '$sede_id')";
    if ($conexion->query($ssql)) {
        header("Location: salas_view.php?mensaje=Sala creada con éxito");
    } else {
        header("Location: salas_view.php?error=Error: " . $conexion->error);
    }
}

// Actualizar sala
if (isset($_POST['editar_sala'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sede_id = $_POST['sede_id'];
    $ssql = "UPDATE salas SET nombre='$nombre', sede_id='$sede_id' WHERE id=$id";
    if ($conexion->query($ssql)) {
        header("Location: salas_view.php?mensaje=Sala actualizada con éxito");
    } else {
        header("Location: salas_view.php?error=Error: " . $conexion->error);
    }
}

// Eliminar sala
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $ssql = "DELETE FROM salas WHERE id=$id";
    if ($conexion->query($ssql)) {
        header("Location: salas_view.php?mensaje=Sala eliminada con éxito");
    } else {
        header("Location: salas_view.php?error=Error: " . $conexion->error);
    }
}
?>
