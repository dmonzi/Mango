<?php
    session_start();

    function verAdmin(){
        // var_dump($_SESSION);
        $admins = array("dcues", "d.monzi", "sergio");
        if (in_array($_SESSION['usuario_validado'], $admins)) {
            echo '<a href="../../admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>
   <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../../../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="../../search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../../../images/logo3.png" alt=""></a></li>
                <li id="last-li">
                    <a href="../../user.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <form id="update-main" action="./save.php" method="POST">
            <input placeholder="nombre" type="text" name="nombre">
            <input placeholder="nombre_usuario" type="text" name="nombre_usuario">
            <input placeholder="email" type="text" name="email">
            <input type="submit" name="iniciar">
        </form>
    </main>
</body>
    <script src="./icons/fontawesome.js"></script>
</html>