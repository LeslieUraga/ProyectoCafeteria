<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/compras_proveedores/listado_compras_proveedor.php'); 
include('../controllers/proveedores/listado_de_proveedores.php'); 
?>

<body>
<?php 
session_start();
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
        <span class="fs-7" style="color: #814a3e;">Realizar compra a proveedor</span>
    </div>
    
    <form action="../controllers/compras-proveedores/agregar_compras_proveedores.php" method="post">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">  
                    <div class="col-md-6">
                        <label for="categoria" class="form-label">Nombre</label>
                        <select class="form-control" name="nombre" id="nombre" required aria-label="Selecciona un proveedor">
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
                        <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required aria-label="" step="0.01">
                    </div>                   

                    <div class="col-md-6">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" name="total" id="total" required aria-label="Stock disponible">
                    </div>

                    <div class="col-md-6">
                        <label for="total" class="form-label">Empleado</label>
                        <input type="text" class="form-control" name="total" id="total" disabled aria-label="Empleado">
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <button type="submit" class="btn btn-info">GUARDAR</button>
            <a href="<?php echo $URL;?>/app/compras_proveedores" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>
</div>

<?php 
include('../../layout/parte2.php');
?>
