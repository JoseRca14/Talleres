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

// Obtener el ID del usuario actual
$usuario_id = $_SESSION['usuario_id'];

// Eliminar el usuario
$sql = "DELETE FROM usuarios WHERE id = $usuario_id";
if ($conexion->query($sql) {
    echo "Cuenta eliminada correctamente.";
} else {
    echo "Error al eliminar la cuenta: " . $conexion->error;
}

$conexion->close();
?>