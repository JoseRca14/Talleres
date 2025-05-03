<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("No autorizado");
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "login_register_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del taller
$taller_id = $_POST['taller_id'];

// 1. Obtener los correos de los usuarios inscritos en el taller
$sql = "SELECT u.correo 
        FROM usuarios u 
        INNER JOIN usuarios_talleres ut ON u.id = ut.usuario_id 
        WHERE ut.taller_id = $taller_id";
$result = $conexion->query($sql);

$emails = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['correo'];
    }
}

// 2. Eliminar el taller
$sql_delete = "DELETE FROM talleres WHERE id_taller = $taller_id";
if ($conexion->query($sql_delete)) {
    echo "Taller eliminado correctamente.";

    // 3. Si hay correos, enviar notificación
    if (!empty($emails)) {
        $nodejs_url = "http://localhost:3000/enviar-correos";
        $data = [
            'emails' => $emails,
            'subject' => 'Taller eliminado',
            'htmlContent' => '<strong>Lamentamos informarle que el taller fue eliminado. Le invitamos a conocer <a href="http://localhost/Talleres/php/ver_talleres.php">nuestros otros talleres</a>.</strong>'
        ];

        $ch = curl_init($nodejs_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false || $http_code !== 200) {
            echo " Error al enviar los correos: " . curl_error($ch);
        } else {
            echo " Correos enviados correctamente.";
        }

        curl_close($ch);
    } // <- cierra if (!empty($emails))

} else {
    echo "Error al eliminar el taller: " . $conexion->error;
}