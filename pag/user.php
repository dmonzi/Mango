<?php
    session_start();

    function conectar(){
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }

    function mostrarUsr(){
        $conexion = conectar();

        if (isset($_SESSION['usuario_validado'])) {
            $resultado = $conexion->query("select id from usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'")->fetch(PDO::FETCH_ASSOC);
            // print($resultado);
            if ($resultado > 0) {
                $id = $resultado['id'];
            }else {
                $id = -1;
            }
        }else{
            header("Location: ./pag/login.php");
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
            $sql = "select contenido from posts where usuario_id = ". $id;
            $posts = $conexion->query($sql);

            // Imprimir los resultados
            // Cabezera
            echo '<div id="top-usr">
                    <div id="grupo1">
                        <div id=""><img id="fot-usr" src="../images/'.$foto.'" alt=""></div>
                        <div id="nom-usr">'.$nombre.'</div>
                        <div id="cerrar-sesion"><a href="../theme/cerrar_sesion.php"><p>Cerrar Sesión</p></a></div>
                        
                    </div>
                    <div id="contador">
                        <div><p>Seguidores: </p><p>'.$seguidores.'</p></div>
                        <div><p>Seguidos: </p><p>'.$seguidos.'</p></div>
                    </div>
                </div>';
                // <div id="bot-seguir"><a href="#">Seguir</a></div>

            // Post
            while($fila = $posts->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="globo">
                        <div class="globContent">
                            <div class="fot-txt">
                                <img src="../images/'.$foto.'" alt="fot_usr">
                                <div>
                                    <a class="nom" href="./user.php?id='.$id.'">'.$nombre.'</a>
                                    <p class="txt">'.$fila['contenido'].'</p>
                                </div>
                            </div>
                            <div class="ptos"><i class="fa-solid fa-ellipsis-vertical"></i></div>
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
    <title>Mango_User</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="../search.html"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../images/logo3.png" alt=""></a></li>
                <li id="last-li"><a href="./user.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
            mostrarUsr();
        ?>
    </main>
</body>
<script src="../icons/fontawesome.js"></script>
<script src="../js/app.js"></script>
<script src="../js/users.js"></script>

</html>