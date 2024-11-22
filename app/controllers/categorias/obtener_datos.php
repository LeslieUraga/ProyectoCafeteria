<?php
$id_categoria_get = $_GET['id'];
$sql_categorias = "SELECT * FROM categorias where id_categoria = '$id_categoria_get'";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_controller = $query_categorias->fetchAll(PDO::FETCH_ASSOC);

foreach($categorias_controller as $categoria_controller){
    $descripcion = $categoria_controller['descripcion'];
}
?>
