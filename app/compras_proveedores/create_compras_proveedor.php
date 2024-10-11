<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/compras_proveedores/listado_compras_proveedor.php');
include('../controllers/proveedores/listado_de_proveedores.php');
include('../controllers/productos/listado_de_productos.php');
?>

<body>
    <?php
    if (isset($_SESSION['mensaje'])) {
        $respuesta = $_SESSION['mensaje']; ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: '<?php echo $respuesta; ?>',
            });
        </script>
        <?php
        unset($_SESSION['mensaje']);
    }
    ?>
</body>

<div class="container-fluid">
    <div class="text-center mb-4">
        <h2 style="color: #814a3e;">Realizar compra a proveedor</h2>
    </div>

    <form action="../controllers/compras_proveedores/agregar_compras_proveedores.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Compra a proveedor</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Proveedor</label>
                                <select class="form-control" name="nombre" id="nombre" required>
                                    <option value="">Selecciona un proveedor</option>
                                    <?php foreach ($proveedores_controller as $proveedor_controller): ?>
                                        <option value="<?php echo htmlspecialchars($proveedor_controller['id_proveedor']); ?>">
                                            <?php echo htmlspecialchars($proveedor_controller['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_compra" class="form-label">Fecha Compra</label>
                                <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required>
                            </div>
                            <div class="col-md-6">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control" name="total" id="total" required readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="nombreEmpleado" class="form-label">Empleado</label>
                                <input type="text" class="form-control" id="nombreEmpleado" readonly value="<?php echo $nombres_sesion; ?>">
                                <input type="hidden" name="rfc" value="<?php echo $rfc; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Detalle de la compra</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="producto" class="form-label">Producto</label>
                                <select class="form-control" name="producto" id="producto" required>
                                    <option value="">Selecciona un producto</option>
                                    <?php foreach ($productos_controller as $producto_controller): ?>
                                        <option value="<?php echo htmlspecialchars($producto_controller['id_producto']); ?>">
                                            <?php echo htmlspecialchars($producto_controller['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" required step="0.01" oninput="calcularTotal()">
                            </div>
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" name="precio_unitario" id="precio_unitario" required oninput="calcularTotal()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-info me-2">GUARDAR</button>
            <a href="<?php echo $URL; ?>/app/compras_proveedores" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>

    <script>
        function calcularTotal() {
            const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            const precioUnitario = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const total = cantidad * precioUnitario;

            document.getElementById('total').value = total.toFixed(2);
        }
    </script>

    <?php
    include('../../layout/parte2.php');
    ?>
</div>
