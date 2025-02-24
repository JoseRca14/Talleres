<?php
session_start();
include 'conexion_be.php';

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

// Verificar si se ha proporcionado el ID del taller
if (!isset($_GET['id_taller'])) {
    echo '
        <script>
            alert("Taller no especificado");
            window.location = "ver_talleres.php";
        </script>
    ';
    die();
}

$id_taller = $_GET['id_taller'];
$correo_usuario = $_SESSION['usuario'];

// Obtener el ID del usuario
$query_usuario = "SELECT id FROM usuarios WHERE correo = '$correo_usuario'";
$resultado_usuario = mysqli_query($conexion, $query_usuario);

if (!$resultado_usuario) {
    echo '
        <script>
            alert("Error al obtener el ID del usuario: ' . mysqli_error($conexion) . '");
            window.location = "ver_talleres.php";
        </script>
    ';
    exit();
}

$usuario = mysqli_fetch_assoc($resultado_usuario);
$usuario_id = $usuario['id'];

// Verificar si el usuario ya está inscrito en el taller
$query_verificar = "SELECT * FROM usuarios_talleres WHERE usuario_id = '$usuario_id' AND taller_id = '$id_taller'";
$resultado_verificar = mysqli_query($conexion, $query_verificar);

if (mysqli_num_rows($resultado_verificar) > 0) {
    echo '
        <script>
            alert("Ya estás inscrito en este taller");
            window.location = "ver_talleres.php";
        </script>
    ';
    exit();
}

// Obtener los cupos disponibles y ocupados del taller
$query_cupos = "SELECT cupos_disponibles, cupos_ocupados FROM talleres WHERE id_taller = '$id_taller'";
$resultado_cupos = mysqli_query($conexion, $query_cupos);

if (!$resultado_cupos) {
    echo '
        <script>
            alert("Error al obtener los cupos del taller: ' . mysqli_error($conexion) . '");
            window.location = "ver_talleres.php";
        </script>
    ';
    exit();
}

$fila_cupos = mysqli_fetch_assoc($resultado_cupos);
$cupos_disponibles = $fila_cupos['cupos_disponibles'];
$cupos_ocupados = $fila_cupos['cupos_ocupados'];

// Verificar si hay cupos disponibles
if ($cupos_disponibles > 0) {
    // Actualizar los cupos
    $cupos_disponibles--;
    $cupos_ocupados++;

    $query_actualizar_cupos = "UPDATE talleres 
                               SET cupos_disponibles = '$cupos_disponibles', cupos_ocupados = '$cupos_ocupados' 
                               WHERE id_taller = '$id_taller'";
    mysqli_query($conexion, $query_actualizar_cupos);

    // Insertar la inscripción
    $query_inscripcion = "INSERT INTO usuarios_talleres(usuario_id, taller_id) VALUES('$usuario_id', '$id_taller')";
    mysqli_query($conexion, $query_inscripcion);

    echo '
        <script>
            alert("Inscripción exitosa");
            window.location = "ver_talleres.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("No hay cupos disponibles");
            window.location = "ver_talleres.php";
        </script>
    ';
}

mysqli_close($conexion);
?>