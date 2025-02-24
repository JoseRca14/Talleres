<?php
session_start();

include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' and contrasena = '$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
    // Obtener los datos del usuario
    $usuario = mysqli_fetch_assoc($validar_login);

    // Almacenar el correo y el ID del usuario en la sesión
    $_SESSION['usuario'] = $correo;
    $_SESSION['usuario_id'] = $usuario['id']; // Aquí almacenamos el ID del usuario

    // Redirigir al usuario a la página de bienvenida
    header("location: ./bienvenida.php");
    exit;
} else {
    echo '
        <script>
            alert("USUARIO NO EXISTE, por favor verifique los datos introducidos");
            window.location = "../index.php"
        </script>
    ';
    exit;
}
?>