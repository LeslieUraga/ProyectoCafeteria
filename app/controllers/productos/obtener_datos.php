<?php
$id_producto_get = $_GET['id'];
$sql_productos = "SELECT
                    p.id_producto,
                    p.nombre,
                    p.precio,
                    c.descripcion,
                    p.stock,
                    p.stock_minimo,
                    p.stock_maximo,
                    p.id_categoria
                FROM productos p 
                JOIN categorias c on c.id_categoria = p.id_categoria
                where id_producto = '$id_producto_get'";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_controller = $query_productos->fetchAll(PDO::FETCH_ASSOC);

foreach($productos_controller as $producto_controller){
    $id = $producto_controller['id_producto'];
    $nombre = $producto_controller['nombre'];
    $precio = $producto_controller['precio'];
    $descripcion = $producto_controller['descripcion'];
    $stock = $producto_controller['stock'];
    $stock_minimo = $producto_controller['stock_minimo'];
    $stock_maximo = $producto_controller['stock_maximo'];
    $foto = $producto_controller['foto'];
    $id_categoria_actual = $producto_controller['id_categoria']; // Agregar esta línea
}
?>
