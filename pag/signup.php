<?php

    function conectar(){
        // $conexion = new mysqli('localhost', 'root', '', 'vehiculos');
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-responsive.css">
    <link rel="icon" type="image/png" href="../images/logo.png">
    <title>Mango_signup</title>
</head>

<body id="body-login">
    <main>
        <div id="login-form">
            <a href="../index.html"><img id="logo-login" src="../images/logo3.png" alt=""></a>
            <p>Crear Cuenta</p>
            <form method="POST">
                <input type="text" name="nombre" placeholder="Nombre" required><br><br>
                <input type="text" name="nombreUsuario" placeholder="Nombre de Usuario" required><br><br>
                <input type="text" name="email" placeholder="Email" required><br><br>
                <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required onkeyup="validarContraseña()"><br><br>
                <input type="submit" name="iniciar" value="Crear Cuenta">
                <?php
                        if(isset($_POST['iniciar'])){

                            $conexion=conectar();
                            // $contraseña_crypt = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                            $sql = "INSERT INTO usuarios (id, nombre, nombre_usuario, email, passwd) 
                            VALUES (NULL, '".$_POST['nombre']."', '".$_POST['nombreUsuario']."', '".$_POST['email']."', '".$_POST['passwd']."')";
                            $resultado = $conexion->query($sql);
                            header("Location: ../index.php");
                            session_start();
                            $_SESSION['usuario_validado']=$_POST['nombre'];

                            
                        }
                    ?>
                <span id="alertPasswd"></span>
                <div class="terms">
                    <input id="check-term" type="checkbox" required style="width: 3vw;">
                    <p>Acepto los <a href="#"> terminos y condiciones</a></p>
                </div>
            </form>
            <p>O si tienes cuenta, <a href="./login.html"><span class="enlace-usuario">inicia sesión</span></a></p>
        </div>
    </main>
</body>
    <script src="../js/app.js"></script>
    <script src="../icons/fontawesome.js"></script>
</html>