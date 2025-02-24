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
?>