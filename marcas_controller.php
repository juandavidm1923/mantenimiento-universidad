<?php
include 'conexion.php';
$conexion = conexion();

// Insertar nueva marca
if (isset($_POST['crear_marca'])) {
    $nombre = $_POST['nombre'];

    $ssql = "INSERT INTO marcas (nombre) VALUES ('$nombre')";
    
    if ($conexion->query($ssql)) {
        header("Location: marcas_view.php?mensaje=Marca creada con éxito");
    } else {
        header("Location: marcas_view.php?error=Error: " . $conexion->error);
    }
}

// Actualizar marca
if (isset($_POST['editar_marca'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    $ssql = "UPDATE marcas SET nombre='$nombre' WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: marcas_view.php?mensaje=Marca actualizada con éxito");
    } else {
        header("Location: marcas_view.php?error=Error: " . $conexion->error);
    }
}

// Eliminar marca
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $ssql = "DELETE FROM marcas WHERE id=$id";
    
    if ($conexion->query($ssql)) {
        header("Location: marcas_view.php?mensaje=Marca eliminada con éxito");
    } else {
        header("Location: marcas_view.php?error=Error: " . $conexion->error);
    }
}
?>
