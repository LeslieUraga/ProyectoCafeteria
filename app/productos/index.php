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
                        <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/products/menu.png" class="card-img-top" alt="matdash-img" width="50" height="300">
                    </a>
                </div>

                <div class="card-body p-4">
                    <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">PRODUCTOS</span>
                    <br><br>

                    <!-- Ajusta el tamaño de la tabla aquí -->
                    <div class="table-container table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr style="border-bottom: 2px solid #814a3e;">
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Stock mínimo</th>
                                    <th scope="col">Stock máximo</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                include('../controllers/productos/listado_de_productos.php');
                                foreach($productos_controller as $producto_controller) { ?>
                                    <tr>
                                        <td><?php echo $producto_controller['nombre']; ?></td>
                                        <td>$<?php echo $producto_controller['precio']; ?></td>
                                        <td><?php echo $producto_controller['descripcion']; ?></td>
                                        <td><?php echo $producto_controller['stock']; ?></td>
                                        <td><?php echo $producto_controller['stock_minimo']; ?></td>
                                        <td><?php echo $producto_controller['stock_maximo']; ?></td>
                                        <td class="text-center" style="white-space: nowrap; width: 100px;">
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