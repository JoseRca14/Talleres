<<<<<<< HEAD
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
=======
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
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
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
<<<<<<< HEAD

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
=======
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/css/mis_talleres.css">
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
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

<<<<<<< HEAD
    <main>
    <section class="container about">
    <h2>Mis datos</h2>
    <div class="table-responsive"> <!-- Contenedor para hacer la tabla responsive -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID del usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Código</th>
                    <th>Número de teléfono</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody id="usuario-body">
                <!-- Los datos se insertarán aquí con AJAX -->
            </tbody>
        </table>
    </div>
</section>

<!-- Cargar jQuery si no está incluido -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'mostrar_usuario.php', // Archivo PHP que obtiene los datos del usuario
            type: 'GET',
            cache: false,
            success: function(data) {
                $('#usuario-body').html(data); // Insertar los datos en la tabla
            },
            error: function(xhr, status, error) {
                $('#usuario-body').html('<tr><td colspan="6">Error al cargar los datos del usuario: ' + error + '</td></tr>');
            }
        });
    });
</script>

<style>
    /* Estilos para la tabla */
    .table-responsive {
        overflow-x: auto; /* Hace la tabla responsive en pantallas pequeñas */
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
    }

    .styled-table th {
        background-color: #2091f9;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
        transition: background-color 0.3s ease;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f9f9f9;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #2091f9;
    }

    .styled-table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Estilos para el mensaje de carga o error */
    #usuario-body tr td[colspan="6"] {
        text-align: center;
        padding: 20px;
        font-size: 16px;
        color: #6c757d;
    }
</style>

    <section class="container about">
        <h2>Talleres que creé</h2>
        <div class="table-responsive"> <!-- Contenedor para hacer la tabla responsive -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID del taller</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                        <th>Cupos</th>
                        <th>Cupos ocupados</th>
                        <th>Cupos disponibles</th>
                    </tr>
                </thead>
                <tbody id="talleres-body">
                    <!-- Los datos se insertarán aquí con AJAX -->
                </tbody>
            </table>
        </div>
        </section>

    <!-- Cargar jQuery si no está incluido -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'mostrar_mis_talleres.php', // Archivo PHP que obtiene los talleres creados
                type: 'GET',
                cache: false,
                success: function(data) {
                    $('#talleres-body').html(data); // Insertar los talleres en la tabla
                },
                error: function(xhr, status, error) {
                    $('#talleres-body').html('<tr><td colspan="11">Error al cargar los talleres: ' + error + '</td></tr>');
                }
            });
        });
    </script>

    <style>
        /* Estilos para la tabla */
        .table-responsive {
            overflow-x: auto; /* Hace la tabla responsive en pantallas pequeñas */
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .styled-table th {
            background-color: #2091f9;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            transition: background-color 0.3s ease;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #2091f9;
        }

        .styled-table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Estilos para las celdas de cupos */
        .styled-table td:nth-child(9),
        .styled-table td:nth-child(10),
        .styled-table td:nth-child(11) {
            text-align: center;
            font-weight: bold;
        }

        /* Estilos para los cupos disponibles */
        .styled-table td:nth-child(11) {
            color: #28a745; /* Verde para cupos disponibles */
        }

        /* Estilos para los cupos ocupados */
        .styled-table td:nth-child(10) {
            color: #dc3545; /* Rojo para cupos ocupados */
        }

        /* Estilos para el mensaje de carga o error */
        #talleres-body tr td[colspan="11"] {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #6c757d;
        }
    </style>
        

        <section class="container about">
            <h2>Talleres a los que pertenezco</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID del taller</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                        <th>Cupos</th>
                        <th>Cupos disponibles</th>
                        <th>Cupos ocupados</th>
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
                    url: 'talleres_inscrito.php', // Archivo PHP que obtiene los talleres inscritos
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        $('#talleres-body1').html(data); // Insertar los talleres en la tabla
                    },
                    error: function(xhr, status, error) {
                        $('#talleres-body1').html('<tr><td colspan="8">Error al cargar los talleres: ' + error + '</td></tr>');
                    }
                });
            });
        </script>
=======
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

        <!-- Sección de talleres inscritos -->
        <section class="mb-5">
            <h2 class="section-title">Talleres a los que pertenezco</h2>
            <div class="row" id="talleres-body1">
                <!-- Los talleres inscritos se cargarán aquí con AJAX -->
                <p class="text-center">Cargando talleres...</p>
            </div>
        </section>
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
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

<<<<<<< HEAD
    <script src="../assets/js/slider.js"></script>
    <script src="../assets/js/questions.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>

</html>
=======
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
                        window.location.href = 'cerrar_sesion.php'; // Redirigir al cerrar sesión
                    },
                    error: function(xhr, status, error) {
                        alert("Error al eliminar la cuenta: " + error);
                    }
                });
            }
        }

        // Función para agregar cupos a un taller
        function agregarCupos(tallerId) {
            // Mostrar un prompt para que el usuario ingrese el número de cupos
            const cupos = prompt("Ingresa el número de cupos que deseas agregar:");

            // Validar que el usuario haya ingresado un número válido
            if (cupos === null || cupos === "" || isNaN(cupos) || cupos <= 0) {
                alert("Debes ingresar un número válido de cupos.");
                return;
            }

            // Enviar el número de cupos al servidor
            $.ajax({
                url: 'agregar_cupos.php',
                type: 'POST',
                data: { taller_id: tallerId, cupos: cupos },
                success: function(response) {
                    alert(response);
                    location.reload(); // Recargar la página para actualizar los datos
                },
                error: function(xhr, status, error) {
                    alert("Error al agregar cupos: " + error);
                }
            });
        }

        // Función para eliminar cupos de un taller
        function eliminarCupos(tallerId) {
            // Mostrar un prompt para que el usuario ingrese el número de cupos
            const cupos = prompt("Ingresa el número de cupos que deseas eliminar:");

            // Validar que el usuario haya ingresado un número válido
            if (cupos === null || cupos === "" || isNaN(cupos) || cupos <= 0) {
                alert("Debes ingresar un número válido de cupos.");
                return;
            }

            // Enviar el número de cupos al servidor
            $.ajax({
                url: 'eliminar_cupos.php',
                type: 'POST',
                data: { taller_id: tallerId, cupos: cupos },
                success: function(response) {
                    alert(response);
                    location.reload(); // Recargar la página para actualizar los datos
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
                        location.reload(); // Recargar la página para actualizar los datos
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
>>>>>>> 9234dfd4f8e6c37228e323baa9ac78a51fef8b57
