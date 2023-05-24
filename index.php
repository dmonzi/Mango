<?php

    ob_start();

    require_once('theme\database.php');

    session_start();

    function mostrarPosts(){
        $database=new Database();
        $conexion=$database->conectar();

        if (isset($_SESSION['id_usuario_validado'])){
            $id=$_SESSION['id_usuario_validado'];
        }else{header("Location: pag/login.php");}

        if (isset($id)){
            
            $resultado = $conexion->query("select * from Usuario_Posts where user_id in (select usuario_seguido from usuario_has_usuario where usuario_seguidor = ".$id.") order by hora desc");
            // var_dump($resultado -> rowCount());
            
            if ($resultado -> rowCount() > 0) {
                while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                    // var_dump($fila);
                    echo '<div class="globo">
                    <div class="globContent">
                        <div class="fot-txt">
                            <img src="./images/'.$conexion->query("select foto_perfil from usuarios where id='".$fila['user_id']."'")->fetch(PDO::FETCH_ASSOC)['foto_perfil'].'" alt="fot_usr">
                            <div>
                                <a class="nom" href="./pag/user.php?id='.$fila['user_id'].'">'.$fila['nombre'].'</a>
                                <p class="txt">'.$fila['contenido'].'</p>
                                <div class="likes">'.
                                    '<i id="id" class="fa-solid fa-heart heart '.verColor($fila['id']).'" onclick="insertarDatos('.$fila['id'].','.$_SESSION['id_usuario_validado'].',\'./theme/addLike.php\')">'.Database::getLikesPost($fila['id']).
                                    '</i>
                                </div>
                            </div>
                        </div>
                        <div class="ptos">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                            <div class="popUp">
                                <a href="./theme/eliminarSeguidor.php?id='.$fila['user_id'].'&loc=index.php">
                                    <p>Dejar de seguir a '.$fila['nombre'].'</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }else {
                echo '<div class="globo">
                    <div class="globContent">
                        <div class="fot-txt">
                            <img src="./images/logo.png" alt="fot_usr">
                            <div>
                                <p class="nom">Mango</p>
                                <p class="txt">Aún no sigues a nadie, sigue a alguien para ver sus posts</p>
                                <a href="./pag/search.php" style="font-size: large; text-decoration:underline;">Buscar amigos</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            
            
        }
        
    }

    /*Añadir el boton de admin si el usuario se encuentra en la tabla de administradores*/
    function guardarAdmin(){
        $database = new Database();
        $conexion = $database -> conectar();
        $_SESSION['admin'] = false;

        // var_dump($_SESSION);
        $admins = $conexion->query("select usuario_id from admins");

        while($fila = $admins->fetch(PDO::FETCH_ASSOC)){
            // var_dump($fila);
            if ($_SESSION['id_usuario_validado'] == $fila['usuario_id']) {
                $_SESSION['admin'] = true;
            }
        }
    }

    function verColor($postId){
        $database = new Database();
        $conexion = $database -> conectar();
        
        $resultado = $conexion->query("select count(*) from likes where id_usuario=".$_SESSION['id_usuario_validado']." && id_post=".$postId)->fetch(PDO::FETCH_ASSOC)['count(*)'];

        if (Database::usuarioHaDadoLike($_SESSION['id_usuario_validado'],$postId)) {
            return "heart-red";
        }else{
            return "heart-black";
        }

    }

    /*Añadir el boton del panel de administración*/
    function verAdmin(){
        guardarAdmin();

        if ($_SESSION['admin']) {
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
                    <a id="menu" onclick="mostrarMenu()"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="./pag/profile.php"><i class="fas fa-user"></i> Ver perfil</a>
                        <a class="dropdown-item" href="./pag/settings.php"><i class="fas fa-cog"></i> Ajustes</a>
                        <a class="dropdown-item" href="./theme/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>