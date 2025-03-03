<?php

    session_start();
    
    if(isset($_SESSION['usuario'])){
        header("location: php/bienvenida.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro - Talleres León</title>
    <link rel="shortcut icon" href="./assets/images/faviconleo.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/estilo.css">
</head>
<body>
    
    <main>
        
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera__login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar__sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera__register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Formulario de login y registro -->
            <div class="contenedor__login__register">
                <!-- Login -->
                <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electrónico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Entrar</button>
                </form>
                <!-- Registro -->
                <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                    <input type="text" placeholder="Correo Institucional" name="correo">
                    <input type="text" placeholder="Código del Estudiante" name="codigo_estudiante">
                    <input type="text" placeholder="Número de Teléfono" name="num_tel">
                    <input type="text" placeholder="Carrera" name="carrera">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="assets/js/script.js"></script>

</body>
</html>