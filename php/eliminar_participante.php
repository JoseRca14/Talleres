<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado");
}

require_once 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taller_id = $_POST['taller_id'];
    $usuario_id = $_POST['usuario_id'];
    
    // Verificar que el taller pertenece al usuario actual
    $sql_verificar = "SELECT id_taller FROM talleres WHERE id_taller = ? AND creador_id = ?";
    $stmt_verificar = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, "ii", $taller_id, $_SESSION['usuario_id']);
    mysqli_stmt_execute($stmt_verificar);
    $result_verificar = mysqli_stmt_get_result($stmt_verificar);
    
    if (mysqli_num_rows($result_verificar) == 0) {
        die("No tienes permiso para administrar este taller");
    }
    
    // Iniciar transacción
    mysqli_begin_transaction($conexion);
    
    try {
        // 1. Eliminar la relación en usuarios_talleres
        $sql_eliminar = "DELETE FROM usuarios_talleres WHERE taller_id = ? AND usuario_id = ?";
        $stmt_eliminar = mysqli_prepare($conexion, $sql_eliminar);
        mysqli_stmt_bind_param($stmt_eliminar, "ii", $taller_id, $usuario_id);
        mysqli_stmt_execute($stmt_eliminar);
        
        // 2. Actualizar los cupos del taller
        $sql_actualizar = "UPDATE talleres SET 
                            cupos_disponibles = cupos_disponibles + 1,
                            cupos_ocupados = cupos_ocupados -1
                          WHERE id_taller = ?";
        $stmt_actualizar = mysqli_prepare($conexion, $sql_actualizar);
        mysqli_stmt_bind_param($stmt_actualizar, "i", $taller_id);
        mysqli_stmt_execute($stmt_actualizar);
        
        // Confirmar transacción
        mysqli_commit($conexion);
        echo "Participante eliminado correctamente. Se ha liberado un cupo.";
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        mysqli_rollback($conexion);
        echo "Error al eliminar participante: " . $e->getMessage();
    }
    
    mysqli_close($conexion);
}
?>