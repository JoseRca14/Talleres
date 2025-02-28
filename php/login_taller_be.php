<?php 

    session_start();

    include 'conexion_be.php';

    // Verificar que el usuario esté autenticado
    if (!isset($_SESSION['usuario'])) {
        echo '
            <script>
                alert("Por favor, inicia sesión antes de registrarte en un taller.");
                window.location = "login.php";
            </script>
        ';
        exit;
    }

    // Obtener el ID del taller desde el formulario
$id_taller = mysqli_real_escape_string($conexion, $_POST['id_taller']);

// Obtener el ID del usuario a partir de su correo en la sesión
$correo = $_SESSION['usuario'];
$query_usuario = mysqli_query($conexion, "SELECT id FROM usuarios WHERE correo = '$correo'");
$datos_usuario = mysqli_fetch_assoc($query_usuario);

if (!$datos_usuario) {
    echo '
        <script>
            alert("Error: Usuario no encontrado.");
            window.location = "taller.php";
        </script>
    ';
    exit;
}

$id_usuario = $datos_usuario['id'];

// Validar si el usuario ya está registrado en el taller
$validar_registro = mysqli_query($conexion, "SELECT * FROM usuarios_talleres WHERE usuario_id = '$id_usuario' AND taller_id = '$id_taller'");

if (mysqli_num_rows($validar_registro) > 0) {
    echo '
        <script>
            alert("Ya estás registrado en este taller.");
            window.location = "taller.php";
        </script>
    ';
    exit;
}

// Registrar al usuario en el taller
$query = "INSERT INTO usuarios_talleres (usuario_id, taller_id) VALUES ('$id_usuario', '$id_taller')";
$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
        <script>
            alert("Registrado en el Taller exitosamente");
            window.location = "bienvenida.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Inténtalo de nuevo, NO te has podido registrar.");
            window.location = "taller.php";
        </script>
    ';
}

mysqli_close($conexion);
?>