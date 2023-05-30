<?php
session_start();
include "./php/conexion.php";
if (!isset($_SESSION['datos_login'])) {
  header("Location: ./index.php");
}
$arregloUsuario = $_SESSION['datos_login'];

$sql = "SELECT * FROM categorias";
$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Panel de control
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php include("./layouts/admin/header.php"); ?>
  <main class="main-content position-relative border-radius-lg ps">
    <!-- Navbar -->
    <?php include("./layouts/header.php"); ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <?php
      if ($arregloUsuario['nivel'] == 'admin') {
      ?>
        <div class="row">
          <div class="col-12">
            <div class="card mb-10">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <a href="./panelejercicios.php">
                              <h5 class="font-weight-bolder">
                                Ejercicios
                              </h5>
                            </a>
                          </div>
                          <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i class="fa fa-file-word-o text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <a href="./panelblogs.php">
                                <h5 class="font-weight-bolder">
                                  Blogs
                                </h5>
                              </a>
                            </div>
                          </div>
                          <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <a href="./panelrutas.php">
                                <h5 class="font-weight-bolder">
                                  Rutas
                                </h5>
                              </a>
                            </div>
                          </div>
                          <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php
      if ($arregloUsuario['nivel'] == 'cliente') {
      ?>
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h3 class="text-capitalize">Rutas inscritas</h3>
              <?php
              include('./php/conexion.php');
              $arregloUsuario = $_SESSION['datos_login'];
              $idUsuario = $arregloUsuario['id_usuario'];
              $limite2 = 10;

              $totalQuery = $conexion->query("SELECT COUNT(*) FROM rutas
                               INNER JOIN controlruta ON rutas.id = controlruta.id_ruta
                               WHERE controlruta.id_usuario = $idUsuario") or die($conexion->error);
              $totalContenido3 = mysqli_fetch_row($totalQuery);
              $totalBotones3 = round($totalContenido3[0] / $limite2);

              if (isset($_GET['limite'])) {
                $resultado = $conexion->query("SELECT rutas.* FROM rutas
                                INNER JOIN controlruta ON rutas.id = controlruta.id_ruta
                                WHERE controlruta.id_usuario = $idUsuario
                                ORDER BY rutas.id DESC
                                LIMIT " . $_GET['limite'] . "," . $limite2) or die($conexion->error);
              } else {
                $resultado = $conexion->query("SELECT rutas.* FROM rutas
                                INNER JOIN controlruta ON rutas.id = controlruta.id_ruta
                                WHERE controlruta.id_usuario = $idUsuario
                                ORDER BY rutas.id DESC
                                LIMIT " . $limite2) or die($conexion->error);
              }
              ?>

              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <!-- blog -->
              </p>
              <div class="row">
                <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-7">
                            <div class="numbers">
                              <div class="d-flex align-items-center">
                                <div class="mr-3">
                                  <a href="detalleruta.php?id2=<?php echo $fila['id']; ?>">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ruta</p>
                                    <h5 class="font-weight-bolder"><?php echo $fila['nombre']; ?></h5>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-1">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="row" data-aos="fade-up">

                <!-- blog -->
                <p></p>
              </div>


              <div class="card-body p-8">
                <!-- End Navbar -->
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <?php include("./layouts/footer.php"); ?>

  </main>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
  <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      var idEliminar = -1;
      var idEditar = -1;
      var fila;
      $(".btnEliminar").click(function() {
        idEliminar = $(this).data('id');
        fila = $(this).parent('td').parent('tr');
      });
      $(".eliminar").click(function() {
        $.ajax({
          url: './php/eliminarcategoria.php',
          method: 'POST',
          data: {
            id: idEliminar
          }
        }).done(function(res) {

          $(fila).fadeOut(1000);
        });

      });
      $(".btnEditar").click(function() {
        idEditar = $(this).data('id');
        var nombre = $(this).data('nombre');
        var descripcion = $(this).data('descripcion');
        $("#nombreEdit").val(nombre);
        $("#descripcionEdit").val(descripcion);
        $("#idEdit").val(idEditar);
      });
    });
  </script>

  <!-- Code injected by live-server -->



</body>

</html>