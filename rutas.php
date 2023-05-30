<?php
session_start();
$arregloUsuario = $_SESSION['datos_login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
Rutas
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
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php include("./layouts/header.php"); ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
    <?php include("./layouts/botonesupe.php"); ?>
      <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h3 class="text-capitalize">Ultimas rutas</h3>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <!-- blog -->
                <?php
        include('./php/conexion.php');
        $limite2 = 10;
        $totalQuery = $conexion->query('SELECT COUNT(*) FROM rutas') or die($conexion->error);
        $totalContenido3 = mysqli_fetch_row($totalQuery);
        $totalBotones3 = round($totalContenido3[0] / $limite2);

        if (isset($_GET['limite'])) {
          $resultado = $conexion->query("SELECT * FROM rutas
                        ORDER BY id DESC
                        LIMIT " . $_GET['limite'] . "," . $limite2) or die($conexion->error);
        } else {
          $resultado = $conexion->query("SELECT * FROM rutas
                        ORDER BY id DESC
                        LIMIT " . $limite2) or die($conexion->error);
        }
        ?>
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
              </p>
            </div>
         

            <div class="card-body p-8">
              <!-- End Navbar -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#609966",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>