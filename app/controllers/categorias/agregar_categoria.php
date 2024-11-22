<?php
include("../../config.php");
session_start();
$descripcion = trim($_POST['descripcion']);

if (!empty($descripcion)) {
    // Verificar si la descripción ya existe
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM categorias WHERE descripcion = :descripcion");
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {
        // La categoría ya existe
        $_SESSION['mensaje'] = "La categoría ya existe. Intenta con otra.";
        $_SESSION['icono'] = "error"; 
        $_SESSION['titulo'] = "¡Error!";
        header('Location: ' . $URL . "/app/categorias/create_categoria.php");
        exit; 
    } else {
        // Si no existe, inserta la nueva categoría
        $sentencia = $pdo->prepare("INSERT INTO categorias(descripcion) VALUES (:descripcion)");
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->execute();

        $_SESSION['mensaje'] = "Categoría agregada con éxito!";
        $_SESSION['icono'] = "success"; 
        $_SESSION['titulo'] = "¡Éxito!";
        header('Location: ' . $URL . "/app/categorias/");
        exit; 
    }
} else {
    $_SESSION['mensaje'] = "Error al agregar la categoría!";
    header('Location: ' . $URL . "/app/categorias/create_categoria.php");
    exit; 
}
?>

