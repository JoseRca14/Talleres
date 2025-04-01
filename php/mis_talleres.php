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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/css/mis_talleres.css">
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
            <p class="hero__paragraph">MI PERFIL</p>
        </section>
    </header>

    <main class="container my-5">
        <!-- Sección de datos del usuario -->
        <section class="mb-5">
            <h2 class="section-title">Mis datos</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user icon"></i>Información del usuario
                        </div>
                        <div class="card-body" id="usuario-body">
                            <!-- Los datos del usuario se cargarán aquí con AJAX -->
                            <p class="text-center">Cargando datos...</p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn-action delete-user" onclick="eliminarUsuario()">
                                <i class="fas fa-trash icon"></i>Eliminar mi cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de talleres creados -->
        <section class="mb-5">
            <h2 class="section-title">Talleres que creé</h2>
            <div class="row justify-content-center" id="talleres-body">
                <!-- Los talleres creados se cargarán aquí con AJAX -->
                <p class="text-center">Cargando talleres...</p>
            </div>
        </section>

        <!-- Sección de administración de participantes -->
        <section class="mb-5">
            <h2 class="section-title">Administrar participantes</h2>
            <div class="row justify-content-center" id="talleres-administrar">
                <!-- Los talleres con participantes se cargarán aquí -->
                <p class="text-center">Cargando participantes...</p>
            </div>
        </section>

        <!-- Sección de talleres inscritos -->
        <section class="mb-5">
            <h2 class="section-title">Talleres a los que pertenezco</h2>
            <div class="row justify-content-center" id="talleres-body1">
                <!-- Los talleres inscritos se cargarán aquí con AJAX -->
                <p class="text-center">Cargando talleres...</p>
            </div>
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

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar datos del usuario
            $.ajax({
                url: 'mostrar_usuario.php',
                type: 'GET',
                success: function(data) {
                    $('#usuario-body').html(data);
                },
                error: function(xhr, status, error) {
                    $('#usuario-body').html('<p class="text-danger">Error al cargar los datos del usuario.</p>');
                }
            });

            // Cargar talleres creados
            $.ajax({
                url: 'mostrar_mis_talleres.php',
                type: 'GET',
                success: function(data) {
                    $('#talleres-body').html(data);
                },
                error: function(xhr, status, error) {
                    $('#talleres-body').html('<p class="text-danger">Error al cargar los talleres creados.</p>');
                }
            });

            // Cargar talleres para administrar participantes
            $.ajax({
                url: 'mostrar_talleres_para_administrar.php',
                type: 'GET',
                success: function(data) {
                    $('#talleres-administrar').html(data);
                },
                error: function(xhr, status, error) {
                    $('#talleres-administrar').html('<p class="text-danger">Error al cargar los talleres para administración.</p>');
                }
            });

            // Cargar talleres inscritos
            $.ajax({
                url: 'talleres_inscrito.php',
                type: 'GET',
                success: function(data) {
                    $('#talleres-body1').html(data);
                },
                error: function(xhr, status, error) {
                    $('#talleres-body1').html('<p class="text-danger">Error al cargar los talleres inscritos.</p>');
                }
            });
        });

        // Función para eliminar usuario
        function eliminarUsuario() {
            if (confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.")) {
                $.ajax({
                    url: 'eliminar_usuario.php',
                    type: 'POST',
                    success: function(response) {
                        alert(response);
                        window.location.href = 'cerrar_sesion.php';
                    },
                    error: function(xhr, status, error) {
                        alert("Error al eliminar la cuenta: " + error);
                    }
                });
            }
        }

        // Función para eliminar participante de un taller
        function eliminarParticipante(tallerId, usuarioId) {
            if (confirm("¿Estás seguro de que deseas eliminar este participante? Se liberará un cupo en el taller.")) {
                $.ajax({
                    url: 'eliminar_participante.php',
                    type: 'POST',
                    data: { 
                        taller_id: tallerId,
                        usuario_id: usuarioId
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error al eliminar participante: " + error);
                    }
                });
            }
        }

        // Función para agregar cupos a un taller
        function agregarCupos(tallerId) {
            const cupos = prompt("Ingresa el número de cupos que deseas agregar:");
            if (cupos === null || cupos === "" || isNaN(cupos) || cupos <= 0) {
                alert("Debes ingresar un número válido de cupos.");
                return;
            }

            $.ajax({
                url: 'agregar_cupos.php',
                type: 'POST',
                data: { taller_id: tallerId, cupos: cupos },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Error al agregar cupos: " + error);
                }
            });
        }

        // Función para eliminar cupos de un taller
        function eliminarCupos(tallerId) {
            const cupos = prompt("Ingresa el número de cupos que deseas eliminar:");
            if (cupos === null || cupos === "" || isNaN(cupos) || cupos <= 0) {
                alert("Debes ingresar un número válido de cupos.");
                return;
            }

            $.ajax({
                url: 'eliminar_cupos.php',
                type: 'POST',
                data: { taller_id: tallerId, cupos: cupos },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Error al eliminar cupos: " + error);
                }
            });
        }

        // Función para eliminar un taller
        function eliminarTaller(tallerId) {
            if (confirm("¿Estás seguro de que deseas eliminar este taller? Esta acción no se puede deshacer.")) {
                $.ajax({
                    url: 'eliminar_taller.php',
                    type: 'POST',
                    data: { taller_id: tallerId },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error al eliminar el taller: " + error);
                    }
                });
            }
        }
    </script>
</body>
</html>