<?php
    require_once('../theme/database.php');
    session_start();
    
    $database = new Database();
    $conexion = $database -> conectar();

    switch ($_GET['act']) {
        case 1:
            # usuario
            $conexion->query('update 13_usuarios set nombre="'.$_POST['nombre'].'", nombre_usuario="'.$_POST['nom_usr'].'", email="'.$_POST['email'].'" where id='.$_SESSION['id_usuario_validado']);

            header("Location: ../pag/settings.php");

            break;
        
        case 2:
            # contraseña
            $contraseñaBD = $conexion->query('select passwd from 13_usuarios where id='.$_SESSION['id_usuario_validado'])->fetch(PDO::FETCH_ASSOC)['passwd'];
            if (password_verify($_POST['old_pass'],$contraseñaBD)) {
                if ($_POST['new_pass'] == $_POST['rep_pass']) {
                    $newPass = password_hash($_POST['new_pass'],PASSWORD_DEFAULT);
                    $conexion->query('update 13_usuarios set passwd="'.$newPass.'" where id='.$_SESSION['id_usuario_validado']);
                    header("Location: ../pag/settings.php");
                }else {
                    echo 'Las nuevas contraseñas no coinciden';
                    header("Refresh: 5; URL=../pag/settings.php");
                }
            }else {
                echo 'La contraseña no es la misma que la existente';
                header("Refresh: 5; URL=../pag/settings.php");
            }
            break;
        
        case 3:
            # foto perfil
            $archivo = $_FILES['foto'];
            $tipo = $archivo['type'];

            if($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png"){
                
                $ruta = '../images/'.$archivo['name'];
                
                move_uploaded_file($archivo['tmp_name'], $ruta);
                
                $query='update 13_usuarios set foto_perfil="'.$archivo['name'].'" where id='.$_SESSION['id_usuario_validado'];
                // print $query;
                $conexion->query($query);
                
                header("Location: ../pag/settings.php");
                
            }else{
                header("Refresh: 5; URL=../pag/settings.php");
                echo "<h1>Sube una imagen con un formato correcto, por favor...</h1>";
            }
            break;
    }

?>