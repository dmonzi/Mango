<?php 
    require_once('database.php');

    session_start();

    $database = new Database();
    $conexion = $database -> conectar();
    
    $idPost=$_POST['idPost'];
    $idUsuario=$_SESSION['id_usuario_validado'];

    if (Database::vecesLikesUsuarioPost($idUsuario,$idPost)==0) {
        $query="INSERT INTO 13_likes (id, id_usuario, id_post) VALUES (NULL, '".$idUsuario."', '".$idPost."')";
    }else{
        $query="DELETE FROM 13_likes WHERE id_usuario=".$idUsuario." AND id_post=".$idPost;
    }

    var_dump(Database::usuarioHaDadoLike($idUsuario,$idPost));

    var_dump($query);


    $conexion->query($query);
    header("Location: ./addLike.php");

?>