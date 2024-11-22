<?php
include("../../config.php");
session_start();

$id_compras = trim($_POST['id_compras']);

if (empty($id_compras)) {
    $_SESSION['mensaje'] = "El ID de la compra no puede estar vacío.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit;
}

try {
    $pdo->beginTransaction();

    $consulta_detalles = $pdo->prepare("SELECT id_producto, cantidad FROM detalle_compras WHERE id_compras = :id_compras");
    $consulta_detalles->bindParam(':id_compras', $id_compras);
    $consulta_detalles->execute();
    $detalles_compra = $consulta_detalles->fetchAll(PDO::FETCH_ASSOC);

    $sentencia_detalle = $pdo->prepare("DELETE FROM detalle_compras WHERE id_compras = :id_compras");
    $sentencia_detalle->bindParam(':id_compras', $id_compras);
    $sentencia_detalle->execute();

    foreach ($detalles_compra as $detalle) {
        $sentencia_stock = $pdo->prepare("UPDATE productos SET stock = stock - :cantidad WHERE id_producto = :id_producto");
        $cantidad = $detalle['cantidad'];
        $id_producto = $detalle['id_producto'];
        $sentencia_stock->bindParam(':cantidad', $cantidad);
        $sentencia_stock->bindParam(':id_producto', $id_producto);
        $sentencia_stock->execute();
    }

    $sentencia_compra = $pdo->prepare("DELETE FROM compras WHERE id_compras = :id_compras");
    $sentencia_compra->bindParam(':id_compras', $id_compras);
    $sentencia_compra->execute();

    $pdo->commit();

    $_SESSION['mensaje'] = "Compra eliminada con éxito y el stock ha sido modificado!";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();

    $_SESSION['mensaje'] = "Error al eliminar la compra: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/compras_proveedores/");
    exit;
}
?>
