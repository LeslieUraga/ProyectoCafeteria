<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/ventas/listado_de_ventas.php');
include('../controllers/productos/listado_de_productos.php');
include('../controllers/ventas/obtener_datos.php');
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
        <h2 style="color: #814a3e;">¿Desea eliminar la venta?</h2>
    </div>

    <form action="../controllers/ventas/eliminar_venta.php" method="post">
        <input type="text" name='id_venta' value="<?php echo $id_venta_get; ?>" hidden>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Venta a cliente</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="id_venta" class="form-label">Número de venta</label>
                                <input type="number" class="form-control" name="id_venta" id="id_venta"
                                    value="<?php echo $controller['id_venta']; ?>" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_venta" class="form-label">Fecha venta</label>
                                <input type="date" class="form-control" name="fecha_venta" id="fecha_venta"
                                    value="<?php echo $controller['fecha_venta']; ?>" readonly disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="total_venta" class="form-label">Total de la Venta</label>
                                <input type="number" class="form-control" name="total_venta" id="total_venta"
                                    value="<?php echo $controller['total']; ?>" required readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="nombreEmpleado" class="form-label">Empleado</label>
                                <input type="text" class="form-control" id="nombreEmpleado" readonly
                                    value="<?php echo $venta_controller['nombre']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Detalle de la venta</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="producto" class="form-label">Producto</label>
                                <select class="form-control" name="producto[]" id="producto" required disabled>
                                    <option value="">Selecciona un producto</option>
                                    <?php
                                    
                                    foreach ($productos_controller as $producto_controller) {
                                        echo '<option value="' . $producto_controller['id_producto'] . '" data-nombre="' . $producto_controller['nombre'] . '" data-precio="' . $producto_controller['precio'] . '">' . $producto_controller['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad[]" value="" id="cantidad"
                                    required step="0.01" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" name="precio_unitario[]" value=""
                                    id="precio_unitario" required step="0.01" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Actual</label>
                                <input type="number" class="form-control" name="stock" id="stock" readonly disabled>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-3">
                    <div id="carrito" class="row g-3">
                        <?php
                        
                        if (!empty($productos_venta)) {
                            foreach ($productos_venta as $producto_venta) {
                                echo "<div class='col-md-3'>" . htmlspecialchars($producto_venta['nombre']) . "</div>
                                      <div class='col-md-2'>" . htmlspecialchars($producto_venta['cantidad']) . "</div>
                                      <div class='col-md-2'>" . htmlspecialchars($producto_venta['precio_unitario']) . "</div>
                                      <div class='col-md-2'>" . htmlspecialchars($producto_venta['total']) . "</div>";
                            }
                        } else {
                            echo "<p>No hay productos en el carrito.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-warning me-2">ELIMINAR</button>
            <a href="<?php echo $URL; ?>/app/ventas" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>

    <script>
        let carrito = <?php echo json_encode($productos_venta); ?>; 

        function agregarAlCarrito(producto) {
           
            const totalProducto = parseFloat(producto.precio_unitario) * parseFloat(producto.cantidad);

            
            const productoCarrito = {
                productoNombre: producto.nombre,
                cantidad: producto.cantidad,
                precioUnitario: parseFloat(producto.precio_unitario),
                totalProducto: totalProducto.toFixed(2) 
            };
           
            carrito.push(productoCarrito);
            actualizarCarrito();  
            actualizarTotalVenta();
        }


        function actualizarCarrito() {
            const carritoDiv = document.getElementById("carrito");
            carritoDiv.innerHTML = ''; 

            carrito.forEach((item, index) => {
                const div = document.createElement("div");
                div.className = "row mb-2";
                
                const totalProducto = item.totalProducto ? parseFloat(item.totalProducto).toFixed(2) : "0.00";
                const precioUnitario = item.precioUnitario ? parseFloat(item.precioUnitario).toFixed(2) : "0.00";

                div.innerHTML = ` 
            <div class="col-md-3">${item.productoNombre}</div>
            <div class="col-md-2">${item.cantidad}</div>
            <div class="col-md-2">${precioUnitario}</div>
            <div class="col-md-2">${totalProducto}</div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})" disabled>Eliminar</button>
            </div>
        `;
                carritoDiv.appendChild(div);
            });
        }


        function eliminarDelCarrito(index) {
            carrito.splice(index, 1);
            actualizarCarrito();
            actualizarTotalVenta();
        }

        function actualizarTotalVenta() {
            const totalVenta = carrito.reduce((sum, item) => sum + parseFloat(item.totalProducto), 0);
            document.getElementById("total_venta").value = totalVenta.toFixed(2);
        }

        document.querySelector("form").onsubmit = function () {
            if (carrito.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Carrito vacío",
                    text: "No puedes realizar una venta sin productos en el carrito.",
                });
                return false;
            }
            return true;
        };
    </script>

</div>
