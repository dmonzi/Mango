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
                    $database = new Database();

                    if(isset($_POST['iniciar'])){
                        // $conexion = $database -> conectar();
                        // $query="SELECT nombre_usuario, email FROM usuarios WHERE nombre_usuario='".$_POST['nombreUsuario']."'";

                        // $resultado=$conexion->query($query);
                        // $numRows = $resultado->rowCount();
                        // $fila=$resultado->fetch(PDO::FETCH_ASSOC);
                        // $nombreUsuario=$fila['nombre_usuario'];
                        // $emailUsuario=$fila['email'];

                        if(Database::getNumRows("SELECT nombre_usuario, email FROM usuarios WHERE nombre_usuario='".$_POST['nombreUsuario']."'")>0 &&
                        Database::getNumRows("SELECT nombre_usuario, email FROM usuarios WHERE email='".$_POST['email']."'")>0){
                            print "El usuario y el correo ya están en uso, pruebe con otros";
                        }else if(Database::getNumRows("SELECT nombre_usuario, email FROM usuarios WHERE email='".$_POST['email']."'")>0){
                            print "El correo ya está en uso, pruebe con otro correo";
                        }else if(Database::getNumRows("SELECT nombre_usuario, email FROM usuarios WHERE nombre_usuario='".$_POST['nombreUsuario']."'")>0){
                            print "El usuario ya existe, pruebe con otro nombre";
                        }else{
                            //$contraseña_crypt = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                            $sql = "INSERT INTO usuarios (id, nombre, nombre_usuario, email, passwd) 
                            VALUES (NULL, '".$_POST['nombre']."', '".$_POST['nombreUsuario']."', '".$_POST['email']."', '".$_POST['passwd']."')";
                            $resultado = Database::conectar()->query($sql);
                            $query="SELECT id FROM usuarios WHERE nombre_usuario='".$_POST['nombreUsuario']."'";

                            $resultado=Database::conectar()->query($query);
                            
                            $idUsuario=$resultado->fetch(PDO::FETCH_ASSOC)['id'];
                            $resultado=Database::conectar()->query($query);
                            
                            session_start();
                            $_SESSION['usuario_validado']=$_POST['nombre'];
                            $_SESSION['id_usuario_validado']=$idUsuario;

                            header("Location: ../index.php");
                        }
                        
                        
                    }
                ?>
                <span id="alertPasswd"></span>
                <!-- <div class="terms">
                    <input id="check-term" type="checkbox" required style="width: 3vw;">
                    <p>Acepto los <a href="#"> terminos y condiciones</a></p>
                </div> -->
            </form>
            <p>O si tienes cuenta, <a href="./login.php"><span class="enlace-usuario">inicia sesión</span></a></p>
        </div>
    </main>
</body>
    <script src="../js/app.js"></script>
    <script src="../icons/fontawesome.js"></script>
</html>