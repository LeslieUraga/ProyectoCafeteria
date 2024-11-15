<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');

$sql = "SELECT * FROM empleados_audi";
$stmt = $pdo->prepare($sql); // Cambié $conn a $pdo
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Auditoría de Empleados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Auditoría de Empleados</h2>

    <!-- Card contenedor -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Número Empleado Anterior</th>
                            <th>Nombre Anterior</th>
                            <th>Apellido Paterno Anterior</th>
                            <th>Apellido Materno Anterior</th>
                            <th>Correo Electrónico Anterior</th>
                            <th>Teléfono Anterior</th>
                            <th>Puesto Anterior</th>
                            <th>Fecha Contratación Anterior</th>
                            <th>Número Empleado Nuevo</th>
                            <th>Nombre Nuevo</th>
                            <th>Apellido Paterno Nuevo</th>
                            <th>Apellido Materno Nuevo</th>
                            <th>Correo Electrónico Nuevo</th>
                            <th>Teléfono Nuevo</th>
                            <th>Puesto Nuevo</th>
                            <th>Fecha Contratación Nuevo</th>
                            <th>Usuario</th>
                            <th>Fecha Modificación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?php echo $empleado['id_empleados_audi']; ?></td>
                            <td><?php echo $empleado['numero_empleado_ant']; ?></td>
                            <td><?php echo $empleado['nombre_ant']; ?></td>
                            <td><?php echo $empleado['apellido_paterno_ant']; ?></td>
                            <td><?php echo $empleado['apellido_materno_ant']; ?></td>
                            <td><?php echo $empleado['correo_electronico_ant']; ?></td>
                            <td><?php echo $empleado['telefono_ant']; ?></td>
                            <td><?php echo $empleado['puesto_ant']; ?></td>
                            <td><?php echo $empleado['fecha_contratacion_ant']; ?></td>
                            <td><?php echo $empleado['numero_empleado_nue']; ?></td>
                            <td><?php echo $empleado['nombre_nue']; ?></td>
                            <td><?php echo $empleado['apellido_paterno_nue']; ?></td>
                            <td><?php echo $empleado['apellido_materno_nue']; ?></td>
                            <td><?php echo $empleado['correo_electronico_nue']; ?></td>
                            <td><?php echo $empleado['telefono_nue']; ?></td>
                            <td><?php echo $empleado['puesto_nue']; ?></td>
                            <td><?php echo $empleado['fecha_contratacion_nue']; ?></td>
                            <td><?php echo $empleado['usuario']; ?></td>
                            <td><?php echo $empleado['modificado']; ?></td>
                            <td><?php echo $empleado['accion']; ?></td>
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
