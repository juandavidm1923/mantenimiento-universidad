<?php
function conexion() {
    $mysqli_conexion = new mysqli("localhost", "root", "", "mantenimiento_universidad");
    if ($mysqli_conexion->connect_errno) {
        echo "Error de conexión: " . $mysqli_conexion->connect_errno;
        exit;
    }
    return $mysqli_conexion;
}
?>
