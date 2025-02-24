<?php
include 'conexion_be.php';
session_start();

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

$correo = $_SESSION['usuario'];

// Obtener el ID del usuario basado en su correo
$query_usuario = mysqli_query($conexion, "SELECT id FROM usuarios WHERE correo = '$correo'");
$datos_usuario = mysqli_fetch_assoc($query_usuario);

if (!$datos_usuario) {
    echo '<tr><td colspan="12">Error: Usuario no encontrado.</td></tr>';
    exit;
}

$id_usuario = $datos_usuario['id'];

// Consultar los talleres creados por el usuario
$query_talleres = mysqli_query($conexion, "SELECT * FROM talleres WHERE creador_id = '$id_usuario'");

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
        echo "<td>" . htmlspecialchars($taller['cupo_maximo']) . "</td>"; // Cupo máximo
        echo "<td>" . htmlspecialchars($taller['cupo_ocupado']) . "</td>"; // Cupo ocupado
        echo "<td>" . ($taller['cupo_maximo'] - $taller['cupo_ocupado']) . "</td>"; // Cupo disponible
        echo "<td>
                <div class='dropdown'>
                    <button class='btn-administrar'>Administrar</button>
                    <div class='dropdown-content'>
                        <a href='eliminar_usuarios.php?id_taller=" . $taller['id_taller'] . "'>Eliminar usuarios inscritos</a>
                        <a href='agregar_cupos.php?id_taller=" . $taller['id_taller'] . "'>Agregar cupos</a>
                        <a href='eliminar_cupos.php?id_taller=" . $taller['id_taller'] . "'>Eliminar cupos</a>
                    </div>
                </div>
              </td>"; // Botón de administrar con menú desplegable
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="12">No has registrado ningún taller.</td></tr>';
}

mysqli_close($conexion);
?>