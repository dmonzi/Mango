<?php 
    require_once('../theme/database.php');

    session_start();

    $database = new Database();
    $conexion = $database -> conectar();
    $id = $_GET['id'];

    $resultado = $conexion->query("select id from usuarios where nombre_usuario='".$_SESSION['usuario_validado']."'")->fetch(PDO::FETCH_ASSOC)['id'];
    
    $query="INSERT INTO likes (id, id_usuario, id_post) VALUES (NULL, '2', '1')";

    $conexion->query('insert into usuario_has_usuario (usuario_seguidor, usuario_seguido) values ('.$resultado.', '.$id.')');
    header("Location: ../pag/user.php?id=".$id);

?>