<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/products/proveedores.png" class="card-img-top" alt="matdash-img" width="50" height="300">
                    </a>
                </div>

                <div class="card-body p-4">
                    <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">PROVEEDORES</span>
                    <br><br>

                    <!-- Ajusta el tamaño de la tabla aquí -->
                    <div class="table-container table-responsive-sm">
                        <table id="tablaProveedores" class="table table-sm"  style="border: none;">
                            <thead>
                                <tr style="border-bottom: 2px solid #814a3e;">
                                    <th scope="col" style="border: none;">Nombre</th>
                                    <th scope="col" style="border: none;">Teléfono</th>
                                    <th scope="col" style="border: none;">Correo electrónico</th>
                                    <th scope="col" style="border: none;">Dirección</th>
                                    <th scope="col" style="border: none;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                include('../controllers/proveedores/listado_de_proveedores.php');
                                foreach($proveedores_controller as $proveedor_controller) { ?>
                                    <tr>
                                        <td style="border: none;"><?php echo $proveedor_controller['nombre']; ?></td>                                        
                                        <td style="border: none;"><?php echo $proveedor_controller['telefono']; ?></td>
                                        <td style="border: none;"><?php echo $proveedor_controller['correo_electronico']; ?></td>  
                                        <td style="border: none;"><?php echo $proveedor_controller['direccion']; ?></td>                                        
                                        <td  style="border: none;" class="text-center" style="white-space: nowrap; width: 100px;">
                                            <button type="button" class="btn">
                                                <iconify-icon icon="solar:minus-circle-bold" class="fs-6" width="40" height="40" style="color: #ed2d2d;"></iconify-icon>
                                            </button>
                                            <button type="button" class="btn">
                                                <iconify-icon icon="solar:refresh-circle-bold" class="fs-6" width="40" height="40" style="color: #1fe3e0;"></iconify-icon>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="button" class="btn btn-success">
                                AGREGAR
                            </button>
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
    $("#tablaProveedores").DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
        dom: 'Bfrtip',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json'
        }
    }).buttons().container().appendTo('#tablaCategorias_wrapper .col-md-6:eq(0)');
});
</script>