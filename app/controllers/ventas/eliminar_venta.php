<?php
include('../../config.php');
session_start();

if (isset($_POST['id_venta'])) {    
    $id_venta = $_POST['id_venta'];
    
    $pdo->beginTransaction();
    
    try {        
        $sql_detalle = $pdo->prepare("DELETE FROM detalle_ventas WHERE id_venta = :id_venta");
        $sql_detalle->bindParam(':id_venta', $id_venta);
        $sql_detalle->execute();
                
        $sql_venta = $pdo->prepare("DELETE FROM ventas WHERE id_venta = :id_venta");
        $sql_venta->bindParam(':id_venta', $id_venta);
        $sql_venta->execute();
        
        $pdo->commit();
        
        $_SESSION['mensaje'] = "La venta fue eliminada correctamente.";
        $_SESSION['icono'] = "success";
        $_SESSION['titulo'] = "¡Éxito!";
        
        header('Location: ' . $URL . '/app/ventas');
    } catch (Exception $e) {        
        $pdo->rollBack();
        
        $_SESSION['mensaje'] = "Hubo un error al eliminar la venta. Intenta nuevamente.";
        $_SESSION['icono'] = "error";
        $_SESSION['titulo'] = "¡Error!";
        
        header('Location: ' . $URL . '/app/ventas');
    }
} else {    
    $_SESSION['mensaje'] = "No se especificó la venta a eliminar.";
    $_SESSION['icono'] = "error";
    $_SESSION['titulo'] = "¡Error!";
    header('Location: ' . $URL . '/app/ventas');
}
?>
