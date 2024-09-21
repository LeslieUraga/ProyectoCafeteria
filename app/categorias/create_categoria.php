<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');
?>
<Body>
<?php 
  session_start();
  if(isset($_SESSION['mensaje'])){
    $respuesta = $_SESSION['mensaje'];?>
    <script>
      Swal.fire({
      icon: "error",
      title: "Oops...",
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
                Agregar nueva categoría
            </span>
        </div><br>
        <form action="../controllers/categorias/agregar_categoria.php" method="post">
            <div class="card">            
                <div class="card-body"> 
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <input class="form-control" name="descripcion" rows="3"></input>
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