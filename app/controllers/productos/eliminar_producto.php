<?php
include('../../config.php');

$id_producto = $_POST['id_producto'];
$sql_productos_eliminar = $pdo->prepare("DELETE FROM productos WHERE id_producto =:id_producto"); 
$sql_productos_eliminar->bindParam('id_producto', $id_producto);
$sql_productos_eliminar->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino el producto de manera correcta";
$_SESSION['icono'] = "success";
$_SESSION['titulo'] = "¡Éxito!";
header('Location: '.$URL.'/app/productos');

?>