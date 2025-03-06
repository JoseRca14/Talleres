<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../index.php";
        </script>
    ';
    session_destroy();
    die();
}

include 'conexion_be.php';

// Obtener los datos del formulario
$nombre_taller = $_POST['nombre_taller'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$dia = $_POST['dia'];
$hora = $_POST['hora'];
$ubicacion = $_POST['ubicacion'];
$cupos_disponibles = $_POST['cupos_disponibles']; // Nuevo campo
$cupos_ocupados = 0; // Inicialmente no hay cupos ocupados

// Validar que todos los campos necesarios estén llenos
if (empty(trim($nombre_taller)) || empty(trim($descripcion)) || empty(trim($fecha_inicio)) || empty(trim($fecha_fin)) || 
    empty(trim($dia)) || empty(trim($hora)) || empty(trim($ubicacion)) || empty(trim($cupos_disponibles))) {
    echo '
        <script>
            alert("Por favor, llena todos los campos obligatorios.");
            window.location = "taller.php";
        </script>
    ';
    exit;
}

// Obtener el correo del usuario desde la sesión
$correo_usuario = $_SESSION['usuario'];

// Obtener el ID del usuario que está iniciando sesión
$query_usuario = "SELECT id FROM usuarios WHERE correo = '$correo_usuario'";
$resultado_usuario = mysqli_query($conexion, $query_usuario);

if (!$resultado_usuario) {
    echo '
        <script>
            alert("Error al obtener el ID del usuario: ' . mysqli_error($conexion) . '");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

$usuario = mysqli_fetch_assoc($resultado_usuario);

if (!$usuario) {
    echo '
        <script>
            alert("Error: No se encontró el usuario en la base de datos.");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

$creador_id = $usuario['id'];

// Insertar el taller con las nuevas columnas
$query = "INSERT INTO talleres(nombre_taller, descripcion, fecha_inicio, fecha_fin, dia, hora, ubicacion, creador_id, cupos_disponibles, cupos_ocupados)
          VALUES('$nombre_taller', '$descripcion', '$fecha_inicio', '$fecha_fin', '$dia', '$hora', '$ubicacion', '$creador_id', '$cupos_disponibles', '$cupos_ocupados')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
        <script>
            alert("Taller registrado exitosamente");
            window.location = "bienvenida.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Error: ' . mysqli_error($conexion) . '");
            window.location = "taller.php";
        </script>
    ';
}

mysqli_close($conexion);
?>
