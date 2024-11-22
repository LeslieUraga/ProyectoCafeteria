<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/proveedores/listado_de_proveedores.php'); 
include('../controllers/proveedores/obtener_datos.php'); 
?>

<body>
<?php 
session_start();
if (isset($_SESSION['mensaje'])) {
    $respuesta = $_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            icon: "<?php echo $_SESSION['icono'];?>",
            title: "<?php echo $_SESSION['titulo'];?>",
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
        <span class="fs-7" style="color: #814a3e;">¿Está seguro de eliminar el proveedor?</span>
    </div>
    
    <form action="../controllers/proveedores/eliminar_proveedor.php" method="post">        
        <input type="text" name='id_proveedor' value="<?php echo $id_proveedores_get;?>" hidden>
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" disabled value="<?php echo $nombre;?>">
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" disabled placeholder="Ingrese el teléfono del proveedor" step="0.01" value="<?php echo $telefono;?>">
                    </div>
                    <div class="col-md-6">
                        <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" disabled value="<?php echo $correo_electronico;?>">
                    </div>                    
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" disabled  value="<?php echo $direccion;?>">
                    </div>                    
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <button type="submit" class="btn btn-warning">ELIMINAR</button>
            <a href="<?php echo $URL;?>/app/proveedores" class="btn btn-danger">CANCELAR</a>
        </div>
    </form>
</div>

<?php 
include('../../layout/parte2.php');
?>
