<?php
    session_start();
    require_once('../../../theme\database.php');

    function deletePosts(){
        $database = new Database();
        $conexion = $database -> conectar();

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "delete from posts where id = ". $id;

            if($conexion->query($sql)){
                echo '<p>Post elimniado con éxito<br></p><a href="./index.php">Volver</a>';
                header("Location: ./index.php");
            }
        }else {
            echo '<p style="color:red;">ERROR: No hay ningún post seleccionado</p><a href="./index.php">Volver</a>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="stylesheet" href="../../../css/style-responsive.css">
    <title>Mango_Admin_Delete_Posts</title>
    <link rel="icon" type="image/png" href="../../../images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../../../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="../../search.html"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../../../images/logo3.png" alt=""></a></li>
                <li id="last-li"><a href="../../user.html"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="admin_delete">
            <?php
                deletePosts();
            ?>
        </div>
    </main>
</body>
    <script src="../../../js/users.js"></script>
    <script src="../../../icons/fontawesome.js"></script>
</html>