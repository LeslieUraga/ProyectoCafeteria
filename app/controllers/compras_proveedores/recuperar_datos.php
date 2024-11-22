<?php
$id_compras_proveedor_get = $_GET['id'];
$sql_compras_proveedor = "SELECT
                        c.id_compras,
                        p.nombre as nombre_proveedor ,
                        c.fecha_compra, 
                        c.total ,
                        concat(e.nombre, ' ', e.apellido_paterno, ' ', e.apellido_materno) as nombre_empleado,
                        p2.nombre as nombre_producto,
                        dc.cantidad ,
                        dc.precio_unitario,
                        p2.id_producto 
                        FROM compras c
                        JOIN detalle_compras dc on dc.id_compras = c.id_compras 
                        JOIN productos p2 on p2.id_producto = dc.id_producto 
                        JOIN empleados e on e.rfc = c.rfc 
                        JOIN proveedores p on p.id_proveedor = c.id_proveedor 
                        where c.id_compras = '$id_compras_proveedor_get'";
$query_compras_proveedor = $pdo->prepare($sql_compras_proveedor);
$query_compras_proveedor->execute();
$compras_proveedores_controller = $query_compras_proveedor->fetchAll(PDO::FETCH_ASSOC);

foreach ($compras_proveedores_controller as $compra_proveedores_controller) {
        $nombre_proveedor = $compra_proveedores_controller['nombre_proveedor'];
        $id_proveedor = $compra_proveedores_controller['id_proveedor'];
        $fechas_compras = $compra_proveedores_controller['fecha_compra'];
        $total = $compra_proveedores_controller['total'];
        $empleado = $compra_proveedores_controller['nombre_empleado'];
        $producto = $compra_proveedores_controller['nombre_producto'];
        $id_productos = $compra_proveedores_controller['id_producto'];
        $cantidad = $compra_proveedores_controller['cantidad'];
        $precio_unitario = $compra_proveedores_controller['precio_unitario'];
        $id_compras_proveedor = $compra_proveedores_controller['id_compras'];

}   
?>