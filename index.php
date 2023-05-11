<?php 

    // include("./theme/database.php");
    require_once('theme\database.php');

    session_start();
    // var_dump($_SESSION['usuario_validado']);
     
    function mostrarPosts(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_SESSION['usuario_validado'])) {
            $resultado = $conexion->query("select id from usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'");
            // print(count($resultado));
            //Valida la cantidad de filas que devuelve la sentencia
            if ($resultado -> rowCount() > 0) {
                $id = $resultado->fetch(PDO::FETCH_ASSOC)['id'];
            }else {
                header("Location: pag/login.php");
            }
        }else{
            header("Location: pag/login.php");
        }

        if ($id > 0) {
            
            $resultado = $conexion->query("select * from Usuario_Posts where user_id in (select usuario_seguido from usuario_has_usuario where usuario_seguidor = ".$id.")");
            // var_dump($resultado -> rowCount());
            while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                // var_dump($fila);
                echo '<div class="globo">
                <div class="globContent">
                    <div class="fot-txt">
                        <img src="./images/'.$conexion->query("select foto_perfil from usuarios where id='".$fila['user_id']."'")->fetch(PDO::FETCH_ASSOC)['foto_perfil'].'" alt="fot_usr">
                        <div>
                            <a class="nom" href="./pag/user.php?id='.$fila['user_id'].'">'.$fila['nombre'].'</a>
                            <p class="txt">'.$fila['contenido'].'</p>
                        </div>
                    </div>
                    <div class="ptos"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                </div>
            </div>';
            }
            
        }
        
    }

    function verAdmin(){
        // var_dump($_SESSION);
        $admins = array("dcues", "d.monzi", "sergio");
        if (in_array($_SESSION['usuario_validado'], $admins)) {
            echo '<a href="./pag/admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="icons/fontawesome.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/style-responsive.css">
    <title>Mango</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
</head>

<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="./pag/search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="./images/logo3.png" alt=""></a></li>
                <li id="last-li">
                    <a href="./pag/user.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
            mostrarPosts();
        ?>

        <a href="./pag/upload.php">
            <div id="plus"><img src="./images/plus.png"></div>
        </a>
    </main>
</body>
<script src="js/app.js"></script>
<script src="js/users.js"></script>

</html>