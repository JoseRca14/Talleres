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
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">

    <meta name="theme-color" content="#2091f9">

    <meta name="title" content="Talleres León">
    <meta name="description" content="Descubre todo sobre los talleres: actividades deportivas, artísticas y educativas. ¡Participa y desarrolla tus habilidades!">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://freddy-king.github.io">
    <meta property="og:title" content="Talleres León">
    <meta property="og:description" content="Descubre todo sobre los talleres: actividades deportivas, artísticas y educativas. ¡Participa y desarrolla tus habilidades!">
    <meta property="og:image" content="https://freddy-king.github.io/images/imagen4.png">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://freddy-king.github.io">
    <meta property="twitter:title" content="Talleres León">
    <meta property="twitter:description" content="Descubre todo sobre los talleres: actividades deportivas, artísticas y educativas. ¡Participa y desarrolla tus habilidades!">
    <meta property="twitter:image" content="https://freddy-king.github.io/images/imagen4.png">
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
            <a href="./taller.php" class="cta">Crear un taller</a>
        </section>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">Talleres para todos</h2>
            <p class="about__paragraph">Conoce algunos de nuestros talleres</p>

            <div class="about__main">
                <article class="about__icons">
                    <img src="../assets/images/deportes.svg" alt="" class="about__icon">
                    <h3 class="about__title">Deportes</h3>
                    <p class="about__paragraph">Algunos de nuestros talleres son fútbol, voleibol y baloncesto</p>
                </article>

                <article class="about__icons">
                    <img src="../assets/images/arte.svg" alt="" class="about__icon">
                    <h3 class="about__title">Artístico</h3>
                    <p class="about__paragraph">Grandes talleres de música, baile y dibujo para soltar tu imaginación</p>
                </article>

                <article class="about__icons">
                    <img src="../assets/images/educativo.svg" alt="" class="about__icon">
                    <h3 class="about__title">Educativo</h3>
                    <p class="about__paragraph">Conoce los diferentes talleres educativos como ajedrez, matemáticas y juegos de mesa</p>
                </article>
            </div>
        </section>

        <section class="knowledge">
            <div class="knowledge__container container">
                <div class="knowledge__texts">
                    <h2 class="subtitle">Taller de arte</h2>
                    <p class="knowledge__paragraph">El nuevo taller de arte te está esperando para que te unas y liberes todo tu potencial artístico</p>
                    <a href="inscribir_taller.php?id_taller=35" class="cta">Unirme</a>
                </div>

                <figure class="knowledge__picture">
                    <img src="../assets/images/arte.jpg" alt="" class="knowledge__img">
                </figure>
            </div>
        </section>

        <section class="price container">
            <h2 class="subtitle">Algunos de nuestros talleres más relevantes son</h2>
            <div class="price__table">
                <div class="price__element">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de voleibol</h3>

                    <div class="price__items">
                        <p class="price__features">Entrenamientos básicos</p>
                        <p class="price__features">Torneos mixtos</p>
                        <p class="price__features">Moverte es vida</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=39" class="price__cta">Inscribirme</a>
                </div>

                <div class="price__element price__element--best">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de fútbol</h3>

                    <div class="price__items">
                        <p class="price__features">Entrenamientos básicos</p>
                        <p class="price__features">Torneos mixtos</p>
                        <p class="price__features">Demuestra tu "jogo bonito" en la cancha</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=32" class="price__cta">Inscribirme</a>
                </div>

                <div class="price__element">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de ajedrez</h3>

                    <div class="price__items">
                        <p class="price__features">Aprende a jugar</p>
                        <p class="price__features">Enfrentamientos y torneos</p>
                        <p class="price__features">Sé el vencedor de un gran juego de estrategia</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=38" class="price__cta">Inscribirme</a>
                </div>
            </div>
        </section>

        <section class="testimony">
            <h2 class="subtitle__testimony">Noticias y testimonios de los talleres</h2>
            <div class="testimony__container container">
                <img src="../assets/images/leftarrow.svg" alt="" class="testimony__arrow" id="before">
                <section class="testimony__body testimony__body--show" data-id="1">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Rodrigo Muñoz, <span class="testimony__gente">Estudiante</span></h2>
                        <p class="testimony__review">Soy estudiante de la carrera de INNI y actualmente estoy impartiendo el taller de fútbol dentro del CUCI. Esta página web me ha ayudado a estar más en contacto con las personas y a mejorar mi organización al momento de impartir el taller. </p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/roy.jpeg" alt="" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="2">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Cristian Vazquez, <span class="testimony__gente">Estudiante</span></h2>
                        <p class="testimony__review">Soy estudiante de la carrera de QFB y actualmente formo parte del taller de baloncesto. Me ha encantado la experiencia de participar en torneos dentro del taller y poder competir junto a mis compañeros. </p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/cristian.jpeg" alt="" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="3">
                    <div class="testimony__texts">
                        <h2 class="subtitle">¿Ya conoces el nuevo taller de <span class="testimony__gente">Ajedrez?</span></h2>
                        <p class="testimony__review">Actualmente, es uno de los mejores talleres para poner a prueba tus habilidades en el campo de batalla y demostrar que eres el mejor. ¡Inscríbete y participa en los torneos que se realizarán cada semana! </p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/ajedrez.jpg" alt="" class="testimony__img">
                    </figure>
                </section>

                <img src="../assets/images/righarrow.svg" alt="" class="testimony__arrow" id="next">
            </div>
        </section>

        <section class="questions container">
            <h2 class="subtitle">Preguntas frecuentes</h2>
            <p class="questions__paragraph">Conoce las preguntas más frecuentes que nos hacen sobre los talleres</p>

            <section class="questions__container">
                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Qué son los talleres?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Los talleres son actividades diseñadas para desarrollar habilidades específicas en los participantes</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Cómo puedo sacar mis constancias de los talleres?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Debes de ir con tu asesor de talleres para solicitar tu constancia</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Cómo inscribirme o crear un taller?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Los talleres pueden ser creados por cualquier estudiante, pero para que tengan validez, necesitan ser aprobados por el maestro responsable</p>
                    </div>
                </article>
            </section>

            <section class="questions__offer">
                <h2 class="subtitle">“¿Estás listo?”</h2>
                <p class="questions__copy">Estamos a favor de la actividad y convivencia de los estudiantes para poner a prueba y apoyar su desarrollo físico, mental y artístico durante su tiempo en la Universidad</p>
                <a href="./ver_talleres.php" class="cta">Conoce todos los talleres</a>
            </section>
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

    <script src="../assets/js/slider.js"></script>
    <script src="../assets/js/questions.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>

</html>
