<?php 
    require_once('../theme/database.php');
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
            <div id="logo-login"><a href="#"><img src="../images/logo3.png" alt=""></a></div>
            <p>Iniciar Sesión</p>
            <form method="POST">
                <input autocomplete="off" type="text" name="nombre" placeholder="Nombre de Usuario" required><br><br>
                <input autocomplete="off" id="passwd" type="password" name="passwd" placeholder="Contraseña" required onkeyup="validarContraseña()"><br><br>
                <input type="submit" name="iniciar" value="Inicia Sesión">
                <?php
                    $database = new Database();
                        if(isset($_POST['iniciar'])){
                            
                            $nombre = $_POST['nombre'];
                            $contraseña = $_POST['passwd'];
                            $conexion = $database -> conectar();
                            $query="SELECT id, nombre_usuario, passwd FROM 13_usuarios WHERE nombre_usuario='".$nombre."'";
                            $resultado=$conexion->query($query);
                            $numRows = $resultado->rowCount();
                            
                            if($numRows==0){
                                print("<p>Ha ocurrido un error, el usuario no existe</p>");
                            }else{
                                
                                $passwordCorrecta=password_hash($contraseña,PASSWORD_DEFAULT);
                                
                                $fila=$resultado->fetch(PDO::FETCH_ASSOC);
                                $idBD=$fila['id'];
                                $passwdBD=$fila['passwd'];
                                $usuarioBD=$fila['nombre_usuario'];
                                // echo $passwordCorrecta."<br>";
                                // echo $passwdBD;
                                if (password_verify($contraseña,$passwdBD)) {
                                    session_start();
                                    echo "<p>Bienvenido, ".$usuarioBD."!</p>";
                                    $_SESSION['usuario_validado'] = $usuarioBD;
                                    $_SESSION['id_usuario_validado'] = $idBD;
                                    header("Location: ../index.php");
                                }else{
                                    echo "<p>Contraseña o usuario incorrecto.</p>";
                                }
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