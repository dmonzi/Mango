<?php
    require_once('../theme/database.php');

    function verColor($postId){
        $database = new Database();
        $conexion = $database -> conectar();
        
        $resultado = $conexion->query("select count(*) from 13_likes where id_usuario=".$_SESSION['id_usuario_validado']." && id_post=".$postId)->fetch(PDO::FETCH_ASSOC)['count(*)'];

        if (Database::usuarioHaDadoLike($_SESSION['id_usuario_validado'],$postId)) {
            return "heart-red";
        }else{
            return "heart-black";
        }

    }

    function mostrarUsr(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //Añadir el boton de seguir
            // Ver si sigues al usuario
            $resultado = $conexion->query('select count(*) from 13_usuario_has_usuario where usuario_seguidor='.$_SESSION['id_usuario_validado'].' && usuario_seguido='. $id)->fetch(PDO::FETCH_ASSOC)['count(*)'];

            if ($resultado == 0) {
                //no le sigues
                $boton = '<a href="../theme/addSeguidor.php?id='.$id.'"><p>Seguir</p></a>';
            }else{
                // le sigues
                $boton = '<a href="../theme/eliminarSeguidor.php?id='.$id.'&loc=pag/user.php?id='.$id.'"><p>Dejar de Seguir</p></a>';
            }
            
        }else if (isset($_SESSION['id_usuario_validado'])) {
            $id = $_SESSION['id_usuario_validado']; 
            $boton = '';
        }else{
            header("Location: login.php");
        }

        if ($id != -1) {
            // Nombre de usuario
            $sql = "select nombre_usuario, foto_perfil from 13_usuarios where id = ". $id;
            $resultado = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC);
            $nombre = $resultado['nombre_usuario'];
            $foto = $resultado['foto_perfil'];

            // Contar los seguidores y los seguidos
            $sql = "select count(*) from 13_usuario_has_usuario where usuario_seguidor = ". $id;
            $seguidos = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC)['count(*)'];
            
            $sql = "select count(*) from 13_usuario_has_usuario where usuario_seguido = ". $id;
            $seguidores = $conexion->query($sql)->fetch(PDO::FETCH_ASSOC)['count(*)'];

            // Recoger los posts
            $sql = "select * from 13_Usuario_posts where user_id=".$id." order by hora desc";
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
                        <div><p>Seguidores: </p><p>'.$seguidores.'</p></div>
                        <div><p>Seguidos: </p><p>'.$seguidos.'</p></div>
                    </div>
                </div>';
                // <div id="bot-seguir"><a href="#">Seguir</a></div>

            // Post
            if ($posts -> rowCount() > 0) {
                while($fila = $posts->fetch(PDO::FETCH_ASSOC)){
                    echo '<div class="globo">
                            <div class="globContent">
                                <div class="fot-txt">
                                    <img class="" src="../images/'.$foto.'" alt="fot_usr">
                                    <div>
                                        <a class="nom" href="./user.php">'.$nombre.'</a>
                                        <p class="txt">'.$fila['contenido'].'</p>
                                        <div class="likes">'.
                                            '<i class="fa-solid fa-heart heart '.verColor($fila['id']).'" onclick="insertarDatos('.$fila['id'].','.$_SESSION['id_usuario_validado'].',\'../theme/addLike.php\')">'.Database::getLikesPost($fila['id']).
                                            '</i>
                                        </div>
                                    </div>
                                </div>';
                                echo '
                            </div>
                        </div>';
                }
            }else if (!isset($_GET['id'])){
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
            }else if(true){
                //para validar si entras a tu propia página de usuario, que te lleve al profile.php
            }else {
                echo '<div class="globo">
                    <div class="globContent">
                        <div class="fot-txt">
                            <img src="../images/logo.png" alt="fot_usr">
                            <div>
                                <p class="nom">Mango</p>
                                <p class="txt">Aún no tiene ningun post</p>
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
<html lang="esp">

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