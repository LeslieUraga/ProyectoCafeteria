<?php
$sql_ventas = "SELECT
                v.id_venta,
                v.fecha_venta,
                v.total,
                CONCAT(e.nombre, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS nombre,
                GROUP_CONCAT(p.nombre SEPARATOR ', ') AS productos,
                SUM(dv.cantidad) AS cantidad
                FROM ventas v
                JOIN detalle_ventas dv ON dv.id_venta = v.id_venta
                JOIN empleados e ON e.rfc = v.rfc
                JOIN productos p ON p.id_producto = dv.id_producto
                GROUP BY v.id_venta, v.fecha_venta, v.total, e.nombre, e.apellido_paterno, e.apellido_materno";

$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_controller = $query_ventas->fetchAll(PDO::FETCH_ASSOC);
foreach ($ventas_controller as $venta_controller) {

}


$sql_id = "SELECT MAX(id_venta) + 1 AS nuevo_id FROM ventas";
$query_id = $pdo->prepare($sql_id);
$query_id->execute();
$id_controller = $query_id->fetchAll(PDO::FETCH_ASSOC);
foreach ($id_controller as $controller) {
}
?>