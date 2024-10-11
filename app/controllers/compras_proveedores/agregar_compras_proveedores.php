<?php
include("../../config.php");
session_start();

$id_proveedor = trim($_POST['nombre']);
$fecha_compra = trim($_POST['fecha_compra']);
$total = trim($_POST['total']);
$rfc = trim($_POST['rfc']);
$producto = trim($_POST['producto']); 
$cantidad = trim($_POST['cantidad']); 
$precio_unitario = trim($_POST['precio_unitario']); 

if (empty($id_proveedor) || empty($fecha_compra) || empty($total) || empty($producto) || empty($cantidad) || empty($precio_unitario)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/create_compras_proveedor.php");
    exit;
}

if (!is_numeric($total) || $total <= 0) {
    $_SESSION['mensaje'] = "El total debe ser un número positivo.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/create_compras_proveedor.php");
    exit;
}

try {
    $pdo->beginTransaction();

    $sentencia = $pdo->prepare("INSERT INTO compras (id_proveedor, fecha_compra, total, rfc) VALUES (:id_proveedor, :fecha_compra, :total, :rfc)");
    $sentencia->bindParam(':id_proveedor', $id_proveedor);
    $sentencia->bindParam(':fecha_compra', $fecha_compra);
    $sentencia->bindParam(':total', $total);
    $sentencia->bindParam(':rfc', $rfc);
    $sentencia->execute();

    $id_compras = $pdo->lastInsertId();

    $sentencia_detalle = $pdo->prepare("INSERT INTO detalle_compras (id_compras, id_producto, cantidad, precio_unitario) VALUES (:id_compras, :id_producto, :cantidad, :precio_unitario)");
    $sentencia_detalle->bindParam(':id_compras', $id_compras);
    $sentencia_detalle->bindParam(':id_producto', $producto);
    $sentencia_detalle->bindParam(':cantidad', $cantidad);
    $sentencia_detalle->bindParam(':precio_unitario', $precio_unitario);
    $sentencia_detalle->execute();

    $pdo->commit();

    $_SESSION['mensaje'] = "Compra realizada con éxito!";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();

    $_SESSION['mensaje'] = "Error al realizar la compra: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/create_compras_proveedor.php");
    exit;
}
?>
