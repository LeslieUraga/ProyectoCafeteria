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
                <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/products/compras a proveedor.jpg" class="card-img-top" alt="matdash-img" width="100" height="400">
                    </a>
                </div>

                <div class="card-body p-4">
                    <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">COMPRAS A PROVEEDORES</span>
                    <br><br>

                    <!-- Ajusta el tamaño de la tabla aquí -->
                    <div class="table-container table-responsive-sm">
                        <table id="tablaCompraProveedores" class="table table-sm"  style="border: none;">
                            <thead>
                                <tr style="border-bottom: 2px solid #814a3e;">
                                    <th scope="col" style="border: none;">Nombre proveedor</th>
                                    <th scope="col" style="border: none;">Fecha de compra</th>
                                    <th scope="col" style="border: none;">Total</th>
                                    <th scope="col" style="border: none;">Empleado</th>
                                    <th scope="col" style="border: none;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                include('../controllers/compras_proveedores/listado_compras_proveedor.php');
                                foreach($compras_proveedor_controller as $compra_proveedor_controller) { 
                                        
                                    ?>
                                    <tr>
                                        <td style="border: none;"><?php echo $compra_proveedor_controller['nombre']; ?></td>                                        
                                        <td style="border: none;"><?php echo $compra_proveedor_controller['fecha_compra']; ?></td>
                                        <td style="border: none;"><?php echo $compra_proveedor_controller['total']; ?></td>   
                                        <td style="border: none;"><?php echo $compra_proveedor_controller['nombreEmpleado']; ?></td>      
                                        <td  style="border: none;" class="text-center" style="white-space: nowrap; width: 100px;">
                                            <a href="<?php echo $URL;?>/app/compras_proveedores/delete_compras_proveedores.php?id=<?php echo $id_compras;?>" type="button" class="btn">
                                                <iconify-icon icon="solar:minus-circle-bold" class="fs-6" width="40" height="40" style="color: #ed2d2d;"></iconify-icon>
                                            </a>
                                            <a href="<?php echo $URL;?>/app/compras_proveedores/update_compras_proveedores.php?id=<?php echo $id_compras;?>" type="button" class="btn">
                                                <iconify-icon icon="solar:refresh-circle-bold" class="fs-6" width="40" height="40" style="color: #1fe3e0;"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <br>
                        <div style="display: flex; justify-content: center;">
                            <a href="<?php echo $URL;?>/app/compras_proveedores/create_compras_proveedor.php" type="button" class="btn btn-success">
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
    $(document).ready(function() {
    $("#tablaCompraProveedores").DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
        dom: 'Bfrtip',
    }).buttons().container().appendTo('#tablaCompraProveedores_wrapper .col-md-6:eq(0)');
});
</script>