
<?php 

    function conectar(){
        // $conexion = new mysqli('localhost', 'root', '', 'vehiculos');
        $driver = 'mysql';
        $host = 'localhost';
        $name = 'mango';
        $user = 'root';
        $pass = '';

        $conexion = new PDO($driver.':host='.$host.';dbname='.$name.'', $user, $pass);
        return $conexion;
    }
    
    function sacarCoches(){
        $conexion = conectar();
        $sql = 'select * from coches';
        $resultado = $conexion->query($sql);

        if($resultado != null){
            return $resultado;
        }else{
            return false;
        }
    }

    function mostrarTablabla(){
        $resultado = sacarCoches();

        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
        // while($fila = $resultado->fetch_assoc()){
            echo '<tr><td>'.$fila['id'].
            '</td><td>'.$fila['modelo'].
            '</td><td>'.$fila['marca'].
            '</td><td>'.$fila['precio'].
            '</td></tr>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>