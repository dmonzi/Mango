<?php 
    session_start();
    require_once('./database.php');

    $database = new Database();            
    $conexion = $database -> conectar();

    $archivo = $_FILES['foto'];
    $tipo = $archivo['type'];
    
    // Guardar la direccion de la imagen en la base de datos
    if ($archivo != NULL) { //Ver si hay un archivo en el input
        if($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/gif"){

            $ruta = '../images/'.$archivo['name'];

            move_uploaded_file($archivo['tmp_name'], $ruta);
            
        }else{
            header("Refresh: 5; URL=../pag/upload.php");
            echo "<h1>Sube una imagen con un formato correcto, por favor...</h1>";
        }
    }

    if(isset($_POST['publicar'])){
        $query="INSERT INTO posts (id, hora, contenido, usuario_id, ruta_foto) VALUES (NULL, CURRENT_TIMESTAMP,'".$_POST['contenido']."', ".$_SESSION['id_usuario_validado'].", '".$ruta."')";
        //lo tengo que almacenar en una variable para poder usar el row count
        $resultadoQuery=$conexion->query($query);
        //Evaluo cuantas filas han sido afectadas con ese insert
        if($resultadoQuery->rowCount()>0){
            header("Location: ../pag/user.php");
        }   
    }
    
?>