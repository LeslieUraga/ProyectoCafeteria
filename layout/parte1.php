<?php 
include('sesion.php');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cafeteria VLU-VALLEY</title>
  <link rel="shortcut icon" type="image/png" href="public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/logos/coffe.jpg" />
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/libs/simplebar/dist/simplebar.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/css/styles.min.css" />

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- LIBRERIA DATATABLE -->
   <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <!-- LIBRERIA DATATABLE -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <!--LIBRERIA DE SWEETALERT---->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--GRAFICAS---->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!--LIBRERIA DE SWEETALERT---->
</head>

<body>  
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?php echo $URL;?>/index.php" style="color: #814a3e" class="text-nowrap logo-img">
            <img src="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/assets/images/logos/coffe.svg" alt="" width="50" height="50"/> CAFETERÍA
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">INICIO</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/app/indicadores" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:chart-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Indicadores</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:user-id-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Empleados</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Pedidos</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">PANEL DE ACCIONES</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:cart-large-2-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Ventas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:bag-5-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Compras a proveedor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/app/proveedores" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:user-hand-up-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Proveedor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/app/categorias" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:clipboard-list-bold" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Categorias</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/app/productos" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:shop-2-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Productos</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
              <span class="hide-menu">AUTENTICACION</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/login/login.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL;?>/public/templates/SEODash-1.0.0/SEODash-1.0.0/src/html/authentication-register.html" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?php echo $foto;?>" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>            
                    <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="btn btn-outline-primary mx-3 mt-2 d-flex align-items-center justify-content-center" style="background-color: #D2B48C; border-color: #D2B48C; color: white;">
                        <iconify-icon icon="solar:logout-2-bold-duotone" class="fs-6 me-2"></iconify-icon> Logout
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->


      