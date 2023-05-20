 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
    <?php
        require_once('../../../theme\database.php');

        if(isset($_POST['iniciar'])){
            $database = new Database();
            $conexion = $database -> conectar();

            $sql = "insert into usuarios (nombre, nombre_usuario, email, passwd) values ('".$_POST['nombre']."', '".$_POST['nombre_usuario']."', '".$_POST['email']."', '".$_POST['contraseña']."')";

            if($conexion->query($sql)){
                header("Location: ./index.php");
            }else{
                echo '<p>Error al insertar el usuario<br></p><a href="./index.php">Volver</a>';
            }
        }
    ?> 
    </main>
</body>
</html>