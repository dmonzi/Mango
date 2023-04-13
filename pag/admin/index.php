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
        $sql = 'select id, nombre, nombre_usuario, email, foto_perfil from usuarios';
        $resultado = $conexion->query($sql);
        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
    }
     
    function mostrarTabla(){
        $resultado = findUsr();

        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr id="'.$fila['id'].'"><td>'.$fila['id'].
            '</td><td>'.$fila['nombre'].
            '</td><td>'.$fila['nombre_usuario'].
            '</td><td>'.$fila['email'].
            '</td><td>'.$fila['foto_perfil'].
            '</td><td class="action-btn"><div onclick="editContent('.$fila['id'].')"><i class="fa-regular fa-pen-to-square"></i></div>
            <div onclick="viewPorfile('.$fila['id'].')"><i class="fa-solid fa-eye"></i></div>
            <div onclick="deleteUser('.$fila['id'].')"><i class="fa-solid fa-trash-can"></i></div></td></div>';
        }

        echo "</tbody>";
        
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
    <link rel="icon" type="image/png" href="./images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../../index.html"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="../search.html"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../../images/logo3.png" alt=""></a></li>
                <li id="last-li"><a href="../user.html"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="admin-table">
            <table>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Porfile Picture</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    mostrarTabla();
                ?>
            </table>
        </div>
    </main>
</body>
    <script src="../../js/users.js"></script>
    <script src="../../icons/fontawesome.js"></script>
</html>