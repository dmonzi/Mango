<?php 
    session_start();
    require_once('../../../theme\database.php');

    function crearForm(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "select * from 13_posts where id = ".$id;
            $resultado = $conexion -> query($sql);
            if ($resultado) {
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo '<form id="update-main" action="./update.php?id='.$id.'" method="POST">
                    <input placeholder="hora" type="text" name="hora" value="'.$fila['hora'].'">
                    <input placeholder="contenido" type="text" name="contenido" value="'.$fila['contenido'].'">
                    <input placeholder="usuario_id" type="text" name="usuario_id" value="'.$fila['usuario_id'].'">
                    <input type="submit" name="iniciar">
                    </form>';
                }
                
            }
        }

    }
    
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
    <title>Edit</title>
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
                    <a href="../../profile.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
            crearForm();
        ?>
    </main>
</body>
    <script src="../../../icons/fontawesome.js"></script>
</html>