<?php 
    require_once('../theme/database.php');

    session_start();

    $database = new Database();
    $conexion = $database -> conectar();
    $id = $_GET['id'];
    $location = $_GET['loc'];

    //Recogemos el id del usuario validado
    $resultado = $conexion->query("select id from usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'")->fetch(PDO::FETCH_ASSOC)['id'];
    
    //Ejecutamos la query de borrar de la tabla usuario_has_usuario
    $query="delete from usuario_has_usuario WHERE usuario_seguidor=".$resultado." AND usuario_seguido=".$id;
    //print $query;
    $conexion->query($query);
    header("Location: ../$location");

?>