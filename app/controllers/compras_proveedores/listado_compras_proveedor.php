<?php
    
$sql_compras_proveedor = "SELECT 
                p.nombre ,
                c.fecha_compra ,
                c.total ,
                concat(e.nombre,' ' ,e.apellido_paterno, ' ',e.apellido_materno) as nombreEmpleado
                FROM compras c 
                JOIN proveedores p on p.id_proveedor = c.id_proveedor 
                JOIN empleados e on e.rfc = c.rfc";

$query_compras_proveedor = $pdo->prepare($sql_compras_proveedor);
$query_compras_proveedor->execute();
$compras_proveedor_controller = $query_compras_proveedor->fetchAll(PDO::FETCH_ASSOC);

?>

