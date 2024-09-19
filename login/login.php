<?php
include('../app/config.php');?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="shortcut icon" type="image/png" href="../public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/logos/coffe.jpg" />
  <link rel="stylesheet" href="../public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
  }else{

  }
  ?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/logos/coffe.svg"  alt="" width="100" height="100">
                </a>
                <p class="text-center">Ingrese sus credenciales</p>
                <form action="../app/controllers/login/ingreso.php" method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" name="correo_electronico" class="form-control" placeholder="Ingrese su correo electrónico" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
            
                    <a class="text fw-bold" href="index.html" style="color: #8B4513;">Forgot Password ?</a>
                  </div>
                    <button type="submit" class="btn w-100 py-8 fs-4 mb-4" style="background-color: #D2B48C; border-color: #D2B48C; color: white;">Sign In</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>