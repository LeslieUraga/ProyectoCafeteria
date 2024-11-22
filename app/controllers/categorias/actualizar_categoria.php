<?php
include('../../config.php');

session_start();

$id_categoria = $_POST['id_categoria'];
$descripcion = trim($_POST['descripcion']);


if (!empty($descripcion)) {
    // Obtener la descripción actual de la categoría
    $consulta_actual = $pdo->prepare("SELECT descripcion FROM categorias WHERE id_categoria = :id_categoria");
    $consulta_actual->bindParam(':id_categoria', $id_categoria);
    $consulta_actual->execute();
    $descripcion_actual = $consulta_actual->fetchColumn();
    
    if ($descripcion !== $descripcion_actual) {
        $consulta = $pdo->prepare("SELECT COUNT(*) FROM categorias WHERE descripcion = :descripcion");
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->execute();
        $existe = $consulta->fetchColumn();

        if ($existe > 0) {            
            $_SESSION['mensaje'] = "La categoría ya existe. Intenta con otra.";
            $_SESSION['icono'] = "error"; 
            $_SESSION['titulo'] = "¡Error!";
            header('Location: ' . $URL . "/app/categorias/update_categoria.php?id=" . $id_categoria);
            exit; 
        } else {            
            $sentencia = $pdo->prepare("UPDATE categorias SET descripcion = :descripcion WHERE id_categoria = :id_categoria");
            $sentencia->bindParam(':descripcion', $descripcion);
            $sentencia->bindParam(':id_categoria', $id_categoria);
            $sentencia->execute();

            $_SESSION['mensaje'] = "Se actualizó la categoría correctamente";
            $_SESSION['icono'] = "success"; 
            $_SESSION['titulo'] = "¡Éxito!";
            header('Location: ' . $URL . "/app/categorias/");
            exit; 
        }
    } else {        
        $_SESSION['mensaje'] = "La descripción es la misma que la actual. No se realizaron cambios.";
        $_SESSION['icono'] = "info"; 
        $_SESSION['titulo'] = "Información";
        header('Location: ' . $URL . "/app/categorias/update_categoria.php?id=" . $id_categoria);
        exit; 
    }
} 
?>
