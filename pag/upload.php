<?php
session_start();

/*Añadir el boton del panel de administración*/
function verAdmin(){
    if ($_SESSION['admin']) {
        echo '<a href="./pag/admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
    }
}
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
                <li id="last-li">
                    <a href="user.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="principal">
            <h1>Crea tu nuevo post</h1>
            <form id="contenidoTweet" method="POST" action="../theme/guardarPost.php" enctype="multipart/form-data">
                <textarea name="contenido" cols="100" rows="10" placeholder="Ecribe aquí!" require></textarea>
                <input type="submit" name="publicar" value="Publicar">
                <label for="foto-post">Añadir una imagen: </label>
                <input type="file" id="foto-post" name="foto" accept=".png, .jpeg, .jpg">
            </form>
        </div>
    </main>
</body>
<script src="../js/users.js"></script>
<script src="../icons/fontawesome.js"></script>
</html>