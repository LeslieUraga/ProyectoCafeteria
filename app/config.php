<?php 
//Se declaran las variables globales para la conexion a servidor y BD
define('SERVIDOR', 'localhost');
define('PUERTO', '3308'); 
define('USUARIO','root');
define('PASSWORD','root');
define('BD','cafeteria');

//Se crea la cadena de conexion 
$servidor = "mysql:dbname=".BD.";host=".SERVIDOR.";port=".PUERTO; // Añadimos el puerto a la cadena

try {
    //Instancia PDO para acceder a la BD
    //La cual recibe 4 argumentos
    /*Se asegura que los caracteres se manejen con
     codificación utf8*/
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //Mensaje de conexion
    //echo "Successfull";
} catch (PDOException $ex) {
    //Se muestra informacion detallada del error
    print_r($ex);
    echo "Error al conectar con la base de datos";
}

$URL = "http://localhost/cafeteria";
?>
