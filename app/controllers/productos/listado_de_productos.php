<?php
    
// Asegúrate de que la conexión PDO ($pdo) esté correctamente inicializada antes de esta línea.
$sql_productos = "SELECT
                    p.id_producto,
                    p.nombre,
                    p.precio,
                    c.descripcion,
                    p.stock,
                    p.stock_minimo,
                    p.stock_maximo 
                FROM productos p 
                JOIN categorias c on c.id_categoria = p.id_categoria";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_controller = $query_productos->fetchAll(PDO::FETCH_ASSOC);
?>