<?php
$id_proveedores_get = $_GET['id'];
$sql_proveedores = "SELECT                     
                        p.id_proveedor,
                        p.nombre ,
                        p.telefono ,
                        p.correo_electronico ,
                        p.direccion 
                    FROM proveedores p                                 
                    where id_proveedor = '$id_proveedores_get'";
$query_proveedores = $pdo->prepare($sql_proveedores);
$query_proveedores->execute();
$proveedores_controller = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);

foreach($proveedores_controller as $proveedor_controller){    
    $id = $proveedor_controller['id_proveedor'];
    $nombre = $proveedor_controller['nombre'];    
    $telefono = $proveedor_controller['telefono'];
    $correo_electronico = $proveedor_controller['correo_electronico'];
    $direccion = $proveedor_controller['direccion'];    
}
?>
