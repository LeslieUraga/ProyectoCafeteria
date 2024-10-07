<?php
include("../../config.php");
session_start();
$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo_electronico = trim($_POST['correo_electronico']);
$direccion = trim($_POST['direccion']);

if (!empty($nombre) || !empty($telefono)|| !empty($correo_electronico)|| !empty($direccion)) {
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM proveedores WHERE nombre = :nombre");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {        
        $_SESSION['mensaje'] = "El proveedor ya existe. Intenta con otro.";
        $_SESSION['icono'] = "error"; 
        $_SESSION['titulo'] = "¡Error!";
        header('Location: ' . $URL . "/app/proveedores/create_proveedores.php");
        exit; 
    } else {        
        $sentencia = $pdo->prepare("INSERT INTO proveedores(nombre, telefono, correo_electronico, direccion) VALUES (:nombre, :telefono, :correo_electronico, :direccion)");
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
    }
} else {
    $_SESSION['mensaje'] = "Error al agregar el proveedor!";
    header('Location: ' . $URL . "/app/proveedores/create_proveedores.php");
    exit; 
}
?>

