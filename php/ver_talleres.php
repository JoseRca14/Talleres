<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor, debes iniciar sesión");
            window.location = "../index.php";
        </script>
    ';
    session_destroy();
    die();
}

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'login_register_db');
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener todos los talleres (incluyendo id_taller)
$sql = "SELECT id_taller, nombre_taller, descripcion, fecha_inicio, fecha_fin, dia, hora, ubicacion, cupos_disponibles FROM talleres";
$result = $conexion->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
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

    <style>
        /* Estilos para la tabla y el contenedor */
        .table-container {
            opacity: 0; /* Inicia invisible */
            transform: translateY(20px); /* Desplazamiento inicial */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transición suave */
        }
        .table-container.show {
            opacity: 1; /* Visible */
            transform: translateY(0); /* Sin desplazamiento */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #2091f9;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* Estilos para los botones */
        .toggle-button, .register-button {
            background-color: #2091f9;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 20px; /* Espacio entre la tabla y el botón */
        }
        .toggle-button:hover, .register-button:hover {
            background-color: #1a73e8;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .toggle-button:active, .register-button:active {
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
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
            <p class="hero__paragraph">VER TALLERES</p>
        </section>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">Talleres para todos</h2>
            <p class="about__paragraph">Conoce algunos de nuestros talleres</p>

            <!-- Botón para mostrar/ocultar la tabla y el botón de registro -->
            <button class="toggle-button" onclick="toggleTable()">Mostrar Talleres</button>

            <!-- Contenedor para la tabla y el botón de registro -->
            <div class="table-container" id="table-container">
                <?php
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Código</th><th>Taller</th><th>Descripción</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Día</th><th>Hora</th><th>Ubicación</th><th>Cupos</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_taller']) . "</td>"; // Mostrar el código del taller
                        echo "<td>" . htmlspecialchars($row['nombre_taller']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fecha_inicio']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fecha_fin']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['dia']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hora']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cupos_disponibles']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No hay talleres registrados.</p>";
                }

                $conexion->close();
                ?>

                <!-- Botón para registrar un nuevo taller o registrarse a uno -->
                <button class="register-button" onclick="window.location.href='taller.php'">Regístrate o crea un Nuevo Taller</button>
            </div>
        </section>

        <!-- Script para mostrar/ocultar la tabla y el botón de registro -->
        <script>
            function toggleTable() {
                const container = document.getElementById('table-container');
                const button = document.querySelector('.toggle-button');

                if (container.classList.contains('show')) {
                    container.classList.remove('show'); // Oculta el contenedor
                    button.textContent = 'Mostrar Talleres'; // Cambia el texto del botón
                } else {
                    container.classList.add('show'); // Muestra el contenedor
                    button.textContent = 'Ocultar Talleres'; // Cambia el texto del botón
                }
            }
        </script>
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