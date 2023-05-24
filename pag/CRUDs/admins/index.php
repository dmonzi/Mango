<?php 
    session_start();
    require_once('../../../theme\database.php');

    function findPosts(){
        $database = new Database();
        $conexion = $database -> conectar();
        $sql = "select admins.id, usuarios.nombre from admins inner join usuarios where usuarios.id = admins.usuario_id";
        $resultado = $conexion->query($sql);
        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
    }
     
    function mostrarTabla(){
        $database = new Database();
        $conexion = $database -> conectar();
        $resultado = findPosts();

        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){

            echo '<tr id="'.$fila['id'].'"><td>'.$fila['id'].
            '</td><td>'.$fila['nombre'].
            '</td><td class="action-btn">
            <a href="./delete.php?id='.$fila['id'].'"><i class="fa-solid fa-trash-can"></i></a></td></div>';
        }

        echo "</tbody>";
        
    }

    /*Añadir el boton del panel de administración*/
    function verAdmin(){
        if ($_SESSION['admin']) {
            echo '<a href="../../../pag/admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="stylesheet" href="../../../css/style-responsive.css">
    <title>Mango_Admin_admins</title>
    <link rel="icon" type="image/png" href="../../../images/logo.png">
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
        <div id="admin-table">
            <table id="tablaAdmins">
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    mostrarTabla();
                ?>
            </table>
        </div>
        
        <a href="./create.php">
            <div id="plus"><img src="../../../images/plus.png"></div>
        </a>
    </main>
</body>
    <script src="../../../js/users.js"></script>
    <script src="../../../icons/fontawesome.js"></script>
</html>