<?php
include("../../config.php");
session_start();

$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo_electronico = trim($_POST['correo_electronico']);
$direccion = trim($_POST['direccion']);


if (empty($nombre) || empty($telefono) || empty($correo_electronico) || empty($direccion)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/proveedores/agregar_proveedor.php");
    exit;
}


if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje'] = "Correo electrónico no válido.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/proveedores/agregar_proveedor.php");
    exit;
}

try {
    
    $sentencia = $pdo->prepare("INSERT INTO proveedores(nombre, telefono, correo_electronico, direccion) 
                                VALUES (:nombre, :telefono, :correo_electronico, :direccion)");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':correo_electronico', $correo_electronico);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->execute();

    
    $_SESSION['mensaje'] = "Proveedor agregado con éxito!";
    $_SESSION['icono'] = "success"; 
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/proveedores/");
    exit; 

} catch (Exception $e) {
    
    $_SESSION['mensaje'] = "Error al agregar el proveedor: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/proveedores/agregar_proveedor.php");
    exit; 
}
?>
