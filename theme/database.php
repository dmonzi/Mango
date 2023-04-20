<?php

    class Database{
        public function conectar(){
                $driver="mysql";
                $host="localhost";
                $port="3306";
                $bd="practicaordenadores";
                $user="root";
                $password="";

                $dsn="$driver:dbname=$bd;host=$host;port=$port";

                try {
                $conexion=new PDO($dsn, $user, $password);
                echo 'Conectado correctamente';
                } catch (PDOException $e) {
                    echo 'Falló la conexión ' . $e->getMessage();
                }

                return $conexion;
        }

        public function getNumRows($sql){
            $resultado=self::conectar()->query($sql);
            $numRows=$resultado->rowCount();
            return $numRows;
        }
    }
?>