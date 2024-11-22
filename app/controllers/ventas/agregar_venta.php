<?php
include("../../config.php");
session_start();

$fecha_venta = trim($_POST['fecha_venta']);
$total_enviado = trim($_POST['total_venta']);
$rfc = trim($_POST['rfc']);

// Validaciones iniciales
if (empty($fecha_venta) || empty($total_enviado) || !isset($_POST['carrito'])) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/ventas/create_ventas.php");
    exit;
}

if (!is_numeric($total_enviado) || $total_enviado <= 0) {
    $_SESSION['mensaje'] = "El total debe ser un número positivo.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/ventas/create_ventas.php");
    exit;
}

// Procesar el carrito 
if (isset($_POST['carrito'])) {
    $carrito = json_decode($_POST['carrito'], true);

    try {
        // Inicia la transacción
        $pdo->beginTransaction();

        // Inserta los datos de la venta
        $sentencia = $pdo->prepare("INSERT INTO ventas (fecha_venta, total, rfc) VALUES (:fecha_venta, :total, :rfc)");
        $sentencia->bindParam(':fecha_venta', $fecha_venta);
        $sentencia->bindParam(':total', $total_enviado);
        $sentencia->bindParam(':rfc', $rfc);
        $sentencia->execute();

        $id_venta = $pdo->lastInsertId();

        // Procesar cada producto del carrito
        foreach ($carrito as $producto) {
            $productoId = $producto['productoId'];
            $productoNombre = $producto['productoNombre'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = $producto['precioUnitario'];
            $totalProducto = $producto['totalProducto'];

            // Validar cantidad y precio
            if (!is_numeric($cantidad) || !is_numeric($precioUnitario) || $cantidad <= 0 || $precioUnitario <= 0) {
                throw new Exception("Cantidad o precio inválido para el producto: $productoNombre.");
            }

            // Verificar stock
            $sentencia_stock_check = $pdo->prepare("SELECT stock FROM productos WHERE id_producto = :id_producto");
            $sentencia_stock_check->bindParam(':id_producto', $productoId);
            $sentencia_stock_check->execute();
            $stock = $sentencia_stock_check->fetchColumn();

            if ($stock < $cantidad) {
                throw new Exception("No hay suficiente stock para el producto: $productoNombre.");
            }

            // Insertar el detalle de la venta
            $sentencia_detalle = $pdo->prepare("INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario) VALUES (:id_venta, :id_producto, :cantidad, :precio_unitario)");
            $sentencia_detalle->bindParam(':id_venta', $id_venta);
            $sentencia_detalle->bindParam(':id_producto', $productoId);
            $sentencia_detalle->bindParam(':cantidad', $cantidad);
            $sentencia_detalle->bindParam(':precio_unitario', $precioUnitario);
            $sentencia_detalle->execute();

            // Actualizar el stock
            $sentencia_stock = $pdo->prepare("UPDATE productos SET stock = stock - :cantidad WHERE id_producto = :id_producto");
            $sentencia_stock->bindParam(':cantidad', $cantidad);
            $sentencia_stock->bindParam(':id_producto', $productoId);
            $sentencia_stock->execute();
        }

        // Commit de la transacción
        $pdo->commit();

        $_SESSION['mensaje'] = "Venta realizada con éxito!";
        $_SESSION['icono'] = "success";
        $_SESSION['titulo'] = "¡Éxito!";
        header('Location: ' . $URL . "/app/ventas/");
        exit;

    } catch (Exception $e) {
        // Rollback en caso de error
        $pdo->rollBack();

        $_SESSION['mensaje'] = "Error al realizar la venta: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        $_SESSION['titulo'] = "Error";
        header('Location: ' . $URL . "/app/ventas/create_ventas.php");
        exit;
    }
} else {
    $_SESSION['mensaje'] = "Carrito vacío o no recibido.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "Error";
    header('Location: ' . $URL . "/app/ventas/create_ventas.php");
    exit;
}
?>
