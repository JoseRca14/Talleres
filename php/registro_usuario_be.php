<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $codigo_estudiante = $_POST['codigo_estudiante'];
    $num_tel = $_POST['num_tel'];
    $carrera = $_POST['carrera'];
    $contrasena = $_POST['contrasena'];
    
    //Encriptamiento de contrasena
    $contrasena = hash('sha512', $contrasena);

    $query = "INSERT INTO usuarios(nombre_completo, correo, codigo_estudiante, num_tel, carrera, contrasena)
              VALUES('$nombre_completo', '$correo', '$codigo_estudiante', '$num_tel', '$carrera', '$contrasena')";


    //verificacion del correo para que no se repita en la base de datos.
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    //verificacion del codigo del estudiante para que no se repita en la base de datos.
    $verificar_codigo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE codigo_estudiante='$codigo_estudiante' ");

    if(mysqli_num_rows($verificar_codigo) > 0){
        echo '
            <script>
                alert("Este codigo ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Intentalo de nuevo, usuario NO registrado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }

    mysqli_close($conexion);

?>