<?php
include 'conexion.php';
$conexion = conexion();

// Insertar nuevo monitor
if (isset($_POST['crear_monitor'])) {
    $nombre = $_POST['nombre'];
    $sala_id = $_POST['sala_id'];
    $contacto = $_POST['contacto'];

    $ssql = "INSERT INTO monitores (nombre, sala_id, contacto) VALUES ('$nombre', '$sala_id', '$contacto')";
    
    if ($conexion->query($ssql)) {
        header("Location: monitores_view.php?mensaje=Monitor creado con éxito");
    } else {
        header("Location: monitores_view.php?error=Error: " . $conexion->error);
    }
}

// Actualizar monitor
if (isset($_POST['editar_monitor'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sala_id = $_POST['sala_id'];
    $contacto = $_POST['contacto'];

    $ssql = "UPDATE monitores SET nombre='$nombre', sala_id='$sala_id', contacto='$contacto' WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: monitores_view.php?mensaje=Monitor actualizado con éxito");
    } else {
        header("Location: monitores_view.php?error=Error: " . $conexion->error);
    }
}

// Eliminar monitor
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $ssql = "DELETE FROM monitores WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: monitores_view.php?mensaje=Monitor eliminado con éxito");
    } else {
        header("Location: monitores_view.php?error=Error: " . $conexion->error);
    }
}
?>
