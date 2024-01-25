<?php 
    require_once('../theme/database.php');
    //session_start();

    function usuario(){
        $database = new Database();
        $conexion = $database -> conectar();

        $resultado = $conexion->query('select * from 13_usuarios where id="'.$_SESSION['id_usuario_validado'].'"')->fetch(PDO::FETCH_ASSOC);

        echo '<input autocomplete="off" type="text" name="nombre" placeholder="Nombre" value="'.$resultado['nombre'].'">
                <input autocomplete="off" type="text" name="nom_usr" placeholder="Nombre Usuario" value="'.$resultado['nombre_usuario'].'">
                <input autocomplete="off" type="text" name="email" placeholder="Email" value="'.$resultado['email'].'">';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../images/logo.png">
</head>
<body>
    <header>
        <!-- nav insertado con php -->
        <?php 
            include('../theme/nav.php')
        ?>
    </header>
    <main>
        <div class="ajustes">
            <h1>Ajustes</h1>
            <div class="ajustes-usr">
                <!-- Cambiar atributos de tu cuenta de usuario -->
                <details>
                    <form action="../theme/ajustes.php?act=1" method="post">
                        <?php 
                            usuario();
                        ?>
                        <input type="submit" name="Guardar">
                    </form>
                    <summary>Editar perfil</summary>
                </details>
                <!-- Cambiar contraseña de tu cuenta de usuario -->
                <details>
                    <form action="../theme/ajustes.php?act=2" method="post">
                        <input autocomplete="off" type="password" name="old_pass" placeholder="Contraseña actual" required>
                        <input autocomplete="off" class="cntr" type="text" name="new_pass" placeholder="Contraseña nueva" required onkeyup="validarContraseña()">
                        <input autocomplete="off" type="text" name="rep_pass" placeholder="Repetir contraseña" required>
                        <span id="alertPasswd"></span>
                        <input type="submit" name="Guardar">
                    </form>
                    <summary>Editar contraseña</summary>
                </details>
                <!-- Cambiar foto de perfil -->
                <details>
                    <!-- <h4>En mantenimiento</h4> -->
                    <form action="../theme/ajustes.php?act=3" method="post" enctype="multipart/form-data">
                    <input type="file" id="foto-post" name="foto" accept=".png, .jpeg, .jpg">
                        <input type="submit" name="Guardar">
                    </form>
                    <summary>Editar foto de perfil</summary> 
                </details>
            </div>
        </div>
    </main>
</body>
<script src="../js/app.js"></script>
<script src="../icons/fontawesome.js"></script>
</html>