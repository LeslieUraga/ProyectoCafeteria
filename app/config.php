<?php 
// Se declaran las variables globales para la conexión al servidor y BD
define('SERVIDOR', 'localhost');
define('PUERTO', '5432'); 
define('USUARIO', 'postgres');
define('PASSWORD', 'root');
define('BD', 'cafeteria');

// Se crea la cadena de conexión
$servidor = "pgsql:host=".SERVIDOR.";port=".PUERTO.";dbname=".BD;

try {
    // Instancia PDO para acceder a la BD
    // PostgreSQL no requiere el ajuste de `PDO::MYSQL_ATTR_INIT_COMMAND`
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // Mensaje de conexión
    // echo "Conexión exitosa";
} catch (PDOException $ex) {
    // Se muestra información detallada del error
    print_r($ex);
    echo "Error al conectar con la base de datos";
}

$URL = "http://localhost/cafeteria";
?>
