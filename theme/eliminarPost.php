<?php 
    require_once('../theme/database.php');

    session_start();

    $database = new Database();
    $conexion = $database -> conectar();
    $id = $_GET['id'];
    
    //Ejecutamos la query de borrar de la tabla usuario_has_usuario
    $query="DELETE FROM 13_posts WHERE id=".$id;
    //print $query;
    $conexion->query($query);
    header("Location: ../pag/profile.php");

?>