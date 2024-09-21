<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/categorias/listado_de_categorias.php'); 
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
        <span class="fs-7" style="color: #814a3e;">Agregar nuevo producto</span>
    </div>
    
    <form action="../controllers/productos/agregar_productos.php" method="post">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required aria-label="Nombre del producto">
                    </div>
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" id="precio" required aria-label="Precio del producto" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-control" name="categoria" id="categoria" required aria-label="Selecciona una categoría">
                            <option value="">Selecciona una categoría</option>
                            <?php foreach ($categorias_controller as $categoria_controller): ?>
                                <option value="<?php echo htmlspecialchars($categoria_controller['id_categoria']); ?>">
                                    <?php echo htmlspecialchars($categoria_controller['descripcion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" required aria-label="Stock disponible">
                    </div>
                    <div class="col-md-6">
                        <label for="stock_minimo" class="form-label">Stock mínimo</label>
                        <input type="number" class="form-control" name="stock_minimo" id="stock_minimo" required aria-label="Stock mínimo">
                    </div>
                    <div class="col-md-6">
                        <label for="stock_maximo" class="form-label">Stock máximo</label>
                        <input type="number" class="form-control" name="stock_maximo" id="stock_maximo" required aria-label="Stock máximo">
                    </div>
                    <div class="col-md-12">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="text" class="form-control" name="foto" id="foto" aria-label="URL de la foto">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <button type="submit" class="btn btn-info">GUARDAR</button>
            <a href="<?php echo $URL;?>/app/productos" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>
</div>

<?php 
include('../../layout/parte2.php');
?>
