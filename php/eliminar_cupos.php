<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("No autorizado");
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "login_register_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del taller y el número de cupos
$taller_id = $_POST['taller_id'];
$cupos = intval($_POST['cupos']); // Convertir a entero

// Validar que el número de cupos sea válido
if ($cupos <= 0) {
    die("Número de cupos no válido.");
}

// Reducir los cupos disponibles
$sql = "UPDATE talleres SET cupos_disponibles = cupos_disponibles - $cupos WHERE id_taller = $taller_id AND cupos_disponibles >= $cupos";
if ($conexion->query($sql)) {
    if ($conexion->affected_rows > 0) {
        echo "Se eliminaron $cupos cupos correctamente.";
    } else {
        echo "No hay suficientes cupos disponibles para eliminar.";
    }
} else {
    echo "Error al eliminar cupos: " . $conexion->error;
}

$conexion->close();
?>