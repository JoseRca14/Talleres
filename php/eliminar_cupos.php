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

if (!isset($_GET['id_taller'])) {
    echo '
        <script>
            alert("Taller no especificado");
            window.location = "mis_talleres.php";
        </script>
    ';
    die();
}

$id_taller = $_GET['id_taller'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidad = intval($_POST['cantidad']);

    if ($cantidad > 0) {
        $query_eliminar_cupos = mysqli_query($conexion, "UPDATE talleres SET cupo_maximo = cupo_maximo - $cantidad WHERE id_taller = '$id_taller'");

        if ($query_eliminar_cupos) {
            echo '
                <script>
                    alert("Cupos eliminados correctamente");
                    window.location = "mis_talleres.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Error al eliminar cupos");
                    window.location = "mis_talleres.php";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("La cantidad debe ser mayor que 0");
                window.location = "eliminar_cupos.php?id_taller=' . $id_taller . '";
            </script>
        ';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cupos - Talleres León</title>
    <link rel="shortcut icon" href="../assets/images/favico.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>
    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Talleres León.</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="bienvenida.php" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="mis_talleres.php" class="nav__links">Mi perfil</a>
                </li>
                <li class="nav__items">
                    <a href="ver_talleres.php" class="nav__links">Ver talleres</a>
                </li>
                <li class="nav__items">
                    <a href="cerrar_sesion.php" class="nav__links">Cerrar sesión</a>
                </li>
                <img src="./images/cerrar.svg" alt="" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="./images/menu.svg" alt="" class="nav_img">
            </div>
        </nav>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">Eliminar Cupos del Taller</h2>
            <p class="about__paragraph">Ingresa la cantidad de cupos que deseas eliminar.</p>

            <form method="POST" action="" class="formulario">
                <label for="cantidad" class="formulario__label">Cantidad de cupos a eliminar:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" class="formulario__input" required>
                <button type="submit" class="formulario__submit">Eliminar Cupos</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        <section class="footer__container container">
            <nav class="nav nav--footer">
                <h2 class="footer__title">Talleres León.</h2>

                <ul class="nav__link nav__link--footer">
                    <li class="nav__items">
                        <a href="bienvenida.php" class="nav__links">Inicio</a>
                    </li>
                    <li class="nav__items">
                        <a href="mis_talleres.php" class="nav__links">Mi perfil</a>
                    </li>
                    <li class="nav__items">
                        <a href="ver_talleres.php" class="nav__links">Ver talleres</a>
                    </li>
                    <li class="nav__items">
                        <a href="cerrar_sesion.php" class="nav__links">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>

            <form class="footer__form" action="https://formspree.io/f/xgvenala" method="POST">
                <h2 class="footer__newsletter">¿Tienes problemas?</h2>
                <p class="footer__newsletter">Deja tu email y te contactaremos.</p>
                <div class="footer__inputs">
                    <input type="email" placeholder="Email:" class="footer__input" name="email">
                    <input type="submit" value="Enviar" class="footer__submit">
                </div>
            </form>
        </section>
        <section class="footer__copy container">
            <div class="footer__social">
                <a href="https://www.instagram.com/cuci_udeg/" class="footer__icons">
                    <img src="../assets/images/instagram.svg" alt="" class="footer__img">
                </a>
            </div>
            <h3 class="footer__copyright">Derechos reservados &copy;2024 Talleres León.</h3>
        </section>
    </footer>

    <script src="../assets/js/slider.js"></script>
    <script src="../assets/js/questions.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>

</html>

<?php
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

// Obtener el ID del taller y el número de cupos
$taller_id = $_POST['taller_id'];
$cupos = intval($_POST['cupos']); // Convertir a entero

// Validar que el número de cupos sea válido
if ($cupos <= 0) {
    die("Número de cupos no válido.");
}

// Reducir los cupos disponibles
$sql = "UPDATE talleres SET cupos_disponibles = cupos_disponibles - $cupos WHERE id_taller = $taller_id AND cupos_disponibles >= $cupos";
if ($conexion->query($sql)) {
    if ($conexion->affected_rows > 0) {
        echo "Se eliminaron $cupos cupos correctamente.";
    } else {
        echo "No hay suficientes cupos disponibles para eliminar.";
    }
} else {
    echo "Error al eliminar cupos: " . $conexion->error;
}

$conexion->close();
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
?>