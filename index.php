<?php
include('app/config.php');
include('layout/sesion.php');
include('layout/parte1.php');
?>

<body>
<?php 
session_start();
if (isset($_SESSION['mensaje'])) {
    $respuesta = $_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            icon: 'success', // Ajusta el ícono según corresponda
            title: '<?php echo $respuesta; ?>',
            text: '<?php echo $_SESSION['session_email'];?>',
        });
    </script>
<?php
    unset($_SESSION['mensaje']);
}
?>
</body>

      <div class="container-fluid">
        <div class="card">
          <div class="card-body">                
          <span class="badge text-bg-light fs-6 py-1 px-2 lh-sm mt-3">Bienvenido/a, <?php echo $nombres_sesion;?> </span>
          <br>
          <br>
          <p class="fs-4"> <!-- Clase de Bootstrap para aumentar el tamaño de la fuente -->
                ¡Nos alegra tenerte aquí! Has iniciado sesión correctamente. A continuación, podrás acceder a las herramientas necesarias para gestionar tus tareas diarias. Recuerda que algunas funciones están restringidas para garantizar el correcto funcionamiento del sistema. Si tienes alguna duda o necesitas asistencia, no dudes en comunicarte con tu supervisor.
            </p>
          <h4>Accesos disponibles:</h4>
            <ul class="fs-4"> <!-- Lista con tamaño de letra más grande -->
                <li>Gestión de pedidos</li>
                <li>Registro de ventas</li>
                <li>Consulta de productos</li>
                <li>Consulta de categorias</li>
            </ul>
            <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/products/welcome.png" class="card-img-top" alt="matdash-img" weight="100" height="350">
                    </a>
                </div>
            <div class="card">
              <div class="card-body p-4">
                
              </div>
            </div>
            
          </div>
        </div>
        
      </div>


<?php 
include('layout/parte2.php');
?>