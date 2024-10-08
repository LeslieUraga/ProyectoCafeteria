<?php
include("../../config.php");
session_start();
$nombre = trim($_POST['nombre']);
$fecha_compra = trim($_POST['fecha_compra']);
$total = trim($_POST['total']);
$nombreEmpleado = trim($_POST['nombreEmpleado']);

if (!is_numeric($total) || $total <= 0) {
    $_SESSION['mensaje'] = "El total debe ser un número positivo.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/create_compras_proveedor.php");
    exit;
}

try{
    $sentencia = $pdo->prepare("INSERT INTO compras(id_proveedor, fecha_compra, total, rfc) VALUES (:nombre, :fecha_compra, :total, :nombreEmpleado)");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':fecha_compra', $fecha_compra);
    $sentencia->bindParam(':total', $total);
    $sentencia->bindParam(':nombreEmpleado', $nombreEmpleado);
    $sentencia->execute();

    $_SESSION['mensaje'] = "Compra realizada con éxito!";
    $_SESSION['icono'] = "success"; 
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit; 
}catch{
    $_SESSION['mensaje'] = "Error al agregar el proveedor!";
    header('Location: ' . $URL . "/app/compras_proveedores/create_compras_proveedor.php");
    exit; 
}
    
?>

