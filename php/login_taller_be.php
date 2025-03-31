<?php
session_start();
require_once 'conexion_be.php';

if (!isset($_SESSION['usuario_id'])) {
    echo '
        <script>
            alert("Por favor, debes iniciar sesión");
            window.location = "../index.php";
        </script>
    ';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taller_id = intval($_POST['id_taller']);
    $usuario_id = $_SESSION['usuario_id'];

    // Iniciar transacción
    mysqli_begin_transaction($conexion);

    try {
        // 1. Verificar si ya está registrado
        $sql_check = "SELECT id FROM usuarios_talleres 
                     WHERE usuario_id = ? AND taller_id = ?";
        $stmt_check = mysqli_prepare($conexion, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "ii", $usuario_id, $taller_id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        
        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            throw new Exception("Ya estás registrado en este taller");
        }

        // 2. Verificar cupos disponibles (con bloqueo para evitar condiciones de carrera)
        $sql_cupos = "SELECT cupos_disponibles FROM talleres 
                     WHERE id_taller = ? FOR UPDATE";
        $stmt_cupos = mysqli_prepare($conexion, $sql_cupos);
        mysqli_stmt_bind_param($stmt_cupos, "i", $taller_id);
        mysqli_stmt_execute($stmt_cupos);
        $result = mysqli_stmt_get_result($stmt_cupos);
        $taller = mysqli_fetch_assoc($result);

        if (!$taller || $taller['cupos_disponibles'] <= 0) {
            throw new Exception("No hay cupos disponibles en este taller");
        }

        // 3. Registrar al usuario en el taller
        $sql_insert = "INSERT INTO usuarios_talleres (usuario_id, taller_id) VALUES (?, ?)";
        $stmt_insert = mysqli_prepare($conexion, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "ii", $usuario_id, $taller_id);
        mysqli_stmt_execute($stmt_insert);

        // 4. Actualizar cupos del taller
        $sql_update = "UPDATE talleres SET 
                      cupos_disponibles = cupos_disponibles - 1,
                      cupos_ocupados = cupos_ocupados + 1
                      WHERE id_taller = ?";
        $stmt_update = mysqli_prepare($conexion, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "i", $taller_id);
        mysqli_stmt_execute($stmt_update);

        // Confirmar transacción
        mysqli_commit($conexion);
        echo '
            <script>
                alert("Registro exitoso en el taller");
                window.location = "bienvenida.php";
            </script>
        ';
    } catch (Exception $e) {
        // Revertir en caso de error
        mysqli_rollback($conexion);
        echo '
            <script>
                alert("Error: ' . $e->getMessage() . '");
                window.location = "taller.php";
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("Método no permitido");
            window.location = "taller.php";
        </script>
    ';
}

mysqli_close($conexion);
?>