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
$nombre_taller = mysqli_real_escape_string($conexion, $_POST['nombre_taller']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$dia = mysqli_real_escape_string($conexion, $_POST['dia']);
$hora = $_POST['hora'];
$ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
$cupos_disponibles = intval($_POST['cupos_disponibles']);
$cupos_ocupados = 0; // Inicialmente no hay cupos ocupados

// Validar campos obligatorios
$campos_requeridos = [
    'nombre_taller' => $nombre_taller,
    'descripcion' => $descripcion,
    'fecha_inicio' => $fecha_inicio,
    'fecha_fin' => $fecha_fin,
    'dia' => $dia,
    'hora' => $hora,
    'ubicacion' => $ubicacion,
    'cupos_disponibles' => $cupos_disponibles
];

foreach ($campos_requeridos as $campo => $valor) {
    if (empty(trim($valor))) {
        echo '
            <script>
                alert("Por favor, completa el campo: ' . ucfirst(str_replace('_', ' ', $campo)) . '");
                window.location = "taller.php";
            </script>
        ';
        exit;
    }
}

// Validar fechas
if ($fecha_inicio > $fecha_fin) {
    echo '
        <script>
            alert("La fecha de inicio no puede ser posterior a la fecha final");
            window.location = "taller.php";
        </script>
    ';
    exit;
}

// Validar cupos
if ($cupos_disponibles <= 0) {
    echo '
        <script>
            alert("Los cupos disponibles deben ser mayores a 0");
            window.location = "taller.php";
        </script>
    ';
    exit;
}

// Obtener el ID del usuario creador
$correo_usuario = $_SESSION['usuario'];
$query_usuario = "SELECT id FROM usuarios WHERE correo = ?";
$stmt_usuario = mysqli_prepare($conexion, $query_usuario);
mysqli_stmt_bind_param($stmt_usuario, "s", $correo_usuario);
mysqli_stmt_execute($stmt_usuario);
$resultado_usuario = mysqli_stmt_get_result($stmt_usuario);

if (!$resultado_usuario || mysqli_num_rows($resultado_usuario) === 0) {
    echo '
        <script>
            alert("Error al obtener el ID del usuario");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

$usuario = mysqli_fetch_assoc($resultado_usuario);
$creador_id = $usuario['id'];

// Insertar el taller con sentencia preparada
$query = "INSERT INTO talleres(nombre_taller, descripcion, fecha_inicio, fecha_fin, dia, hora, ubicacion, creador_id, cupos_disponibles, cupos_ocupados)
          VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "sssssssiii", $nombre_taller, $descripcion, $fecha_inicio, $fecha_fin, $dia, $hora, $ubicacion, $creador_id, $cupos_disponibles, $cupos_ocupados);

if (mysqli_stmt_execute($stmt)) {
    echo '
        <script>
            alert("Taller registrado exitosamente");
            window.location = "bienvenida.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Error al registrar el taller: ' . mysqli_error($conexion) . '");
            window.location = "taller.php";
        </script>
    ';
}

mysqli_close($conexion);
?>