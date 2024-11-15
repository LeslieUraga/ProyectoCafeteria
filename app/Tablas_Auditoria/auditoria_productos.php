<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');

$sql = "SELECT * FROM productos_audi";
$stmt = $pdo->prepare($sql); // Cambié $conn a $pdo
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Auditoría de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Auditoría de Productos</h2>

    <!-- Card contenedor -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Anterior</th>
                            <th>Precio Anterior</th>
                            <th>Categoría Anterior</th>
                            <th>Stock Anterior</th>
                            <th>Stock Mínimo Anterior</th>
                            <th>Stock Máximo Anterior</th>
                            <th>Foto Anterior</th>
                            <th>Nombre Nuevo</th>
                            <th>Precio Nuevo</th>
                            <th>Categoría Nueva</th>
                            <th>Stock Nuevo</th>
                            <th>Stock Mínimo Nuevo</th>
                            <th>Stock Máximo Nuevo</th>
                            <th>Foto Nueva</th>
                            <th>Usuario</th>
                            <th>Fecha Modificación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['id_producto_audi']; ?></td>
                            <td><?php echo $producto['nombre_ant']; ?></td>
                            <td><?php echo $producto['precio_ant']; ?></td>
                            <td><?php echo $producto['id_categoria_ant']; ?></td>
                            <td><?php echo $producto['stock_ant']; ?></td>
                            <td><?php echo $producto['stock_minimo_ant']; ?></td>
                            <td><?php echo $producto['stock_maximo_ant']; ?></td>
                            <td><?php echo $producto['foto_ant']; ?></td>
                            <td><?php echo $producto['nombre_nue']; ?></td>
                            <td><?php echo $producto['precio_nue']; ?></td>
                            <td><?php echo $producto['id_categoria_nue']; ?></td>
                            <td><?php echo $producto['stock_nue']; ?></td>
                            <td><?php echo $producto['stock_minimo_nue']; ?></td>
                            <td><?php echo $producto['stock_maximo_nue']; ?></td>
                            <td><?php echo $producto['foto_nue']; ?></td>
                            <td><?php echo $producto['usuario']; ?></td>
                            <td><?php echo $producto['modificado']; ?></td>
                            <td><?php echo $producto['accion']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Fin del card -->
</div>
</body>
</html>

<?php
include('../../layout/parte2.php');
?>
