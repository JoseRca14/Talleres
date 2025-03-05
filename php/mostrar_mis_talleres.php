<?php
<<<<<<< HEAD
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
                    <button class='btn-administrar'>Mostrar taller</button>
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
=======
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("No autorizado");
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "login_register_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del usuario actual
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener los talleres creados por el usuario
$sql = "SELECT * FROM talleres WHERE creador_id = $usuario_id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($taller = $resultado->fetch_assoc()) {
        echo '
        <div class="col-md-8"> <!-- Ajustamos el ancho de la tarjeta -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-calendar-alt icon"></i>Taller creado
                </div>
                <div class="card-body">
                    <p class="field-label">Nombre:</p>
                    <p class="field-value">' . htmlspecialchars($taller['nombre_taller']) . '</p>
                    <p class="field-label">Descripción:</p>
                    <p class="field-value">' . htmlspecialchars($taller['descripcion']) . '</p>
                    <p class="field-label">Fecha de inicio:</p>
                    <p class="field-value">' . htmlspecialchars($taller['fecha_inicio']) . '</p>
                    <p class="field-label">Fecha de fin:</p>
                    <p class="field-value">' . htmlspecialchars($taller['fecha_fin']) . '</p>
                    <p class="field-label">Día:</p>
                    <p class="field-value">' . htmlspecialchars($taller['dia']) . '</p>
                    <p class="field-label">Hora:</p>
                    <p class="field-value">' . htmlspecialchars($taller['hora']) . '</p>
                    <p class="field-label">Ubicación:</p>
                    <p class="field-value">' . htmlspecialchars($taller['ubicacion']) . '</p>
                    <p class="field-label">Cupos disponibles:</p>
                    <p class="field-value">' . htmlspecialchars($taller['cupos_disponibles']) . '</p>
                </div>
                <div class="card-footer text-center">
                    <button class="btn-action add-cupos" onclick="agregarCupos(' . $taller['id_taller'] . ')">
                        <i class="fas fa-plus icon"></i>Agregar cupo
                    </button>
                    <button class="btn-action remove-cupos" onclick="eliminarCupos(' . $taller['id_taller'] . ')">
                        <i class="fas fa-minus icon"></i>Eliminar cupo
                    </button>
                    <button class="btn-action delete-taller" onclick="eliminarTaller(' . $taller['id_taller'] . ')">
                        <i class="fas fa-trash icon"></i>Eliminar taller
                    </button>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p class="text-center">No has creado ningún taller.</p>';
}

$conexion->close();
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
?>