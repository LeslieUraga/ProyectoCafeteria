<?php
include('../../config.php');

$id_proveedor = $_POST['id_proveedor'];
$sql_proveedor_eliminar = $pdo->prepare("DELETE FROM proveedores WHERE id_proveedor =:id_proveedor"); 
$sql_proveedor_eliminar->bindParam('id_proveedor', $id_proveedor);
$sql_proveedor_eliminar->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino el proveedor de manera correcta";
$_SESSION['icono'] = "success";
$_SESSION['titulo'] = "¡Éxito!";
header('Location: '.$URL.'/app/proveedores');

?>