<?php 
    session_start();
    require_once('../../../theme\database.php');

    function findPosts(){
        $database = new Database();
        $conexion = $database -> conectar();
        $sql = 'select * from posts';
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

            $nom_usr = $conexion->query("select nombre_usuario from usuarios where id = ".$fila['usuario_id'])->fetch(PDO::FETCH_ASSOC);

            echo '<tr id="'.$fila['id'].'"><td>'.$fila['id'].
            '</td><td>'.$fila['hora'].
            '</td><td>'.$fila['contenido'].
            '</td><td>'.$nom_usr['nombre_usuario'] .
            '</td><td class="action-btn">
            <a onclick="editContent('.$fila['id'].')"><i class="fa-regular fa-pen-to-square"></i></a>
            <a href="../../user.php?id='.$fila['usuario_id'].'"><i class="fa-solid fa-eye"></i></a>
            <a href="./delete.php?id='.$fila['id'].'"><i class="fa-solid fa-trash-can"></i></a></td></div>';
        }

        echo "</tbody>";
        
    }

    function verAdmin(){
        // var_dump($_SESSION);
        $admins = array("dcues", "d.monzi", "sergio");
        if (in_array($_SESSION['usuario_validado'], $admins)) {
            echo '<a href="../../admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
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
    <title>Mango_Admin_Posts</title>
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
                    <a href="../../user.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="admin-table">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Hora</th>
                    <th>Contenido</th>
                    <th>Usuario</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    mostrarTabla();
                ?>
            </table>
        </div>
    </main>
</body>
    <script src="../../../js/users.js"></script>
    <script src="../../../icons/fontawesome.js"></script>
</html>