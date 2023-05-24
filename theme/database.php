<?php

    class Database{
        public static function conectar(){
            $driver="mysql";
            $host="localhost";
            $port="3306";
            $bd="mango";
            $user="root";
            $password="";
            $dsn="$driver:dbname=$bd;host=$host;port=$port";

            try {
                $conexion=new PDO($dsn, $user, $password);
                // echo 'Conectado correctamente';
            } catch (PDOException $e) {
                echo 'Falló la conexión ' . $e->getMessage();
            }

            return $conexion;
        }

    // public function conectar(){
    //     $driver = 'mysql';
    //     $host = 'localhost';
    //     $name = 'mango';
    //     $user = 'root';
    //     $pass = '';

    //     $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
    //     return $conexion;
    // }

        public static function getNumRows($sql){
            $resultado=self::conectar()->query($sql);
            $numRows=$resultado->rowCount();
            return $numRows;
        }

        public function followUser($idSeguidor, $idSeguido){
            try {
                $conexion=Database::conectar();
                $conexion->query('insert into usuario_has_usuario (usuario_seguidor, usuario_seguido) values ('.$idSeguidor.', '.$idSeguido.')');
            } catch (PDOException $e) {
                echo 'Falló la conexión ' . $e->getMessage();
            }
        }

        public static function getLikesPost($idPost){
            $numLikes=0;

            //$sql="SELECT COUNT(*) FROM likes WHERE id_post=".$idPost." GROUP BY id_post";
            $sql="SELECT * FROM likes WHERE id_post=".$idPost;

            $resultado = self::conectar()->query($sql)->rowCount();

            return $resultado;

            //return $numLikes;
        }

        public static function usuarioHaDadoLike($idUsuario, $idPost){

            $hasLike=false;

            $query="SELECT COUNT(*) FROM likes WHERE id_usuario=".$idUsuario." AND id_post=".$idPost;

            $like = Database::conectar()->query($query)->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];

            //$resultado = Database::conectar()->query($query);
            if($like>0){
                $hasLike=true;
            }else{
                $hasLike=false;
            }
            return $hasLike;
            
        }

        public static function vecesLikesUsuarioPost($idUsuario,$idPost){

            $query="SELECT COUNT(*) FROM likes WHERE id_usuario=".$idUsuario." AND id_post=".$idPost;

            $resultado=Database::conectar()->query($query)->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];

            return $resultado;

        }

        public static function verFotoPost($idPost){

            $query="select ruta_foto from posts where id = ".$idPost;
            
            $resultado = Database::conectar()->query($query)->fetch(PDO::FETCH_ASSOC)['ruta_foto'];
       
            if($resultado != null){
                return '<div class="foto-post"><img src="../images/'.$resultado.'"></div>';
            }
        }

    }
?>