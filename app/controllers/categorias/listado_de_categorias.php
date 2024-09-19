<?php
    
// Asegúrate de que la conexión PDO ($pdo) esté correctamente inicializada antes de esta línea.
$sql_categorias = "SELECT * FROM categorias";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_controller = $query_categorias->fetchAll(PDO::FETCH_ASSOC);
?>