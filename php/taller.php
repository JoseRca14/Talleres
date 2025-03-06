<?php 

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor, debes iniciar sesión");
                window.location = "../index.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres León</title>
    <link rel="shortcut icon" href="../assets/images/faviconleo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Talleres León</h2>
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
        <section class="hero__container container">
            <h1 class="hero__title">León en Acción</h1>
            <p class="hero__paragraph">Talleres y Deportes para Crecer</p>
        </section>
    </header>
    
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera__login">
                    <h3>¿Quieres registrarte a un taller?</h3>
                    <p>Elige un taller para registrarte</p>
                    <button id="btn__iniciar__sesion">Registrarse</button>
                </div>
                <div class="caja__trasera__register">
                    <h3>¿Quieres crear un taller?</h3>
                    <p>Crea un taller fácil y rápido</p>
                    <button id="btn__registrarse">Crear</button>
                </div>
            </div>

            <!-- Formulario de login y registro -->
            <div class="contenedor__login__register">
                <!-- Inscripción a taller -->
                <form action="./login_taller_be.php" method="POST" class="formulario__login">
                    <h2>Inscríbete a un taller</h2>
                    <!-- <input type="text" placeholder="Ingresa tu número de usuario" name="id_usuario"> -->
                    <input type="text" placeholder="Ingresa el ID del taller" name="id_taller">
                    <button>Registrarme</button>
                </form>
                <!-- Creación de taller -->
                <form action="./registro_taller_be.php" method="POST" class="formulario__register">
                    <h2>Crea un taller</h2>
                    <input type="text" placeholder="Nombre del Taller" name="nombre_taller">
                    <input type="text" placeholder="Descripción" name="descripcion">
                    <input type="date" placeholder="Fecha de Inicio" name="fecha_inicio">
                    <input type="date" placeholder="Fecha Final" name="fecha_fin">
                    <input type="text" placeholder="Días" name="dia">
                    <input type="time" placeholder="Hora" name="hora">
                    <input type="text" placeholder="Ubicación" name="ubicacion">
                    <input type="text" placeholder="Cupos" name="cupos_disponibles">
                    <button>Crear taller</button>
                </form>
            </div>
        </div>
        <section class="container about">
        </section>
    </main>

    <footer class="footer">
        <section class="footer__container container">
            <nav class="nav nav--footer">
                <h2 class="footer__title">Talleres León</h2>

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
                <p class="footer__newsletter">Deja tu email y te contactaremos</p>
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
            <h3 class="footer__copyright">Derechos reservados &copy;2024 Talleres León</h3>
        </section>
    </footer>

    <script src="../assets/js/script.js"></script>
</body>
</html>