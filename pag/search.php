<?php 
    session_start();
    require_once('../theme/database.php');

    /*Añadir el boton del panel de administración*/
    function verAdmin(){
        if ($_SESSION['admin']) {
            echo '<a href="./admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
        }
    }

    function mostrarBusquedas(){
        $database = new Database();
        $conexion = $database -> conectar();

        $resultado = $conexion->query('select id, nombre_usuario from usuarios');

        if ($resultado->rowCount() > 0) {
            while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                if ($_SESSION['id_usuario_validado'] == $fila['id']) {
                    echo '<a class="busqueda" href="./user.php">
                        <p>'.$fila['nombre_usuario'].'</p>
                    </a>';
                }else{
                    echo '<a class="busqueda" href="./user.php?id='.$fila['id'].'">
                        <p>'.$fila['nombre_usuario'].'</p>
                    </a>';
                }
                
            }
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
    <title>Mango</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../images/logo3.png" alt=""></a></li>
                <li id="last-li">
                    <a href="user.php"><i class="fa-solid fa-user"></i></a>
                    <?php 
                        verAdmin();
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="form-search">
            <form>
                <label>
                    <input id="buscador" type="text" name="titulo" placeholder="Buscar..." onkeyup="filtro()">
                    <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </label>
            </form>
            <?php 
                mostrarBusquedas();
            ?>
        </div>
    </main>
</body>
<script src="../js/app.js"></script>
<script src="../js/search.js"></script>
<script src="../icons/fontawesome.js"></script>

</html>