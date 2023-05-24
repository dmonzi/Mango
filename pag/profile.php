<?php
    require_once('../theme\database.php');

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

    //session_start();

    function mostrarUsr(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_SESSION['id_usuario_validado'])) {
            $boton = '<a href="../theme/cerrar_sesion.php"><p>Cerrar Sesión</p></a>';
            $id = $_SESSION['id_usuario_validado'];
        }else{
            header("Location: login.php");
        }

        if ($id != -1) {
            // Nombre de usuario
            $sql = "select nombre_usuario, foto_perfil from usuarios where id = ". $id;
            $resultado = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC);
            $nombre = $resultado['nombre_usuario'];
            $foto = $resultado['foto_perfil'];

            // Contar los seguidores y los seguidos
            $sql = "select count(*) from usuario_has_usuario where usuario_seguidor = ". $id;
            $seguidos = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC)['count(*)'];
            
            $sql = "select count(*) from usuario_has_usuario where usuario_seguido = ". $id;
            $seguidores = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC)['count(*)'];

            // Recoger los posts
            $sql = "select * from Usuario_Posts where user_id=".$_SESSION['id_usuario_validado']." order by hora desc";
            $posts = $conexion->query($sql);

            // Imprimir los resultados
            // Cabezera
            echo '<div id="top-usr">
                    <div id="grupo1">
                        <div id=""><img id="fot-usr" src="../images/'.$foto.'" alt=""></div>
                        <div id="nom-usr">'.$nombre.'</div>
                        <div id="cerrar-sesion">'.$boton.'</div>
                        
                    </div>
                    <div id="contador">
                        <div><a href="seguidores.php?acc=2"><p>Seguidores: </p><p>'.$seguidores.'</p></a></div>
                        <div><a href="seguidores.php?acc=1"><p>Seguidos: </p><p>'.$seguidos.'</p></a></div>
                    </div>
                </div>';
                // <div id="bot-seguir"><a href="#">Seguir</a></div>

            // Post
            if ($posts -> rowCount() > 0) {
                // Mostrar tus posts
                while($fila = $posts->fetch(PDO::FETCH_ASSOC)){
                    echo '<div class="globo">
                            <div class="globContent">
                                <div class="fot-txt">
                                    <img class="" src="../images/'.$foto.'" alt="fot_usr">
                                    <div>
                                        <a class="nom" href="./user.php">'.$nombre.'</a>
                                        <p class="txt">'.$fila['contenido'].'</p>
                                        <div class="likes">'.
                                            '<i id="id" class="fa-solid fa-heart heart '.verColor($fila['id']).'" onclick="insertarDatos('.$fila['id'].','.$_SESSION['id_usuario_validado'].',\'../theme/addLike.php\')">'.Database::getLikesPost($fila['id']).
                                            '</i>
                                        </div>
                                    </div>
                                </div>';
                                echo '<div class="ptos">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                    <div class="popUp">
                                        <a href="../theme/eliminarPost.php?id='.$fila['id'].'">
                                            <p>Borrar publicación</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }else{
                //no tienes ningún post
                echo '<div class="globo">
                    <div class="globContent">
                        <div class="fot-txt">
                            <img src="../images/logo.png" alt="fot_usr">
                            <div>
                                <p class="nom">Mango</p>
                                <p class="txt">Aún no tienes ningun post, escribe tu primer post para compartirlo con tus amigos</p>
                                <a href="./upload.php" style="font-size: large; text-decoration:underline;">Escríbelo aquí</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }else {
            header("Location: ./login.php");
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
    <title>Mango</title>
    <link rel="icon" type="image/png" href="../images/logo.png">

</head>
<body>
    <header>
        <?php 
            include('../theme/nav.php')
        ?>
    </header>
    <main>
        <?php 
            mostrarUsr();
        ?>
    </main>
</body>
<script src="../icons/fontawesome.js"></script>
<script src="../js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>