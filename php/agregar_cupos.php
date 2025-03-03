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

// Aumentar los cupos disponibles
$sql = "UPDATE talleres SET cupos_disponibles = cupos_disponibles + $cupos WHERE id_taller = $taller_id";
if ($conexion->query($sql)) {
    echo "Se agregaron $cupos cupos correctamente.";
} else {
    echo "Error al agregar cupos: " . $conexion->error;
}

$conexion->close();
?>