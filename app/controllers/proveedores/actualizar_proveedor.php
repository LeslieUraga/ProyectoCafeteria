<?php
include('../../config.php');
session_start();

$id_proveedor = $_POST['id_proveedor'];
$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo_electronico = trim($_POST['correo_electronico']);
$direccion = trim($_POST['direccion']);

if (!empty($nombre) && !empty($telefono) && !empty($correo_electronico) && !empty($direccion)) {
    
    $consulta_actual = $pdo->prepare("SELECT nombre, telefono, correo_electronico, direccion 
                                      FROM proveedores WHERE id_proveedor = :id_proveedor");
    $consulta_actual->bindParam(':id_proveedor', $id_proveedor);
    $consulta_actual->execute();
    $proveedor_actual = $consulta_actual->fetch(PDO::FETCH_ASSOC);        

    $nombre_actual = (int)$proveedor_actual['nombre'];
    $nombre_nuevo = (int)$nombre;

    $telefono_actual = (int)$proveedor_actual['telefono'];
    $telefono_nuevo = (int)$telefono;

    $correo_electronico_actual = (int)$proveedor_actual['correo_electronico'];
    $correo_electronico_nuevo = (int)$correo_electronico;

    $direccion_actual = (int)$proveedor_actual['direccion'];
    $direccion_nuevo = (int)$direccion;


    if ($nombre_actual === $nombre_nuevo && $telefono_actual === $telefono_nuevo &&
        $correo_electronico_actual === $correo_electronico_nuevo && $direccion_actual === $direccion_nuevo) {
        
        $_SESSION['mensaje'] = "Los datos son los mismos que los actuales. No se realizaron cambios.";
        $_SESSION['icono'] = "info";
        $_SESSION['titulo'] = "Información";
        header('Location: ' . $URL . "/app/proveedores/update_proveedores.php?id=" . $id_proveedor);
        exit;
    }
    
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM proveedores WHERE nombre = :nombre AND id_proveedor != :id_proveedor");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':id_proveedor', $id_proveedor);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {        
        $_SESSION['mensaje'] = "El proveedor ya existe. Intenta con otro nombre.";
        $_SESSION['icono'] = "error";
        $_SESSION['titulo'] = "¡Error!";
        header('Location: ' . $URL . "/app/proveedores/update_proveedores.php?id=" . $id_proveedor);
        exit;
    }
    
    $sentencia = $pdo->prepare("UPDATE proveedores SET 
                                nombre = :nombre, 
                                telefono = :telefono, 
                                correo_electronico = :correo_electronico, 
                                direccion = :direccion              
                                WHERE id_proveedor = :id_proveedor");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':correo_electronico', $correo_electronico);
    $sentencia->bindParam(':direccion', $direccion);    
    $sentencia->bindParam(':id_proveedor', $id_proveedor);
    $sentencia->execute();
    
    $_SESSION['mensaje'] = "Se actualizó el proveedor correctamente";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/proveedores/");
    exit;
} else {
    $_SESSION['mensaje'] = "Por favor, completa todos los campos.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "¡Error!";
    header('Location: ' . $URL . "/app/proveedores/update_proveedores.php?id=" . $id_proveedor);
    exit;
}
?>
