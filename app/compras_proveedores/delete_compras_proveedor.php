<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/compras_proveedores/listado_compras_proveedor.php');
include('../controllers/compras_proveedores/recuperar_datos.php');
include('../controllers/productos/listado_de_productos.php');
?>

<body>
    <?php
    if (isset($_SESSION['mensaje'])) {
        $respuesta = $_SESSION['mensaje']; ?>
        <script>
            Swal.fire({
                icon: "<?php echo $respuesta['icono']; ?>",
                title: "<?php echo $respuesta['titulo']; ?>",
                text: '<?php echo $respuesta['mensaje']; ?>',
            });
        </script>
        <?php
        unset($_SESSION['mensaje']);
    }
    ?>
</body>

<div class="container-fluid">
    <div class="text-center mb-4">
        <h2 style="color: #814a3e;">¿Está seguro de eliminar la compra a proveedor?</h2>
    </div>

    <form action="../controllers/compras_proveedores/eliminar_compras_proveedores.php" method="post">

        <input type="hidden" name='id_compras' value="<?php echo htmlspecialchars($id_compras_proveedor_get); ?>">

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Compra a proveedor</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Proveedor</label>
                                <select class="form-control" name="nombre" id="nombre" disabled>
                                    <option value="" disabled>Seleccione un proveedor</option>
                                    <option value="<?php echo htmlspecialchars($id_proveedor); ?>" selected>
                                        <?php echo htmlspecialchars($nombre_proveedor); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="fecha_compra" class="form-label">Fecha Compra</label>
                                <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" readonly
                                    value="<?php echo htmlspecialchars($fechas_compras); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control"
                                    value="<?php echo htmlspecialchars($total); ?>" name="total" id="total" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="nombreEmpleado" class="form-label">Empleado</label>
                                <input type="text" class="form-control" id="nombreEmpleado" readonly
                                    value="<?php echo htmlspecialchars($empleado); ?>">
                                <input type="hidden" name="rfc" value="<?php echo htmlspecialchars($rfc); ?>">
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
                                <select class="form-control" name="producto" id="producto" disabled>
                                    <option value="" disabled>Seleccione un producto</option>
                                    <option value="<?php echo htmlspecialchars($id_productos); ?>" selected>
                                        <?php echo htmlspecialchars($producto); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" value="<?php echo htmlspecialchars($cantidad); ?>"
                                    class="form-control" readonly name="cantidad" id="cantidad" step="0.01" oninput="calcularTotal()">
                            </div>
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" readonly
                                    value="<?php echo htmlspecialchars($precio_unitario); ?>" name="precio_unitario"
                                    id="precio_unitario" oninput="calcularTotal()">
                            </div>

                            <?php foreach ($productos_controller as $producto_controller) { ?>
                                <div class="col-md-6">
                                    <label for="stock" class="form-label">Stock Actual</label>
                                    <input value="<?php echo $producto_controller['stock']; ?>" type="number"
                                        class="form-control" name="stock" id="stock" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="stock_nuevo" class="form-label">Stock Nuevo</label>
                                    <input type="number" class="form-control" name="stock_nuevo" id="stock_nuevo"
                                        readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="stock_minimo" class="form-label">Stock Minimo</label>
                                    <input value="<?php echo $producto_controller['stock_minimo']; ?>" type="number"
                                        class="form-control" name="stock_minimo" id="stock_minimo" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="stock_maximo" class="form-label">Stock Maximo</label>
                                    <input value="<?php echo $producto_controller['stock_maximo']; ?>" type="number"
                                        class="form-control" name="stock_maximo" id="stock_maximo" readonly>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-warning me-2">ELIMINAR</button>
            <a href="<?php echo $URL; ?>/app/compras_proveedores" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>

    <script>
        function calcularTotal() {
            const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            const precioUnitario = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const total = cantidad * precioUnitario;

            const stockActual = parseFloat(document.getElementById('stock').value) || 0;
            const stockNuevo = stockActual - cantidad;

            document.getElementById('total').value = total.toFixed(2);
            document.getElementById('stock_nuevo').value = stockNuevo >= 0 ? stockNuevo : 0; 
        }

        window.onload = function() {
            calcularTotal(); 
        };
    </script>

    <?php
    include('../../layout/parte2.php');
    ?>
</div>
