<?php  

include 'conexion_be.php';
session_start();

if(!isset($_SESSION['usuario'])){
    echo '
        <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../index.php";
        </script>
    ';
    session_destroy();
    die();
}

$correo = $_SESSION['usuario'];

// Obtener el ID del usuario basado en su correo
$query_usuario = mysqli_query($conexion, "SELECT id FROM usuarios WHERE correo = '$correo'");
$datos_usuario = mysqli_fetch_assoc($query_usuario);

if (!$datos_usuario) {
    echo '<tr><td colspan="7">Error: Usuario no encontrado.</td></tr>';
    exit;
}

$id_usuario = $datos_usuario['id'];

// Consultar los talleres en los que el usuario está inscrito
$query_talleres = mysqli_query($conexion, "
    SELECT t.* 
    FROM talleres t
    INNER JOIN usuarios_talleres ut ON t.id_taller = ut.taller_id
    WHERE ut.usuario_id = '$id_usuario'
");

if (mysqli_num_rows($query_talleres) > 0) {
    while ($taller = mysqli_fetch_assoc($query_talleres)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($taller['id_taller']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['nombre_taller']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['fecha_inicio']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['fecha_fin']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['dia']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['hora']) . "</td>";
        echo "<td>" . htmlspecialchars($taller['ubicacion']) . "</td>";
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="7">No estás inscrito en ningún taller.</td></tr>';
}

mysqli_close($conexion);
?>
