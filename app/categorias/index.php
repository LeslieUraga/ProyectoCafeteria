<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
?>


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

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/products/categorias.png" class="card-img-top" alt="matdash-img">
                    </a>
                </div>
                <div class="card-body p-4">
                    <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">CATEGORÍAS</span>
                    <br><br>

                    <!-- Tabla con estilo -->
                    <div class="table-container table-responsive">
                        <table id="tablaCategorias" class="table table-sm" style="border: none;">
                            <thead>
                                <tr style="border-bottom: 2px solid #814a3e;">
                                    <th scope="col" style="border: none;">ID</th>
                                    <th scope="col" style="border: none;">Descripción</th>
                                    <th scope="col" class="text-center" style="border: none;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../controllers/categorias/listado_de_categorias.php');
                                foreach($categorias_controller as $categoria_controller) { 
                                        $id_categoria = $categoria_controller['id_categoria'];
                                    ?>
                                    <tr>
                                        <td style="border: none;"><?php echo $categoria_controller['id_categoria']; ?></td>
                                        <td style="border: none;"><?php echo $categoria_controller['descripcion']; ?></td>
                                        <td class="text-center" style="border: none;">
                                            <a href="<?php echo $URL;?>/app/categorias/delete_categoria.php?id=<?php echo $id_categoria;?>" type="button" class="btn">
                                                <iconify-icon icon="solar:minus-circle-bold" class="fs-6" width="40" height="40" style="color: #ed2d2d;"></iconify-icon>
                                            </a>
                                            <a href="<?php echo $URL;?>/app/categorias/update_categoria.php?id=<?php echo $id_categoria;?>" type="button" class="btn">
                                                <iconify-icon icon="solar:refresh-circle-bold" class="fs-6" width="40" height="40" style="color: #1fe3e0;"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <br>
                        <div style="display: flex; justify-content: center;">
                            <a href="<?php echo $URL;?>/app/categorias/create_categoria.php" type="button" class="btn btn-success">
                                AGREGAR
                            </a>
                        </div>
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
    $("#tablaCategorias").DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
        dom: 'Bfrtip',
       
    }).buttons().container().appendTo('#tablaCategorias_wrapper .col-md-6:eq(0)');
});
</script>
