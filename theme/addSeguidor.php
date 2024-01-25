<?php 
    require_once('../theme/database.php');

    session_start();

    $database = new Database();
    $conexion = $database -> conectar();
    $id = $_GET['id'];

    $resultado = $conexion->query("select id from 13_usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'")->fetch(PDO::FETCH_ASSOC)['id'];
    
    $conexion->query('insert into 13_usuario_has_usuario (usuario_seguidor, usuario_seguido) values ('.$resultado.', '.$id.')');
    header("Location: ../pag/user.php?id=".$id);

?>