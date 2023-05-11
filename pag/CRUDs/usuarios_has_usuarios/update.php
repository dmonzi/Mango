 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <?php
            session_start();
            require_once('../../../theme\database.php');

            if(isset($_POST['iniciar'])){
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $database = new Database();
                    $conexion = $database -> conectar();

                    $sql = "update usuarios set nombre='".$_POST['nombre']."', nombre_usuario='".$_POST['nombre_usuario']."', email='".$_POST['email']."', foto_perfil='".$_POST['foto_perfil']."' where id=".$id;

                    if($conexion->query($sql)){
                        header("Location: ./index.php");
                    }else{
                        echo '<p>Error al modificar la relación<br></p><a href="./index.php">Volver</a>';
                    }
                }
            }
        ?> 
    </main>
</body>
</html>