<?php
// Obtener el ID de la venta
$id_venta_get = $_GET['id'];  

// Obtener los detalles de la venta
$sql_ventas = "SELECT * FROM ventas WHERE id_venta = :id_venta";  
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->bindParam(':id_venta', $id_venta_get, PDO::PARAM_INT);  
$query_ventas->execute();
$controller = $query_ventas->fetch(PDO::FETCH_ASSOC); 

$sql_productos = "SELECT p.id_producto, p.nombre, dv.cantidad, dv.precio_unitario, (dv.cantidad * dv.precio_unitario) AS total
                  FROM detalle_ventas dv
                  JOIN productos p ON dv.id_producto = p.id_producto
                  WHERE dv.id_venta = :id_venta";  
$query = $pdo->prepare($sql_productos);
$query->bindParam(':id_venta', $id_venta_get, PDO::PARAM_INT);  
$query->execute();
$productos_venta = $query->fetchAll(PDO::FETCH_ASSOC); 


?>

