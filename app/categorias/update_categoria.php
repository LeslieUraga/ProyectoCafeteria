<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
include('../controllers/categorias/obtener_datos.php');
?>
<Body>
<?php 
  
  if(isset($_SESSION['mensaje'])){
    $respuesta = $_SESSION['mensaje'];?>
    <script>
      Swal.fire({
      icon: "<?php echo $_SESSION['icono']?>",
      title: "<?php echo $_SESSION['icono']?>",
      text: '<?php echo $respuesta;?>',
    });
    </script>
  <?php
    unset($_SESSION['mensaje']);
  }
  ?>
</body>
<div class="container-fluid">


        <div class="text-center">
            <span class="fs-7" style="color: #814a3e;">
                Actualizar la categoría
            </span>
        </div><br>              
        <form action="../controllers/categorias/actualizar_categoria.php" method="post">
            <input type="text" name='id_categoria' value="<?php echo $id_categoria_get;?>" hidden>
            <div class="card">            
                <div class="card-body"> 
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción</label>
                        <input class="form-control" value="<?php echo $descripcion;?>" name="descripcion" rows="3" required></input>
                    </div>
                </div>   
            </div>
        

            <div style="display: flex; justify-content: center; gap: 20px;">
                <button type="submit" class="btn btn-info">
                    GUARDAR
                </button>
                <a type="button" href="<?php echo $URL;?>/app/categorias" class="btn btn-danger">
                    CANCELAR
                </a>
            </div>
        </form>

        
</div>


<?php 
include('../../layout/parte2.php');
?>