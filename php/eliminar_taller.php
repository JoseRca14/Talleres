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
        $nodejs_url = "http://localhost:3000/enviar-correos"; // URL del servidor Node.js
        $data = [
            'emails' => $emails,
            'subject' => 'Taller eliminado',
            'htmlContent' => '<strong>Lamentamos informarle que el taller fue eliminado. Le invitamos a conocer nuestros otros talleres.</strong>'
        ];

        // Usar cURL para enviar los datos a Node.js
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($nodejs_url, false, $context);

        if ($result === FALSE) {
            echo " Error al enviar los correos.";
        } else {
            echo " Correos enviados correctamente.";
        }
    }
} else {
    echo "Error al eliminar el taller: " . $conexion->error;
}

$conexion->close();
?>
