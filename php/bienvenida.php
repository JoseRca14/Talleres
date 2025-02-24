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
            <a href="./taller.php" class="cta">Crear un taller</a>
        </section>



    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">Talleres para todos!</h2>
            <p class="about__paragraph">Conoce algunos de nuestros talleres.</p>

            <div class="about__main">
                <article class="about__icons">
                    <img src="../assets/images/noticias.svg" alt="" class="about__icon">
                    <h3 class="about__title">Deportes</h3>
                    <p class="about__paragraph">Algunos de nuestros talleres son futbol, voleybol y basquetbol.</p>
                </article>

                <article class="about__icons">
                    <img src="../assets/images/acerca.svg" alt="" class="about__icon">
                    <h3 class="about__title">Artistico</h3>
                    <P class="about__paragraph">Grandes talerres de musica, baile y dibujo para soltar tu imaginacion.</Pclass>
                    </P>
                </article>

                <article class="about__icons">
                    <img src="../assets/images/tienda.svg" alt="" class="about__icon">
                    <h3 class="about__title">Educativo</h3>
                    <p class="about__paragraph">Conoce los diferentes los diferentes talleres educativos como ejedrez, matematicas y juegos de mesa.</p>
                </article>
            </div>
        </section>

        <section class="knowledge">
            <div class="knowledge__container container">
                <div class="knowledge__texts">
                    <h2 class="subtitle">Taller de arte.</h2>
                    <p class="knowledge__paragraph">El nuevo taller arte te esta esperando para que te unas y liberes todo tu potencial artistico.</p>
                    <a href="./taller.php" class="cta">Unirme</a>
                </div>

                <figure class="knowledge__picture">
                    <img src="../assets/images/arte.jpg" alt="" class="knowledge__img">
                </figure>
            </div>
        </section>

        <section class="price container">
            <h2 class="subtitle">Algunos de nuestros talleres mas relevantes son.</h2>
            <div class="price__table">
                <div class="price__element">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de voleybol.</h3>

                    <div class="price__items">
                        <p class="price__features">Entranamientos basicos</p>
                        <p class="price__features">Torneos mixtos</p>
                        <p class="price__features">Moverte es vida.</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=1" class="price__cta">Inscribirme</a>
                </div>


                <div class="price__element price__element--best">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de futbol.</h3>

                    <div class="price__items">
                        <p class="price__features">Entranamientos basicos</p>
                        <p class="price__features">Torneos mixtos</p>
                        <p class="price__features">Desmuestra tu jogabonito en la cancha.</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=2" class="price__cta">Inscribirme</a>
                </div>

                <div class="price__element">
                    <p class="price__name">-----------</p>
                    <h3 class="price__price">Taller de Ajedrez.</h3>

                    <div class="price__items">
                        <p class="price__features">Aprende a jugar</p>
                        <p class="price__features">Enfrentamientos y torneos</p>
                        <p class="price__features">Se el vencedor de un gran juego de estrategia.</p>
                    </div>
                    <a href="inscribir_taller.php?id_taller=3" class="price__cta">Inscribirme</a>
                </div>

            </div>
        </section>

        <section class="testimony">
            <h2 class="subtitle__testimony">Noticias y testimonio de los talleres.</h2>
            <div class="testimony__container container">
                <img src="../assets/images/leftarrow.svg" alt="" class="testimony__arrow" id="before">
                <section class="testimony__body testimony__body--show" data-id="1">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Diego Aparicio, <span
                                class="testimony__gente">Estudiante.</span></h2>
                        <p class="testimony__review">Responsable del desarrollo y producción de Aga-ko. Este proyecto
                            nació de mi deseo de ofrecer una alternativa saludable a las bebidas convencionales, altas
                            en azúcar y calorías. Con Aga-ko, he creado una kombucha que no solo es beneficiosa para la
                            salud de los consumidores, sino que también representa una fusión única entre la cultura
                            japonesa y mexicana.</p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/persona1.jpeg" alt="" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="2">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Paola, <span class="testimony__gente">Estudiante.</span></h2>
                        <p class="testimony__review">participe en lo que es la administración de el departamento
                            Recursos Humanos.</p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/persona2.jpeg" alt="" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="3">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Juan Ángel, <span class="testimony__gente">Estudiante.</span>
                        </h2>
                        <p class="testimony__review">Contribuir a la eficiencia económica, optimizando procesos y
                            apoyando la toma de decisiones clave para el crecimiento de la empresa.</p>
                    </div>
                    <figure class="testimony__picture">
                        <img src="../assets/images/persona3.jpeg" alt="" class="testimony__img">
                    </figure>
                </section>

                <img src="../assets/images/righarrow.svg" alt="" class="testimony__arrow" id="next">
            </div>
        </section>

        <section class="questions container">
            <h2 class="subtitle">Preguntas frecuentes</h2>
            <p class="questions__paragraph">Conoce las preguntas mas frecuentes que nos hacen sobre los talleres.</p>

            <section class="questions__container">
                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Qué son los talleres?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Los talleres son.</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Como puedo sacar mis constancias de los talleres?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Debes de ir con tu accesor de.</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Como incribirme o crear un taller?
                            <span class="questions__arrow">
                                <img src="../assets/images/arrow.svg" alt="" class="questions_img">
                            </span>
                        </h3>
                        <p class="questions__show">Los talleres pueden ser creados por cualquier estudiante pero para que tenga alguna validez necesita ir con el Maestro fulanito de tal.</p>
                    </div>
                </article>

            </section>

            <section class="questions__offer">
                <h2 class="subtitle">“Estás listo”</h2>
                <p class="questions__copy">Estamos a favor de la actividad y convivencia de los estudiantes para poner aprueba y apoyar su desarrollo fisico, mental y artistico durante su tiempo en la Universidad.</p>
                <a href="./ver_talleres.php" class="cta">Conoce.</a>
            </section>
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
