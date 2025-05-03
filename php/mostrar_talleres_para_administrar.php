<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado");
}

// Ruta CORRECTA - mismo directorio
require_once __DIR__ . '/conexion_be.php';

$usuario_id = $_SESSION['usuario_id'];

// Consulta para talleres creados por el usuario
$sql = "SELECT 
            id_taller, 
            nombre_taller, 
            cupos_disponibles,
            cupos_ocupados
        FROM talleres 
        WHERE creador_id = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($taller = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-6 mb-4">';
        echo '<div class="card">';
        echo '<div class="card-header bg-primary text-white">';
        echo '<h5>' . htmlspecialchars($taller['nombre_taller']) . '</h5>';
        echo '<span class="badge bg-light text-dark">Cupos disponibles: ' . $taller['cupos_disponibles'] . ' Cupos utilizados: ' . $taller['cupos_ocupados'] . '</span>';
        echo '</div>';
        echo '<div class="card-body">';
        
        // Consulta para participantes inscritos
        $sql_usuarios = "SELECT 
                            u.id, 
                            u.nombre_completo, 
                            u.correo 
                         FROM usuarios u 
                         INNER JOIN usuarios_talleres ut ON u.id = ut.usuario_id 
                         WHERE ut.taller_id = ?";
        
        $stmt_usuarios = mysqli_prepare($conexion, $sql_usuarios);
        mysqli_stmt_bind_param($stmt_usuarios, "i", $taller['id_taller']);
        mysqli_stmt_execute($stmt_usuarios);
        $result_usuarios = mysqli_stmt_get_result($stmt_usuarios);
        
        if (mysqli_num_rows($result_usuarios) > 0) {
            echo '<ul class="list-group">';
            while ($usuario = mysqli_fetch_assoc($result_usuarios)) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                echo htmlspecialchars($usuario['nombre_completo']) . ' (' . htmlspecialchars($usuario['correo']) . ')';
                echo '<button class="btn btn-danger btn-sm" onclick="eliminarParticipante(' . $taller['id_taller'] . ', ' . $usuario['id'] . ')">';
                echo '<i class="fas fa-user-minus"></i> Eliminar';
                echo '</button>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p class="text-muted">No hay participantes inscritos en este taller.</p>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-12">';
    echo '<div class="alert alert-info">No has creado ningún taller todavía.</div>';
    echo '</div>';
}

mysqli_close($conexion);
?>