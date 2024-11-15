<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/ventas/listado_de_ventas.php');
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
        <h2 style="color: #814a3e;">Realizar venta</h2>
    </div>

    <form action="../controllers/ventas/agregar_venta.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Venta a cliente</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Numero de venta</label>
                                <input type="number" class="form-control" name="id_venta" id="id_venta"
                                    value="<?php echo $controller['nuevo_id']; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_venta" class="form-label">Fecha venta</label>
                                <input type="date" class="form-control" name="fecha_venta" id="fecha_venta" readonly>
                                <script>
                                    window.onload = function () {
                                        var fecha = new Date();
                                        var dia = fecha.getDate();
                                        var mes = fecha.getMonth() + 1;
                                        var año = fecha.getFullYear();

                                        if (dia < 10) dia = '0' + dia;
                                        if (mes < 10) mes = '0' + mes;

                                        var fechaFormateada = año + '-' + mes + '-' + dia;

                                        document.getElementById("fecha_venta").value = fechaFormateada;
                                    };
                                </script>
                            </div>

                            <div class="col-md-6">
                                <label for="total_venta" class="form-label">Total de la Venta</label>
                                <input type="number" class="form-control" name="total_venta" id="total_venta" required
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="nombreEmpleado" class="form-label">Empleado</label>
                                <input type="text" class="form-control" id="nombreEmpleado" readonly
                                    value="<?php echo $nombres_sesion; ?>">
                                <input type="hidden" name="nombreEmpleado" value="<?php echo $nombres_sesion; ?>">
                                <input type="hidden" name="rfc" value="<?php echo $rfc; ?>">
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
                                <select class="form-control" name="producto[]" id="producto" required
                                    onchange="actualizarStock()">
                                    <option value="">Selecciona un producto</option>
                                    <?php foreach ($productos_controller as $producto_controller): ?>
                                        <option value="<?php echo htmlspecialchars($producto_controller['id_producto']); ?>"
                                            data-stock="<?php echo $producto_controller['stock']; ?>">
                                            <?php echo htmlspecialchars($producto_controller['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad[]" id="cantidad" required
                                    step="0.01" oninput="calcularTotalProducto()">
                            </div>
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" name="precio_unitario[]" id="precio_unitario"
                                    required oninput="calcularTotalProducto()">
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Actual</label>
                                <input type="number" class="form-control" name="stock" id="stock" readonly>
                            </div>
                            <br>
                            <div class="col-md-3 text-center">
                                <button type="button" class="btn btn-success" onclick="agregarAlCarrito()">Agregar al
                                    carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Carrito</div>
                    <div class="card-body">
                        <div id="carrito" class="row g-3"></div>
                        <button type="button" class="btn btn-danger mt-3" onclick="vaciarCarrito()"> Vaciar
                            Carrito</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-info me-2">GUARDAR</button>
            <a href="<?php echo $URL; ?>/app/ventas" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>

    <script>
        let carrito = [];

        function agregarAlCarrito() {
            const productoId = document.getElementById("producto").value;
            const productoNombre = document.querySelector(`#producto option[value="${productoId}"]`).textContent.trim();
            const cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
            const precioUnitario = parseFloat(document.getElementById("precio_unitario").value) || 0;
            const stockActual = parseInt(document.getElementById("stock").value);

            if (!productoId || cantidad <= 0 || precioUnitario <= 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Selecciona un producto, cantidad válida y precio unitario.",
                });
                return;
            }

            if (cantidad > stockActual) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "La cantidad vendida no puede ser mayor al stock disponible.",
                });
                return;
            }

            const totalProducto = cantidad * precioUnitario;
            carrito.push({ productoId, productoNombre, cantidad, precioUnitario, totalProducto });

            console.log(carrito);

            actualizarCarrito();
            actualizarTotalVenta();
        }

        function actualizarCarrito() {
            const carritoDiv = document.getElementById("carrito");
            carritoDiv.innerHTML = '';

            carrito.forEach((item, index) => {
                const div = document.createElement("div");
                div.className = "row mb-2";
                div.innerHTML = `
                    <div class="col-md-3">${item.productoNombre}</div>
                    <div class="col-md-2">${item.cantidad}</div>
                    <div class="col-md-2">${item.precioUnitario.toFixed(2)}</div>
                    <div class="col-md-2">${item.totalProducto.toFixed(2)}</div>
                    <div class="col-md-2"><button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">X</button></div>
                `;
                carritoDiv.appendChild(div);
            });
        }

        function eliminarDelCarrito(index) {
            carrito.splice(index, 1);
            actualizarCarrito();
            actualizarTotalVenta();
        }

        function vaciarCarrito() {
            carrito = [];
            actualizarCarrito();
            actualizarTotalVenta();
        }

        function actualizarTotalVenta() {
            const totalVenta = carrito.reduce((sum, item) => sum + item.totalProducto, 0);
            document.getElementById("total_venta").value = totalVenta.toFixed(2);
        }

        document.querySelector("form").onsubmit = function () {
            if (carrito.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Carrito vacío",
                    text: "No puedes realizar una venta sin productos en el carrito.",
                });
                return false;  // Prevenir el envío del formulario
            }

            const carritoInput = document.createElement("input");
            carritoInput.type = "hidden";
            carritoInput.name = "carrito";
            carritoInput.value = JSON.stringify(carrito);
            this.appendChild(carritoInput);
        };

        function actualizarStock() {
            const productoId = document.getElementById("producto").value;
            const producto = document.querySelector(`#producto option[value="${productoId}"]`);
            const stock = producto ? producto.getAttribute('data-stock') : 0;
            document.getElementById("stock").value = stock;
        }
    </script>
</div>

<?php include('../../layout/parte2.php'); ?>
