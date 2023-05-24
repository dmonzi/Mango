<?php 
    require_once('../theme\database.php');

    function verSeguidores(){
        return 'select usuarios.nombre_usuario, usuario_has_usuario.usuario_seguidor from usuario_has_usuario inner join usuarios on usuarios.id = usuario_has_usuario.usuario_seguidor where usuario_has_usuario.usuario_seguido='.$_SESSION['id_usuario_validado'];
    }

    function verSeguidos(){
        return 'select usuarios.nombre_usuario, usuario_has_usuario.usuario_seguido from usuario_has_usuario inner join usuarios on usuarios.id = usuario_has_usuario.usuario_seguido where usuario_has_usuario.usuario_seguidor='.$_SESSION['id_usuario_validado'];
    }

    function verTabla(){
        $database = new Database();
        $conexion = $database -> conectar();

        if (isset($_GET['acc'])) {
            $acc = $_GET['acc'];
        }else {
            header("Location: ./profile.php");
        }

        switch ($acc) {
            case 1:
                $resultado =$conexion->query(verSeguidos());
        
                echo '<thead>
                        <td>Seguidos</td>
                    </thead>
                    <tbody>';
                        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td><a href="./user.php?id='.$fila['usuario_seguido'].'">'.$fila['nombre_usuario'].'</a></td></tr>';
                        }
                echo '</tbody>';
                break;

            case 2:
                $resultado =$conexion->query(verSeguidores());
        
                echo '<thead>
                        <td>Seguidores</td>
                    </thead>
                    <tbody>';
                        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td><a href="./user.php?id='.$fila['usuario_seguidor'].'">'.$fila['nombre_usuario'].'</a></td></tr>';
                        }
                echo '</tbody>';
                break;
        }

        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mango</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../images/logo.png">
</head>
<body>
    <header>
        <?php 
            include('../theme/nav.php')
        ?>
    </header>
    <main>
        <div class="seguidores">
            <table>
                <?php 
                    verTabla();
                ?>
            </table>
        </div>
    </main>
</body>
<script src="../icons/fontawesome.js"></script>
<script src="../js/app.js"></script>
</html>