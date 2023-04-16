<?php 
    function conectar(){
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }

    function findPosts(){
        $conexion = conectar();
        $sql = 'select id, usuario_id as usuario, contenido from posts';
        $resultado = $conexion->query($sql);
        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
    }
     
    function mostrarPosts(){
        $conexion = conectar();
        $resultado = findPosts();

        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="globo">
                    <div class="globContent">
                        <div class="fot-txt">
                            <img src="./images/cafe.jpg" alt="fot_usr">
                            <div>
                                <a class="nom" href="#">'.$conexion->query("select nombre_usuario from usuarios where id = ". $fila['usuario'])->fetch(PDO::FETCH_ASSOC)['nombre_usuario'].'</a>
                                <p class="txt">'.$fila['contenido'].'</p>
                            </div>
                        </div>
                        <div class="ptos"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                    </div>
                </div>';
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