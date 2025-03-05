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

// Obtener el ID del taller
$taller_id = $_POST['taller_id'];

// Eliminar el taller
$sql = "DELETE FROM talleres WHERE id_taller = $taller_id";
if ($conexion->query($sql)) {
    echo "Taller eliminado correctamente.";
} else {
    echo "Error al eliminar el taller: " . $conexion->error;
}

$conexion->close();
?>