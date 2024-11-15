<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
$query = "SELECT rfc, numero_empleado, nombre, apellido_paterno, apellido_materno, correo_electronico, telefono, puesto, fecha_contratacion FROM empleados";
$stmt = $pdo->prepare($query);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Empleados</h1>
        
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Número de Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Puesto</th>
                    <th>Fecha de Contratación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado) { ?>
                    <tr>
                        <td><?php echo $empleado['numero_empleado']; ?></td>
                        <td><?php echo $empleado['nombre']; ?></td>
                        <td><?php echo $empleado['apellido_paterno']; ?></td>
                        <td><?php echo $empleado['apellido_materno']; ?></td>
                        <td><?php echo $empleado['correo_electronico']; ?></td>
                        <td><?php echo $empleado['telefono']; ?></td>
                        <td><?php echo $empleado['puesto']; ?></td>
                        <td><?php echo $empleado['fecha_contratacion']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
include('../../layout/parte2.php');
?>
