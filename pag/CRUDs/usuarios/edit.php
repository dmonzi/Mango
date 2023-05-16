<?php 
    session_start();
    require_once('../../../theme\database.php');

    function crearForm(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "select * from usuarios where id = ".$id;
            $resultado = $conexion -> query($sql);
            if ($resultado) {
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo '<form id="update-main" action="./update.php?id='.$id.'" method="POST">
                    <input placeholder="nombre" type="text" name="nombre" value="'.$fila['nombre'].'">
                    <input placeholder="nombre_usuario" type="text" name="nombre_usuario" value="'.$fila['nombre_usuario'].'">
                    <input placeholder="email" type="text" name="email" value="'.$fila['email'].'">
                    <input placeholder="foto_perfil" type="text" name="foto_perfil" value="'.$fila['foto_perfil'].'">
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
                    <a href="../../user.php"><i class="fa-solid fa-user"></i></a>
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