<?php
include('../../config.php');
session_start();

$id_producto = $_POST['id_producto'];
$nombre = trim($_POST['nombre']);
$precio = trim($_POST['precio']);
$stock = trim($_POST['stock']);
$stock_minimo = trim($_POST['stock_minimo']);
$stock_maximo = trim($_POST['stock_maximo']);
$foto = trim($_POST['foto']);
$categoria = $_POST['categoria']; 

if (!empty($nombre) && !empty($precio) && !empty($stock) && !empty($stock_minimo) && !empty($stock_maximo) && !empty($categoria)) {
    $consulta_actual = $pdo->prepare("SELECT nombre FROM productos WHERE id_producto = :id_producto");
    $consulta_actual->bindParam(':id_producto', $id_producto);
    $consulta_actual->execute();
    $nombre_actual = $consulta_actual->fetchColumn();

    if ($nombre !== $nombre_actual) {
        $consulta = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE nombre = :nombre AND id_producto != :id_producto");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':id_producto', $id_producto);
        $consulta->execute();
        $existe = $consulta->fetchColumn();

        if ($existe > 0) {            
            $_SESSION['mensaje'] = "El producto ya existe. Intenta con otro nombre.";
            $_SESSION['icono'] = "error";
            $_SESSION['titulo'] = "¡Error!";
            header('Location: ' . $URL . "/app/productos/update_productos.php?id=" . $id_producto);
            exit;
        }
    }


    $sentencia = $pdo->prepare("UPDATE productos SET 
                                nombre = :nombre, 
                                precio = :precio, 
                                stock = :stock, 
                                stock_minimo = :stock_minimo, 
                                stock_maximo = :stock_maximo, 
                                foto = :foto,
                                id_categoria = :categoria
                                WHERE id_producto = :id_producto");
    
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':stock_minimo', $stock_minimo);
    $sentencia->bindParam(':stock_maximo', $stock_maximo);
    $sentencia->bindParam(':foto', $foto);
    $sentencia->bindParam(':categoria', $categoria); 
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    
    $_SESSION['mensaje'] = "Se actualizó el producto correctamente";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/productos/");
    exit;
} 
?>
