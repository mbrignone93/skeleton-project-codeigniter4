<!DOCTYPE HTML>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="author" content="Grupo Dinosaurio">
  <link href="<?php echo base_url() ?>/assets/img/logo/logo.png" rel="icon">
  <title>Error 403 Forbidden</title>
  <link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>/assets/vendor/bootstrap/css/bootstrap-<?php echo $session->get('skin')?>.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>/assets/css/skin-<?php echo $session->get('skin')?>.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>/assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" >
  <script src="<?php echo base_url() ?>/assets/vendor/sweetalert/sweetalert.min.js"></script>
</head>
<body id="page-top">
  <div id="wrapper">
      <?php echo view('layout/header-left') ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php echo view('layout/header-top') ?>

        <div class="container-fluid" id="container-wrapper">
          <div class="text-center">
            <img src="<?php echo base_url() ?>/assets/img/403.jpg" style="max-height: 400px;" class="mb-3">
            <h3 class="text-gray-800 font-weight-bold">Oops!</h3>
            <p class="lead text-gray-800 mx-auto">Error 403 Acceso Restringido</p>
          </div>

        </div>
      </div>
      <?php echo view('layout/footer') ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/ruang-admin.min.js"></script>
  <script>
    function alertLogout(){
        swal({
            title: "",
            text: "¿Confirmar Cierre de Sesión?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Aceptar",
            cancelButtonClass: "btn-secondary",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) 
            {
                window.location.href='<?php echo base_url()?>/auth/logout';
            }
        });  
    }
  </script>
</body>
</html>