<?php
include('../../config.php');

$id_categoria = $_POST['id_categoria'];
$sql_categorias_eliminar = $pdo->prepare("DELETE FROM categorias WHERE id_categoria =:id_categoria"); 
$sql_categorias_eliminar->bindParam('id_categoria', $id_categoria);
$sql_categorias_eliminar->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino la categoría de manera correcta";
$_SESSION['icono'] = "success";
$_SESSION['titulo'] = "¡Éxito!";
header('Location: '.$URL.'/app/categorias');

?>
