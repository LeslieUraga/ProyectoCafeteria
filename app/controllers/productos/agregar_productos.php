<?php
include("../../config.php");
session_start(); 

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$foto = $_POST['foto'];

// Verificar que las variables requeridas no estén vacías
if (empty($nombre) || empty($precio) || empty($categoria) || empty($stock) || empty($stock_minimo) || empty($stock_maximo) || empty($foto)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    header('Location: ' . $URL . "/app/productos/create_productos.php");
    exit; // Detenemos la ejecución
}

// Verificar si el producto ya existe
$consulta = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE nombre = :nombre");
$consulta->bindParam(':nombre', $nombre);
$consulta->execute();
$existe = $consulta->fetchColumn();

if ($existe > 0) {
    $_SESSION['mensaje'] = "El producto ya existe. Intenta con otro.";
    header('Location: ' . $URL . "/app/productos/create_productos.php");
    exit; 
} else {
    // Inserta el nuevo producto
    $sentencia = $pdo->prepare("INSERT INTO productos(nombre, precio, id_categoria, stock, stock_minimo, stock_maximo, foto) VALUES (:nombre, :precio, :categoria, :stock, :stock_minimo, :stock_maximo, :foto)");
    

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':categoria', $categoria);
    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':stock_minimo', $stock_minimo);
    $sentencia->bindParam(':stock_maximo', $stock_maximo);
    $sentencia->bindParam(':foto', $foto);
    
    $sentencia->execute();

    $_SESSION['mensaje'] = "Producto agregado con éxito!";
    $_SESSION['icono'] = "success"; 
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/productos/");
    exit; //
}
?>
