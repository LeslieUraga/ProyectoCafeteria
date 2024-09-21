<?php
include("../../config.php");

session_start(); 

if (isset($_POST['descripcion'])) {
    $descripcion = trim($_POST['descripcion']); 

    // Verificar si la descripción está vacía
    if (empty($descripcion)) {
        $_SESSION['mensaje'] = "El campo descripción no puede estar vacío.";
        header('Location: ' . $URL . "/app/categorias/create_categoria.php");
        exit; // Detenemos la ejecución
    }

    // Verificar si la descripción ya existe en la base de datos
    $consulta = $pdo->prepare("SELECT COUNT(*) FROM categorias WHERE descripcion = :descripcion");
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->execute();
    $existe = $consulta->fetchColumn();

    if ($existe > 0) {
        // Si ya existe, muestra un mensaje de error
        $_SESSION['mensaje'] = "La categoría ya existe. Intenta con otra.";
        header('Location: ' . $URL . "/app/categorias/create_categoria.php");
        exit; // Detenemos la ejecución
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
    // Si no se envió una descripción, muestra un mensaje de error
    $_SESSION['mensaje'] = "Error al agregar la categoría!";
    header('Location: ' . $URL . "/app/categorias/create_categoria.php");
    exit; 
}
?>
