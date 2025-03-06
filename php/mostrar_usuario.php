<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("No autorizado");
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "login_register_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del usuario actual
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = $usuario_id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    echo '
    <p class="field-label">Nombre:</p>
    <p class="field-value">' . htmlspecialchars($usuario['nombre_completo']) . '</p>
    <p class="field-label">Correo:</p>
    <p class="field-value">' . htmlspecialchars($usuario['correo']) . '</p>
    <p class="field-label">Código de estudiante:</p>
    <p class="field-value">' . htmlspecialchars($usuario['codigo_estudiante']) . '</p>
    <p class="field-label">Número de teléfono:</p>
    <p class="field-value">' . htmlspecialchars($usuario['num_tel']) . '</p>
    <p class="field-label">Carrera:</p>
    <p class="field-value">' . htmlspecialchars($usuario['carrera']) . '</p>';
} else {
    echo '<p class="text-center">No se encontraron datos del usuario.</p>';
}

$conexion->close();
?>