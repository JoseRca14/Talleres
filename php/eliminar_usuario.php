<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    echo "Error: No tienes permiso para realizar esta acción.";
    exit();
}

// Verificar si el ID del usuario está en la sesión
if (!isset($_SESSION['usuario_id'])) {
    echo "Error: No se pudo identificar al usuario.";
    exit();
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "login_register_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['usuario_id'];

// Eliminar registros relacionados en `usuarios_talleres`
$sql1 = "DELETE FROM usuarios_talleres WHERE usuario_id = ?";
$stmt1 = $conexion->prepare($sql1);
$stmt1->bind_param("i", $id_usuario);
$stmt1->execute();
$stmt1->close();

// Eliminar talleres creados por el usuario
$sql2 = "DELETE FROM talleres WHERE creador_id = ?";
$stmt2 = $conexion->prepare($sql2);
$stmt2->bind_param("i", $id_usuario);
$stmt2->execute();
$stmt2->close();

// Eliminar al usuario de la tabla `usuarios`
$sql3 = "DELETE FROM usuarios WHERE id = ?";
$stmt3 = $conexion->prepare($sql3);
$stmt3->bind_param("i", $id_usuario);

if ($stmt3->execute()) {
    // Cerrar la sesión y redirigir al usuario
    session_destroy();
    echo "Cuenta eliminada correctamente.";
} else {
    echo "Error al eliminar la cuenta: " . $stmt3->error;
}

$stmt3->close();
$conexion->close();
?>