<?php 
    function conectar(){
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }

    function findUsr(){
        $conexion = conectar();
        $sql = 'select * from usuario_has_usuario';
        $resultado = $conexion->query($sql);
        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
    }
     
    function mostrarTabla(){
        $conexion = conectar();
        $resultado = findUsr();

        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr id="'.$fila['id'].'"><td>'.$fila['id'].
            '</td><td>'.$conexion->query("select nombre_usuario from usuarios where id = ".$fila['usuario_seguidor'])->fetch(PDO::FETCH_ASSOC)['nombre_usuario'].
            '</td><td>'.$conexion->query("select nombre_usuario from usuarios where id = ".$fila['usuario_seguido'])->fetch(PDO::FETCH_ASSOC)['nombre_usuario'].
            '</td><td class="action-btn">
            <a onclick="editContent('.$fila['id'].')"><i class="fa-regular fa-pen-to-square"></i></a>
            <a href="../../user.php?id='.$fila['usuario_seguido'].'"><i class="fa-solid fa-eye"></i></a>
            <a href="./delete.php?id='.$fila['id'].'"><i class="fa-solid fa-trash-can"></i></a></td></div>';
        }

        echo "</tbody>";
        
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
    <title>Mango_Admin_Usuario_has_Usuario</title>
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
        <div id="admin-table">
            <table>
                <tr>
                    <th>id</th>
                    <th>Seguidor</th>
                    <th>Seguido</th>
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