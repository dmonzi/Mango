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

        public function getNumRows($sql){
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

        public function getLikesPost($idPost){
            $numLikes=0;

            $sql="SELECT COUNT(*) FROM likes WHERE id_post=".$idPost." GROUP BY id_post";

            print $sql;

            $resultado = self::conectar()->query($sql)->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
        }
    }
?>