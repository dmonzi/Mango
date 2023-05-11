<?php
session_start();
require_once('../theme/database.php');

$database = new Database();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/style-responsive.css">
        <link rel="icon" type="image/png" href="../images/logo.png">
        <title>Mango_upload</title>
    </head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../images/logo3.png" alt=""></a></li>
                <li id="last-li"><a href="user.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="principal">
            <h1>Crea tu nuevo post</h1>
            <form id="contenidoTweet" method="POST">
                <textarea name="contenido" cols="100" rows="10" placeholder="Ecribe aquí!"></textarea>
                <input type="submit" name="publicar" value="Publicar">
                <?php
                        
                    $conexion = $database -> conectar();
                    $query="SELECT id FROM usuarios WHERE nombre_usuario='".$_SESSION['usuario_validado']."'";
                    $resultado=$conexion->query($query);
                    
                    if(isset($_POST['publicar'])){
                        print("INSERT INTO posts 
                        (id, hora, contenido, usuario_id) 
                        VALUES (NULL, CURRENT_TIMESTAMP,".$_POST['contenido'].", ".$_SESSION['usuario_validado'].")");
                    }
                ?>
            </form>
        </div>
    </main>
</body>
<script src="../js/users.js"></script>
<script src="../icons/fontawesome.js"></script>
</html>