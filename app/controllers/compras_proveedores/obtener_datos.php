<?php
$sql = "SELECT c.id_compras,
        c.id_proveedor ,
        c.fecha_compra ,
        c.total ,
        c.rfc,
        p.nombre,
        dc.cantidad 
        FROM compras c 
        JOIN detalle_compras dc on dc.id_compras = c.id_compras 
        JOIN productos p on p.id_producto  = dc.id_producto ";

$query = $pdo->prepare($sql);
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>