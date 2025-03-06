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

// Consulta para obtener los talleres inscritos por el usuario
$sql = "SELECT t.* FROM talleres t
        INNER JOIN usuarios_talleres ut ON t.id_taller = ut.taller_id
        WHERE ut.usuario_id = $usuario_id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($taller = $resultado->fetch_assoc()) {
        echo '
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-calendar-alt icon"></i>Taller inscrito
                </div>
                <div class="card-body">
                    <p class="field-label">ID:</p>
                    <p class="field-value">' . htmlspecialchars($taller['id_taller']) . '</p>
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
            </div>
        </div>';
    }
} else {
    echo '<p class="text-center">No estás inscrito en ningún taller.</p>';
}

$conexion->close();
?>
