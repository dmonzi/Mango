<?php 
    session_start();

    /*Añadir el boton del panel de administración*/
    function verAdmin(){
        if (isset($_SESSION['id_usuario_validado'])) {
            if ($_SESSION['admin']) {
                echo '<a href="index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>pepep';
            }
        }else{
            header("Location: ../login.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/style-responsive.css">
    <title>Mango_Admin</title>
    <link rel="icon" type="image/png" href="../../images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="../search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../../images/logo3.png" alt=""></a></li>
                <li id="last-li" class="user-profile">
                    <a id="menu" onclick="mostrarMenu()"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="top: 7%;">
                        <a class="dropdown-item" href="../profile.php"><i class="fas fa-user"></i> Ver perfil</a>
                        <a class="dropdown-item" href="../settings.php"><i class="fas fa-cog"></i> Ajustes</a>
                        <a class="dropdown-item" href="../../theme/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <a class="tarjeta" href="../CRUDs/usuarios/index.php">
                <p>Usuarios</p>
            </a>
            <a class="tarjeta" href="../CRUDs/posts/index.php">
                <p>Posts</p>
            </a>
            <a class="tarjeta" href="../CRUDs/admins/index.php">
                <p>Admins</p>
            </a>
        </div>
    </main>
</body>
    <script src="../../js/app.js"></script>
    <script src="../../icons/fontawesome.js"></script>
</html>