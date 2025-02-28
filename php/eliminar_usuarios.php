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
    if (isset($_POST['usuarios'])) {
        $usuarios_a_eliminar = $_POST['usuarios'];

        foreach ($usuarios_a_eliminar as $usuario_id) {
            $query_eliminar_usuario = mysqli_query($conexion, "DELETE FROM usuarios_talleres WHERE taller_id = '$id_taller' AND usuario_id = '$usuario_id'");

            if (!$query_eliminar_usuario) {
                echo '
                    <script>
                        alert("Error al eliminar usuarios");
                        window.location = "mis_talleres.php";
                    </script>
                ';
                die();
            }
        }

        echo '
            <script>
                alert("Usuarios eliminados correctamente");
                window.location = "mis_talleres.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("No se seleccionaron usuarios para eliminar");
                window.location = "eliminar_usuarios.php?id_taller=' . $id_taller . '";
            </script>
        ';
    }
}

// Obtener la lista de usuarios inscritos en el taller
$query_usuarios = mysqli_query($conexion, "
    SELECT u.id, u.nombre_completo 
    FROM usuarios u
    INNER JOIN usuarios_talleres ut ON u.id = ut.usuario_id
    WHERE ut.taller_id = '$id_taller'
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuarios Inscritos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css"><!-- Referencia al archivo CSS correcto -->
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
            <h2 class="subtitle">Eliminar Usuarios Inscritos</h2>
            <p class="about__paragraph">Selecciona los usuarios que deseas eliminar del taller.</p>

            <form method="POST" action="" class="formulario">
                <?php
                if (mysqli_num_rows($query_usuarios) > 0) {
                    while ($usuario = mysqli_fetch_assoc($query_usuarios)) {
                        echo '
                            <div class="formulario__checkbox">
                                <input type="checkbox" id="usuario_' . $usuario['id'] . '" name="usuarios[]" value="' . $usuario['id'] . '">
                                <label for="usuario_' . $usuario['id'] . '">' . htmlspecialchars($usuario['nombre_completo']) . '</label>
                            </div>
                        ';
                    }
                } else {
                    echo '<p class="about__paragraph">No hay usuarios inscritos en este taller.</p>';
                }
                ?>
                <button type="submit" class="formulario__submit">Eliminar Seleccionados</button>
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
?>