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
    
    function sacarCoches(){
        $conexion = conectar();
        $sql = 'select * from coches';
        $resultado = $conexion->query($sql);

        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
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
                <input type="text" name="nombre" placeholder="Nombre de Usuario" required><br><br>
                <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required onkeyup="validarContraseña()"><br><br>
                <input type="submit" name="iniciar" value="Crear Cuenta">
                <?php
                
                    if(isset($_POST['iniciar'])){
                        print("<script>alert('click')</script>");
                        $conexion=conectar();
                        var_dump($conexion);
                        $sql = "INSERT INTO usuarios (nombre_usuario, passwd) VALUES ('dani','a')";
                        $resultado = $conexion->query($sql);
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