<?php 
    session_start();
    
    function verAdmin(){
        // var_dump($_SESSION);
        $admins = array("dcues", "d.monzi", "sergio");
        if (in_array($_SESSION['usuario_validado'], $admins)) {
            echo '<a href="./admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
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
    <title>Mango_Contacto</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="search.html"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../images/logo3.png" alt=""></a></li>
                <li id="last-li">
                    <a href="user.html"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="warning">
            <div id="icon-warning"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div id="txt-warning">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem ex at 
                veniam repellendus, qui ut inventore, labore totam sed quod commodi ullam 
                vel reprehenderit quisquam rerum dolores saepe tenetur doloremque.
                </p>
            </div>
        </div>
        <!-- formulario -->
        <div id="form">
            <form action="" method="">
                <input type="text" id="fusr" placeholder="Nombre de Usuario" required>
                <br>
                <br>
                <input type="email" id="femail" placeholder="Email" required>
                <br>
                <br>
                <select id="" name="">
                    <option readonly>Elegir razón</option>
                    <option>Contiene palabras ofensivas</option>
                    <option>Le odio</option>
                    <option>Malsonante</option>
                </select>
                <br>
                <br>
                <input id="benv" type="submit" value="Enviar">
            </form>
        </div>
    </main>
</body>
<script src="../js/users.js"></script>
<script src="../icons/fontawesome.js"></script>

</html>