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
    <title>Mango_login</title>
</head>

<body id="body-login">
    <main>
        <div id="login-form">
            <div id="logo-login"><a href="../index.php"><img src="../images/logo3.png" alt=""></a></div>
            <p>Iniciar Sesión</p>
            <form method="POST">
                <input type="text" name="nombre" placeholder="Nombre de Usuario" required><br><br>
                <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required onkeyup="validarContraseña()"><br><br>
                <input type="submit" name="iniciar" value="Inicia Sesión">
                <?php
                        if(isset($_POST['iniciar'])){

                            $nombre = $_POST['nombre'];
                            $contraseña = $_POST['passwd'];
                            $contraseña_crypt = password_hash($contraseña, PASSWORD_DEFAULT);
                            $conexion=conectar();
                            $query="SELECT nombre_usuario, passwd FROM usuarios WHERE nombre_usuario='".$nombre."'";
                            $resultado=$conexion->query($query);
                            $numRows = $resultado->rowCount();
                            
                            if($numRows==0){
                                print("<p>Ha ocurrido un error, el usuario no existe</p>");
                            }else{                                
                                $fila=$resultado->fetch(PDO::FETCH_ASSOC);
                                $passwdBD=$fila['passwd'];
                                $usuarioBD=$fila['nombre_usuario'];
                                if ($passwdBD == $contraseña) {
                                    session_start();
                                    echo "<p>Bienvenido, ".$usuarioBD."!</p>";
                                    $_SESSION['usuario_validado'] = $usuarioBD;
                                    header("Location: ../index.php");
                                }else{
                                    echo "<p>Contraseña incorrecta.</p>";
                                }
                                // if(password_verify($contraseña, $contraseña_crypt)){
                                //     echo "<p>Bienvenido, ".$usuarioBD."!</p>";
                                //     $_SESSION['usuario_validado'] = $usuarioBD;
                                //     header("Location: ../index.php");
                                //     print_r(var_dump($_SESSION['usuario_validado']));
                                // }else{
                                //     echo "<p>Contraseña incorrecta.</p>";
                                // }
                            }
                        }
                    ?>
                <!--<div class="terms">
                    <input id="check-term" type="checkbox" required style="width: 3vw;">
                    <p>Acepto los <a href="#"> terminos y condiciones</a></p>
                </div>-->
            </form>
            
            <p>O si no tienes cuenta, <a href="./signup.php"><span class="enlace-usuario">créate una</span></a></p>
        </div>
    </main>
</body>
<script src="../js/app.js"></script>
</html>