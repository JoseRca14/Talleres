<<<<<<< HEAD
<?php 

include 'conexion_be.php';
session_start();

if(!isset($_SESSION['usuario'])){
    echo '
        <script>
            alert("Por favor debes iniciar sesion 2");
            window.location = "../index.php";
        </script>
    ';
    session_destroy();
    die();

}

$correo = $_SESSION['usuario'];
// Obtener los datos del usuario basado en su correo
$query_usuario = mysqli_query($conexion, "SELECT id, nombre_completo, correo, codigo_estudiante, num_tel, carrera FROM usuarios WHERE correo = '$correo'");
$datos_usuario = mysqli_fetch_assoc($query_usuario);

if (!$datos_usuario) {
    echo '<tr><td colspan="7">Error: Usuario no encontrado.</td></tr>';
    exit;
}

// Mostrar datos del usuario en formato de tabla para AJAX
echo "<tr>";
echo "<td>" . htmlspecialchars($datos_usuario['id']) . "</td>";
echo "<td>" . htmlspecialchars($datos_usuario['nombre_completo']) . "</td>";
echo "<td>" . htmlspecialchars($datos_usuario['correo']) . "</td>";
echo "<td>" . htmlspecialchars($datos_usuario['codigo_estudiante']) . "</td>";
echo "<td>" . htmlspecialchars($datos_usuario['num_tel']) . "</td>";
echo "<td>" . htmlspecialchars($datos_usuario['carrera']) . "</td>";
echo "</tr>";


mysqli_close($conexion);
=======
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
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
?>