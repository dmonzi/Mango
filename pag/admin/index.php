
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/style-responsive.css">
    <title>Mango_Admin</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
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
                <li id="last-li"><a href="../user.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <a class="tarjeta" href="../CRUDs/usuarios/index.php">
                <p>Usuarios</p>
            </a>
            <a class="tarjeta" href="../CRUDs/usuarios_has_usuarios/index.php" style="font-size: 25px;">
                <p>Usuarios_has_Usuarios</p>
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
    <script src="../../js/users.js"></script>
    <script src="../../icons/fontawesome.js"></script>
</html>