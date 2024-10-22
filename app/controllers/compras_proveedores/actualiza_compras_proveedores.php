<?php
include("../../config.php");
session_start();

$id_compras = trim($_POST['id_compras']);
$nombre_proveedor = trim($_POST['nombre']);
$fecha_compra = trim($_POST['fecha_compra']);
$total = trim($_POST['total']);
$rfc = trim($_POST['rfc']);
$producto = trim($_POST['producto']); 
$cantidad = trim($_POST['cantidad']); 
$precio_unitario = trim($_POST['precio_unitario']); 

var_dump($_POST); 

if (!is_numeric($total) || $total <= 0) {
    $_SESSION['mensaje'] = "El total debe ser un número positivo.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/update_compras_proveedor.php?id=" . $id_compras);
    exit;
}

if (!is_numeric($cantidad) || $cantidad <= 0 || !is_numeric($precio_unitario) || $precio_unitario <= 0) {
    $_SESSION['mensaje'] = "La cantidad y el precio unitario deben ser números positivos.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/update_compras_proveedor.php?id=" . $id_compras);
    exit;
}

try {
    $pdo->beginTransaction();

    $consulta_actual = $pdo->prepare("SELECT id_proveedor, fecha_compra, total, rfc, id_producto, cantidad, precio_unitario FROM compras 
                                       INNER JOIN detalle_compras ON compras.id_compras = detalle_compras.id_compras
                                       WHERE compras.id_compras = :id_compras");
    $consulta_actual->bindParam(':id_compras', $id_compras);
    $consulta_actual->execute();
    $datos_actuales = $consulta_actual->fetch(PDO::FETCH_ASSOC);

    if ($nombre_proveedor == $datos_actuales['id_proveedor'] && 
        $_POST['fecha_compra'] == $datos_actuales['fecha_compra'] && 
        $total == $datos_actuales['total'] && 
        $rfc == $datos_actuales['rfc'] && 
        $producto == $datos_actuales['id_producto'] && 
        $cantidad == $datos_actuales['cantidad'] && 
        $precio_unitario == $datos_actuales['precio_unitario']) {
        
        $_SESSION['mensaje'] = "No se realizaron cambios en la compra.";
        $_SESSION['icono'] = "info";
        $_SESSION['titulo'] = "Información";
        header('Location: ' . $URL . "/app/compras_proveedores");
        exit;
    }

    $sentencia = $pdo->prepare("UPDATE compras SET id_proveedor = :id_proveedor, fecha_compra = :fecha_compra, total = :total, rfc = :rfc WHERE id_compras = :id_compras");
    $sentencia->bindParam(':id_proveedor', $nombre_proveedor);
    $sentencia->bindParam(':fecha_compra', $_POST['fecha_compra']); 
    $sentencia->bindParam(':total', $total);
    $sentencia->bindParam(':rfc', $rfc);
    $sentencia->bindParam(':id_compras', $id_compras);
    $sentencia->execute();

    $sentencia_detalle = $pdo->prepare("UPDATE detalle_compras SET id_producto = :id_producto, cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id_compras = :id_compras");
    $sentencia_detalle->bindParam(':id_compras', $id_compras);
    $sentencia_detalle->bindParam(':id_producto', $producto);
    $sentencia_detalle->bindParam(':cantidad', $cantidad);
    $sentencia_detalle->bindParam(':precio_unitario', $precio_unitario);
    $sentencia_detalle->execute();

    $sentencia_stock = $pdo->prepare("UPDATE productos SET stock = stock + :cantidad WHERE id_producto = :id_producto");
    $sentencia_stock->bindParam(':cantidad', $cantidad);
    $sentencia_stock->bindParam(':id_producto', $producto);
    $sentencia_stock->execute();

    $pdo->commit();

    $_SESSION['mensaje'] = "Compra actualizada con éxito y el stock ha sido ajustado!";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();

    $_SESSION['mensaje'] = "Error al actualizar la compra: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/update_compras_proveedor.php?id_compras=" . $id_compras);
    exit;
}
?>
