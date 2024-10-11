<?php
include('../../config.php');
session_start();

$id_producto = $_POST['id_producto'];
$nombre = trim($_POST['nombre']);
$precio = trim($_POST['precio']);
$stock = trim($_POST['stock']);
$stock_minimo = trim($_POST['stock_minimo']);
$stock_maximo = trim($_POST['stock_maximo']);
$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo."__".$_FILES['foto']['name'];
$location = "../../productos/img_productos/".$filename;
move_uploaded_file($_FILES['foto']['tmp_name'], $location);
$foto = $_POST['foto'];
$categoria = $_POST['categoria']; 

if (!empty($nombre) && !empty($precio) && !empty($stock) && !empty($stock_minimo) && !empty($stock_maximo) && !empty($categoria)) {

    // Obtener los valores actuales del producto
    $consulta_actual = $pdo->prepare("SELECT nombre, precio, stock, stock_minimo, stock_maximo, foto, id_categoria 
                                      FROM productos WHERE id_producto = :id_producto");
    $consulta_actual->bindParam(':id_producto', $id_producto);
    $consulta_actual->execute();
    $producto_actual = $consulta_actual->fetch(PDO::FETCH_ASSOC);

    // Convertir los valores a tipos compatibles para la comparación
    $precio_actual = number_format((float)$producto_actual['precio'], 2, '.', '');
    $precio_nuevo = number_format((float)$precio, 2, '.', '');

    $stock_actual = (int)$producto_actual['stock'];
    $stock_nuevo = (int)$stock;

    $stock_minimo_actual = (int)$producto_actual['stock_minimo'];
    $stock_minimo_nuevo = (int)$stock_minimo;

    $stock_maximo_actual = (int)$producto_actual['stock_maximo'];
    $stock_maximo_nuevo = (int)$stock_maximo;

    // Comparar todos los valores
    if ($nombre === $producto_actual['nombre'] && $precio_nuevo === $precio_actual &&
        $stock_nuevo === $stock_actual && $stock_minimo_nuevo === $stock_minimo_actual &&
        $stock_maximo_nuevo === $stock_maximo_actual && $foto === $producto_actual['foto'] &&
        $categoria == $producto_actual['id_categoria']) {

        // Si no hubo cambios, mostrar el mensaje adecuado
        $_SESSION['mensaje'] = "Los datos son los mismos que los actuales. No se realizaron cambios.";
        $_SESSION['icono'] = "info";
        $_SESSION['titulo'] = "Información";
        header('Location: ' . $URL . "/app/productos/update_productos.php?id=" . $id_producto);
        exit;
    }

    // Verificar si el nombre ya existe en otro producto
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE nombre = :nombre AND id_producto != :id_producto");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':id_producto', $id_producto);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {
        // Si el nombre ya existe, mostrar un mensaje de error
        $_SESSION['mensaje'] = "El producto ya existe. Intenta con otro nombre.";
        $_SESSION['icono'] = "error";
        $_SESSION['titulo'] = "¡Error!";
        header('Location: ' . $URL . "/app/productos/update_productos.php?id=" . $id_producto);
        exit;
    }

    // Si hay cambios, proceder con la actualización
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
    $sentencia->bindParam(':precio', $precio_nuevo);
    $sentencia->bindParam(':stock', $stock_nuevo);
    $sentencia->bindParam(':stock_minimo', $stock_minimo_nuevo);
    $sentencia->bindParam(':stock_maximo', $stock_maximo_nuevo);
    $sentencia->bindParam(':foto', $filename);
    $sentencia->bindParam(':categoria', $categoria);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    // Mensaje de éxito si se actualizan los datos
    $_SESSION['mensaje'] = "Se actualizó el producto correctamente";
    $_SESSION['icono'] = "success";
    $_SESSION['titulo'] = "¡Éxito!";
    header('Location: ' . $URL . "/app/productos/");
    exit;
} else {
    $_SESSION['mensaje'] = "Por favor, completa todos los campos.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "¡Error!";
    header('Location: ' . $URL . "/app/productos/update_productos.php?id=" . $id_producto);
    exit;
}
?>
