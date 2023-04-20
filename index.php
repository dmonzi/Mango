<?php 
    session_start();
    // var_dump($_SESSION['usuario_validado']);
    function conectar(){
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }
     
    function mostrarPosts(){
        $conexion = conectar();

        if (isset($_SESSION['usuario_validado'])) {
            $resultado = $conexion->query("select id from usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'")->fetch(PDO::FETCH_ASSOC);
            // print(count($resultado));
            //Valida la cantidad de filas que devuelve la sentencia
            if (count($resultado) > 0) {
                $id = $resultado['id'];
            }else {
                header("Location: pag/login.php");
            }
        }else{
            header("Location: pag/login.php");
        }

        if ($id > 0) {
            
            $resultado = $conexion->query("select * from Usuario_Posts where user_id = (select usuario_seguido from usuario_has_usuario where usuario_seguidor = ".$id.")");
            // var_dump($resultado -> rowCount());
            while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="globo">
                <div class="globContent">
                    <div class="fot-txt">
                        <img src="./images/cafe.jpg" alt="fot_usr">
                        <div>
                            <a class="nom" href="/pag/user?id='.$fila['id'].'">'.$fila['nombre'].'</a>
                            <p class="txt">'.$fila['contenido'].'</p>
                        </div>
                    </div>
                    <div class="ptos"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                </div>
            </div>';
            }
            
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
                    <div><a href="index.html"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="./pag/search.html"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="./images/logo3.png" alt=""></a></li>
                <li id="last-li"><a href="./pag/user.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
            mostrarPosts();
        ?>

        <a href="upload.html">
        <!-- <a href="upload.html"> -->
            <div id="plus"><img src="./images/plus.png"></div>
        </a>
    </main>
</body>
<script src="js/app.js"></script>
<script src="js/users.js"></script>

</html>