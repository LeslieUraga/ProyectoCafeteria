<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
?>


<body>
    <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
        $respuesta = $_SESSION['mensaje']; ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['icono']; ?>',
                title: '<?php echo $_SESSION['titulo']; ?>',
                text: '<?php echo $respuesta; ?>',
            });
        </script>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['icono']);
        unset($_SESSION['titulo']);
    }
    ?>
</body>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card overflow-hidden hover-img">

                <div class="card-body p-4">
                    <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">VENTAS</span>
                    <br><br>

                    <div class="table-container table-responsive-sm">
                        <table id="tablaVentas" class="table table-sm" style="border: none;">
                            <thead>
                                <tr style="border-bottom: 2px solid #814a3e;">
                                    <th scope="col" style="border: none;">Numero de Venta</th>
                                    <th scope="col" style="border: none;">Fecha de venta</th>
                                    <th scope="col" style="border: none;">Total</th>
                                    <th scope="col" style="border: none;">Empleado</th>
                                    <th scope="col" style="border: none;">Productos</th>
                                    <th scope="col" style="border: none;">Cantidad</th>
                                    <th scope="col" style="border: none;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                include('../controllers/ventas/listado_de_ventas.php');
                                foreach ($ventas_controller as $venta_controller) {
                                    ?>
                                    <tr>
                                        <td style="border: none;"><?php echo $venta_controller['id_venta']; ?></td>
                                        <td style="border: none;"><?php echo $venta_controller['fecha_venta']; ?></td>
                                        <td style="border: none;"><?php echo $venta_controller['total']; ?></td>
                                        <td style="border: none;"><?php echo $venta_controller['nombre']; ?></td>
                                        <td style="border: none;"><?php echo $venta_controller['productos']; ?></td>
                                        <td style="border: none;"><?php echo $venta_controller['cantidad']; ?></td>
                                        <td style="border: none;" class="text-center"
                                            style="white-space: nowrap; width: 100px;">

                                            <a href="<?php echo $URL; ?>/app/ventas/delete_ventas.php?id=<?php echo $venta_controller['id_venta']; ?>"
                                                type="button" class="btn">
                                                <iconify-icon icon="solar:minus-circle-bold" class="fs-6" width="40"
                                                    height="40" style="color: #ed2d2d;"></iconify-icon>
                                            </a>

                                            <a href="<?php echo $URL; ?>/app/controllers/ventas/ticket.php?id=<?php echo $venta_controller['id_venta']; ?>"
                                                type="button" class="btn">
                                                <iconify-icon icon="solar:bill-list-line-duotone" class="fs-6" width="40" height="40"
                                                    style="color: #1e90ff;"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>

                        <br>
                        <div style="display: flex; justify-content: center;">
                            <a href="<?php echo $URL; ?>/app/ventas/create_ventas.php" type="button"
                                class="btn btn-success">
                                AGREGAR
                            </a>
                        </div>
                        <br>

                    </div>

                    <br>
                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center fs-2 ms-auto">
                            <i class="ti ti-point text-dark"></i>
                            <?php echo date('D, M j'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include('../../layout/parte2.php');
?>

<script>
    $(document).ready(function () {
        $("#tablaVentas").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            dom: 'Bfrtip',
        }).buttons().container().appendTo('#tablaVentas_wrapper .col-md-6:eq(0)');
    });
</script>