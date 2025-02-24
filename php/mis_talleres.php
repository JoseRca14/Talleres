<?php 

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor debes iniciar sesion");
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
    <link rel="shortcut icon" href="../assets/images/favico.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">

    <meta name="theme-color" content="#2091f9">

    <meta name="title" content="Kombucha Aga-Ko">
    <meta name="description" content="Descubre todo sobre la kombucha: su proceso de elaboración, beneficios para la
        salud y consejos para disfrutarla. ¡Sumérgete en el mundo de esta bebida fermentada y saludable!">

    <meta property="og:type" content="website" >
    <meta property="og:url" content="https://freddy-king.github.io">
    <meta property="og:title" content="Kombucha Aga-Ko">
    <meta property="og:description" content="Descubre todo sobre la kombucha: su proceso de elaboración, beneficios
        para la salud y consejos para disfrutarla. ¡Sumérgete en el mundo de esta bebida fermentada y saludable!">
    <meta property="og:image" content="https://freddy-king.github.io/images/imagen4.png" >

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://freddy-king.github.io">
    <meta property="twitter:title" content="Kombucha Aga-Ko" >
    <meta property="twitter:description" content="Descubre todo sobre la kombucha: su proceso de elaboración,
        beneficios para la salud y consejos para disfrutarla. ¡Sumérgete en el mundo de esta bebida fermentada y
        saludable!">
    <meta property="twitter:image" content="https://freddy-king.github.io/images/imagen4.png">
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
                    <a href="cerrar_sesion.php" class="nav__links">Cerrar sesion</a>
                </li>
                <img src="./images/cerrar.svg" alt="" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="./images/menu.svg" alt="" class="nav_img">
            </div>
        </nav>
        <section class="hero__container container">
            <h1 class="hero__title">León en Acción.</h1>
            <p class="hero__paragraph">Talleres y Deportes para Crecer.</p>
            <p class="hero__paragraph">MIS TALLERES.</p>
        </section>



    </header>

    <main>
        <section class="container about">
            <h2>Mis datos</h2>
            <table>
                <thead>
                    <tr>
                        <th>id del usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Codigo</th>
                        <th>Num_tel</th>
                        <th>Carrera</th>
                    </tr>
                </thead>
                <tbody id="usuario-body">
                    <!-- Los datos se insertarán aquí con AJAX -->
                </tbody>
            </table>
        </section>
        <!-- Cargar jQuery si no está incluido -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'mostrar_usuario.php', // Archivo PHP que obtiene los talleres
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        $('#usuario-body').html(data); // Insertar los talleres en la tabla
                    },
                    error: function(xhr, status, error) {
                        $('#usuario-body').html('<tr><td colspan="7">Error al cargar el usuario: ' + error + '</td></tr>');
                    }
                });
            });
        </script>

        <section class="container about">
            <h2>Talleres que cree</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Id del taller</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody id="talleres-body">
                    <!-- Los datos se insertarán aquí con AJAX -->
                </tbody>
            </table>
        </section>
        <!-- Cargar jQuery si no está incluido -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'mostrar_mis_talleres.php', // Archivo PHP que obtiene los talleres
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        $('#talleres-body').html(data); // Insertar los talleres en la tabla
                    },
                    error: function(xhr, status, error) {
                        $('#talleres-body').html('<tr><td colspan="7">Error al cargar los talleres: ' + error + '</td></tr>');
                    }
                });
            });
        </script>

        <section class="container about">
            <h2>Talleres a los que pertenezco</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id del taller</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody id="talleres-body1">
                    <!-- Los datos se insertarán aquí con AJAX -->
                </tbody>
            </table>
        </section>
        <!-- Cargar jQuery si no está incluido -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'talleres_inscrito.php', // Archivo PHP que obtiene los talleres
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        $('#talleres-body1').html(data); // Insertar los talleres en la tabla
                    },
                    error: function(xhr, status, error) {
                        $('#talleres-body1').html('<tr><td colspan="7">Error al cargar los talleres: ' + error + '</td></tr>');
                    }
                });
            });
        </script>
       
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
                        <a href="cerrar_sesion.php" class="nav__links">Cerrar sesion</a>
                    </li>
                </ul>
            </nav>

            <form class="footer__form" action="https://formspree.io/f/xgvenala" method="POST">
                <h2 class="footer__newsletter">¿Tienes problemas? </h2>
                <p class="footer__newsletter">Deja tu email y te contactaremos.</p>
                <div class="footer__inputs">
                    <input type="email" placeholder="Email:" class="footer__input" name="email">
                    <input type="submit" value="Enviar." class="footer__submit">

                </div>
            </form>
        </section>
        <section class="footer__copy container">
            <div class="footer__social">
                <!-- <a href="https://www.facebook.com" class="footer__icons"> <img src="./images/facebook.svg" alt="" class="footer__img"></a> -->
                <a href="https://www.instagram.com/cuci_udeg/" class="footer__icons">
                    <img src="../assets/images/instagram.svg" alt="" class="footer__img"></a>
                <!-- <a href="https://x.com" class="footer__icons"> <img src="./images/X.svg" alt="" class="footer__img"></a> -->
                <!-- <a href="https://www.youtube.com" class="footer__icons"> <img src="./images/youtube.svg" alt="" class="footer__img"></a> -->
            </div>
            <h3 class="footer__copyright">Derechos reservados &copy;2024 Talleres León.</h3>
        </section>
    </footer>


    <script src="../assets/js/slider.js"></script>
    <script src="../assets/js/questions.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>

</html>
